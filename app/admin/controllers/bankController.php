<?php
class PagerLayoutWithArrows extends Doctrine_Pager_Layout
{
    public function display($options = array(), $return = false)
    {
        $pager = $this->getPager();
        $str = '';

        // First page
        $this->addMaskReplacement('page', '&laquo;', true);
        $options['page_number'] = $pager->getFirstPage();
        $str .= $this->processPage($options);

        // Previous page
        $this->addMaskReplacement('page', '&lsaquo;', true);
        $options['page_number'] = $pager->getPreviousPage();
        $str .= $this->processPage($options);

        // Pages listing
        $this->removeMaskReplacement('page');
        $str .= parent::display($options, true);

        // Next page
        $this->addMaskReplacement('page', '&rsaquo;', true);
        $options['page_number'] = $pager->getNextPage();
        $str .= $this->processPage($options);

        // Last page
        $this->addMaskReplacement('page', '&raquo;', true);
        $options['page_number'] = $pager->getLastPage();
        $str .= $this->processPage($options);

        // No
        $this->addMaskReplacement('page', 'All pages:', true);
        
        $str .= '<li class="all">Total: '.$pager->getNumResults().'</li>';
        
        // Possible wish to return value instead of print it on screen
        if ($return) {
            return $str;
        }

        echo $str;
    }
}

class bankController extends Cms_Controller
{
    const BANK_ID = 2;
    
    public function init()
    {
        if (!$this->user->hasRole('ADMIN')) {
            $this->redirect('/');
        }
    }
    public function indexAction()
    {
        //echo date("d m Y H:i:s O", 1327276066);
        
        $bank = UserTable::getInstance()->find(self::BANK_ID);
        if(!$bank) {
            die('THIS SHOULD NEVER HAPPEN PLEASE CONTACT THE DEVELOPERS, THE DATABASE IS CORRUPTED');
        }
        $view = $this->getParam('view', 'overall');
        switch($view) {
            case 'overall':
                return $this->overall($bank);
            break;
        
            case 'transactions':
                return $this->transactions($bank);
            break;
        
            case 'withdraw':
                return $this->withdraw($bank);
            break;
        
            case 'coupons':
                return $this->coupons($bank);
            break;
        }
    }
    
    protected function overall($bank) 
    {
        $this->setTemplate('bank/index.twig');
        
        $ac = $this->getParam('ac');
        if($ac == 'twallet') {
            $conn = Doctrine_manager::getInstance()->getCurrentConnection();
            $conn->beginTransaction();
            try {
                $bank->wallet = $bank->wallet + $bank->virtual_wallet;
                $vw = $bank->virtual_wallet;
                $bank->virtual_wallet = 0;
                $bank->save();
                $type = TransactionTable::$type;

                $tran = new Transaction();
                $tran->parent_id = 0;
                $tran->transaction_type = $type['transfer-to-wallet'];
                $tran->sender_id = self::BANK_ID;
                $tran->receiver_id = self::BANK_ID;

                $tran->full_payment = $vw;
                $tran->save();
                $conn->commit();

            } catch(Doctrine_Exception $e) {
                $conn->rollback();
            }
        }
        
        $wallet = $bank->wallet;
        $virtualWallet = $bank->virtual_wallet;
        
        
        return array(
            'wallet' => $wallet,
            'virtual_wallet' => $virtualWallet
            );
    }
    
    public function transactions()
    {
        $this->setTemplate('bank/transactions.twig');
        
        $page = $this->getParam('page', 1);
        
        $tab = $this->getParam('tab', 'tax');
        switch($tab) {
            case 'tax':
                $l = '&tab=tax';
                $query = TransactionTable::getInstance()->getBankTaxTransactions(array());
            break;
        
            case 'network':
                $l = '&tab=network';
                $query = TransactionTable::getInstance()->getBankNetworkTransactions(array());
            break;
        
            case 'bank':
                $l = '&tab=bank';
                $query = TransactionTable::getInstance()->getBankWalletTransactions(array());
            break;
        }
        
        $pagerLayout = new PagerLayoutWithArrows(
                new Doctrine_Pager(
                    $query,
                    $page, 25),
                      new Doctrine_Pager_Range_Sliding(array(
                            'chunk' => 5
                      )),
                '/admin/bank?view=transactions&page={%page_number}'.$l
            );
        $pagerLayout->setTemplate('<li><a href="{%url}">{%page}</a></li>');
        $pagerLayout->setSelectedTemplate('<li class="selected">{%page}</li>');
        
        // Fetching users
        $transactions = $pagerLayout->execute(array(), Doctrine::HYDRATE_ARRAY);
        $transactionType = array_flip(TransactionTable::$type);
        
        return array(
            'transactions'  => $transactions,
            'pagination' => $pagerLayout->display(array(), true),
            'transactionType' => $transactionType,
            'tab'  => $tab 
        );
    }
    
    protected function withdraw($bank) 
    {
        $this->setTemplate('bank/withdraw.twig');
        
        $form = new Zend_Form();
        $val = $form->createElement('text', 'val');
        $val->addValidator('Float', false)
                ->addValidator('GreaterThan', true, array('min' => 49, 'messages' => 'Minimum is 50$ to withdraw'))
                 ->setRequired(true)
                /*->addValidator ('regex', false, array(
                      'pattern'=>'/^\d+(\d{1,5})?(\.\d{1,2})?$/', 
                      'messages'=>array(
                       'regexInvalid'=>'required',
                       'regexNotMatch'=>'number required')
                      ))*/
                    ->addFilter('StringToLower');
        
        $form->addElement($val);
        if( $this->request->getPost() ) {
            if ($form->isValid($this->request->getPost())) {
                $vv = round($form->getValue('val'), 2);
                if($vv > $bank->wallet) {
                    $val->addError('Value is higher than the wallet');
                } else {
                    $type = TransactionTable::$type;
                    $conn = Doctrine_manager::getInstance()->getCurrentConnection();
                    $conn->beginTransaction();
                    try {
                        $tran = new Transaction();
                        $tran->parent_id = 0;
                        $tran->transaction_type = $type['withdraw'];
                        $tran->sender_id = UserTable::BANK_ID;
                        $tran->receiver_id = UserTable::BANK_ID;

                        $tran->full_payment = -$vv;
                        $tran->save();
                        $bank->wallet = $bank->wallet - $vv;
                        $bank->save();
                        $conn->commit();
                        $success = true;
                    } catch(Doctrine_Exception $e) {
                        $conn->rollback();
                        $success = false;
                    }
                }
            }
        }
        
        $wallet = $bank->wallet;
        
        
        return array(
            'wallet' => $wallet,
            'form' => array(
                        'values' => $form->getValues(),
                        'errors' => $form->getMessages(),
                        'success' => (isset($success) ? $success : false)
                    )
            );
    }
    
    protected function coupons()
    {
        $this->setTemplate('bank/coupons.twig');
        
        $page = $this->getParam('page', 1);
        
        $tab = $this->getParam('tab', 'not-verified');
        switch($tab) {
            case 'not-verified':
                $ac = $this->getParam('ac');
                if($ac === 'send-to-bank') {
                    $id = $this->getParam('id');
                    $coupon = CouponTable::getInstance()->find($id);
                    if($coupon->id) {
                        if($coupon->status == CouponTable::$status['verified']) {
                            
                        } else {
                            //now lets add
                            $conn = Doctrine_manager::getInstance()->getCurrentConnection();
                            $conn->beginTransaction();
                            try {
                                //first lets put on coupon the retriver id
                                $coupon->verifier_id = UserTable::BANK_ID;
                                $coupon->status = CouponTable::$status['verified'];
                                $coupon->save();
                                //now lets create the transactions, first lets get the do share transaction
                                $doTran = TransactionTable::getInstance()
                                            ->getDoShareTransaction(array('parent_id' => $coupon->transaction_id))
                                            ->fetchOne();
                                if($doTran->status == TransactionTable::$status['stand-by-sent']) {
                                    throw new Exception('Someone allready retrived this coupon code');
                                }
                                $tran = new Transaction();
                                $tran->parent_id = $doTran->id;
                                $tran->transaction_type = TransactionTable::$type['do-share-bank-receive'];
                                $tran->sender_id = UserTable::BANK_ID;
                                $tran->receiver_id = UserTable::BANK_ID;
                                
                                $tran->product_name = $coupon->name;
                                $tran->quantity = $coupon->quantity;

                                $hmm = TransactionTable::getInstance()->createQuery()
                                                ->addWhere('parent_id = ?', $doTran->parent_id)
                                                ->addWhere('status = ?', TransactionTable::$status['stand-by'])
                                                ->addWhere('transaction_type = ?', TransactionTable::$type['merchant-commission'])
                                                ->fetchOne();
                                $hmm->status = TransactionTable::$status['ok'];
                                $hmm->save();
                                $tran->hint = 'Bank share('.$doTran->full_payment.') + Merchant(Agent) share('.$hmm->full_payment.')';
                                $tran->full_payment = ($doTran->full_payment + $hmm->full_payment);
                                $tran->save();
                                //$query2 = 'UPDATE user SET virtual_wallet = virtual_wallet + :amount WHERE id = :user_id';
                                //$result2 = $conn->execute($query2, array('user_id' => $hmm->receiver_id, 'amount' => $hmm->full_payment));

                                //now lets update bank wallet
                                //$bank = UserTable::getInstance()->find(UserTable::BANK_ID);
                                //$bank->wallet = $bank->wallet + $doTran->full_payment;
                                //$bank->save();
                                $query2 = 'UPDATE user SET wallet = wallet + :amount WHERE id = :user_id';
                                $result2 = $conn->execute($query2, array('user_id' => UserTable::BANK_ID, 'amount' => ($doTran->full_payment + $hmm->full_payment)));
                                         
                                //lets update the do share transaction status
                                $doTran->status = TransactionTable::$status['stand-by-sent'];
                                $doTran->save();

                                //all seem ok lets commit
                                $conn->commit();

                            } catch (Exception $e) {
                                if($e->getMessage()) {
                                    
                                } else {
                                    
                                }
                                
                                $conn->rollback();
                            }
                        }
                    }
                }
                
                $l = '&tab=not-verified';
                $query = CouponTable::getInstance()->getNotVerifiedCoupons(array());
            break;
        
            case 'verified':
                $l = '&tab=verified';
                $query = CouponTable::getInstance()->getVerifiedCoupons(array());
            break;
        }
        
        $pagerLayout = new PagerLayoutWithArrows(
                new Doctrine_Pager(
                    $query,
                    $page, 25),
                      new Doctrine_Pager_Range_Sliding(array(
                            'chunk' => 5
                      )),
                '/admin/bank?view=coupons&page={%page_number}'.$l
            );
        $pagerLayout->setTemplate('<li><a href="{%url}">{%page}</a></li>');
        $pagerLayout->setSelectedTemplate('<li class="selected">{%page}</li>');
        
        // Fetching users
        $coupons = $pagerLayout->execute(array(), Doctrine::HYDRATE_ARRAY);
        $transactionType = array_flip(TransactionTable::$type);
        
        return array(
            'coupons'  => $coupons,
            'pagination' => $pagerLayout->display(array(), true),
            'tab'  => $tab 
        );
    }
    
    public function liveWalletAction()
    {
        $bank = UserTable::getInstance()->find(self::BANK_ID);
        
        header("Content-type: text/json");

        $x = time() * 1000;
        $y = (float)$bank->wallet;

        $ret = array($x, $y);
        echo json_encode($ret);
        die();
    }
}
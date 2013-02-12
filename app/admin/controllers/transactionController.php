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

class transactionController extends Cms_Controller
{
    public function init()
    {
        if (!$this->user->hasRole('ADMIN')) {
            $this->redirect('/');
        }
    }
    public function refundAction()
    {
        $this->setTemplate('transaction/refund.twig');
        
        
        $ac = $this->getParam('ac');
        switch($ac) {
            case 'refund':
                $id = $this->getParam('id');
                $transaction = TransactionTable::getInstance()->getTransactionDetails(array('id' => $id))->fetchOne(array());
                if(!$transaction->id) {
                    return $this->notFoundAction();
                }
                $action = TransactionTable::$action;
                $transaction->action = $action['refunded'];
                $transaction->save();
            break;
        }
        $view = $this->getParam('view');
        switch($view) {
            case 'history':
                $query = TransactionTable::getInstance()->getRefundHistory();
            break;
        
            default:
                $query = TransactionTable::getInstance()->getRefundTransactions();
            break;
        }
        $pagerLayout = new PagerLayoutWithArrows(
                new Doctrine_Pager(
                    $query,
                    $page, 25),
                      new Doctrine_Pager_Range_Sliding(array(
                            'chunk' => 5
                      )),
                '/admin/transactions?page={%page_number}'
            );
        $pagerLayout->setTemplate('<li><a href="{%url}">{%page}</a></li>');
        $pagerLayout->setSelectedTemplate('<li class="selected">{%page}</li>');
        
        // Fetching users
        $transactions = $pagerLayout->execute(array(), Doctrine::HYDRATE_ARRAY);
        
        return array(
            'transactions' => $transactions,
            'pagination' => $pagerLayout->display(array(), true),
            'view'    => $view
            );
    }
    
    public function detailsAction()
    {
        $this->setTemplate('transaction/details.twig');
        
        $id = $this->getParam('id');
        if(!$id) {
            return $this->notFoundAction();
        }

        $transaction = TransactionTable::getInstance()->getTransactionDetails(array('id' => $id))->fetchOne(array());
        if(!$transaction->id) {
            return $this->notFoundAction();
        }
        $ac = $this->getParam('ac');
        switch($ac) {
            case 'refund':
                $action = TransactionTable::$action;
                $transaction->action = $action['refunded'];
                $transaction->save();
            break;
        }
        
        $transaction = $transaction->toArray();
        if($transaction['parent_id'] > 0) {
            $parent = TransactionTable::getInstance()->getTransactionDetails(array('id' => $transaction['parent_id']))->fetchOne(array(), Doctrine::HYDRATE_ARRAY);
        }
        
        if($transaction) {
            $type = array_flip(TransactionTable::$type);
            $transaction['transaction_type'] = $type[$transaction['transaction_type']];
        }
        
        return array(
            'transaction' => $transaction,
            'parent' => $parent
            );
    }
    
    public function withdrawAction()
    {
        $this->setTemplate('transaction/withdraw.twig');
        
        $ac = $this->getParam('ac');
        switch($ac) {
            case 'accept':
                $id = $this->getParam('id');
                $w = WithdrawRequestTable::getInstance()->find($id);
                if($w->id) {
                    $w->status = WithdrawRequestTable::$status['accepted'];
                    $type = TransactionTable::$type;

                    $tran = new Transaction();
                    $tran->parent_id = 0;
                    if($w->type == 1) {
                        $tran->transaction_type = $type['withdraw'];
                    }
                    if($w->type == 2) {
                        $tran->transaction_type = $type['withdraw-giro'];
                    }
                    $tran->sender_id = $w->user_id;
                    $tran->receiver_id = $w->user_id;

                    $tran->full_payment = -$w->amount;
                    $tran->save();
                    $w->save();
                }

            break;
            
            case 'reject':
                $id = $this->getParam('id');
                $w = WithdrawRequestTable::getInstance()->find($id);
                if($w->id) {
                    $w->status = WithdrawRequestTable::$status['rejected'];
                    $w->User->wallet = $w->User->wallet + $w->amount;
                    $w->save();
                }

            break;
        }
        
        $view = $this->getParam('view');
        $l = '';
        switch($view) {
            case 'info':
                $id = $this->getParam('id');
                $info = WithdrawRequestTable::getInstance()->find($id);
                if(!$info->id) {
                    return $this->notFoundAction();
                }
                $this->setTemplate('transaction/info.twig');
                return array('info' => $info);
            break;
            case 'accepted':
                $l = '&view=accepted';
                $query = WithdrawRequestTable::getInstance()->getAcceptedRequests();
            break;
        
            case 'rejected':
                $l = '&view=rejected';
                $query = WithdrawRequestTable::getInstance()->getRejectedRequests();
            break;
        
            default:
                $query = WithdrawRequestTable::getInstance()->getPendingRequests();
            break;
        }
        $pagerLayout = new PagerLayoutWithArrows(
                new Doctrine_Pager(
                    $query,
                    $page, 25),
                      new Doctrine_Pager_Range_Sliding(array(
                            'chunk' => 5
                      )),
                '/admin/transactions?page={%page_number}'.$l
            );
        $pagerLayout->setTemplate('<li><a href="{%url}">{%page}</a></li>');
        $pagerLayout->setSelectedTemplate('<li class="selected">{%page}</li>');
        
        // Fetching users
        $requests = $pagerLayout->execute(array(), Doctrine::HYDRATE_ARRAY);
        
        return array(
            'requests' => $requests,
            'pagination' => $pagerLayout->display(array(), true),
            'view'    => $view
        );
    }
    
    public function depositAction()
    {
        $this->setTemplate('transaction/deposit.twig');
        
        $ac = $this->getParam('ac');
        switch($ac) {
            case 'accept':
                $id = $this->getParam('id');
                $i = $this->getParam('i');
                $w = DepositRequestTable::getInstance()->find($id);
                if($w->id) {
                    $this->setTemplate('transaction/depositMATA.twig');
                    $form = new Zend_Form();
                
                    $val = $form->createElement('text', 'val');
                    $val->addValidator('Float', false)
                        ->addValidator('GreaterThan', true, array('min' => 0, 'messages' => 'Minimum is 1 to deposit'))
                        ->setRequired(true)
                        /* ->addValidator ('regex', false, array(
                        'pattern'=>'/^\d+(\d{1,5})?(\.\d{1,2})?$/',
                        'messages'=>array(
                        'regexInvalid'=>'required',
                        'regexNotMatch'=>'number required')
                        )) */
                        ->addFilter('StringToLower');
                    
                    $form->addElement($val);
                        if ($this->request->getPost()) {
                        if ($form->isValid($this->request->getPost())) {

                            $vv = round($form->getValue('val'), 2);
                            
                            $conn = Doctrine_manager::getInstance()->getCurrentConnection();
                            $conn->beginTransaction();
                            $requestStatus = DepositRequestTable::$status;
                            try {
                                $w->amount = $vv;
                                $w->type = 2;
                                //$w->user_id = $user->id;
                                $w->status = $requestStatus['accepted'];
                                $type = TransactionTable::$type;

                                $tran = new Transaction();
                                $tran->parent_id = 0;
                                
                                $tran->transaction_type = $type['deposit-giro'];
                                $tran->sender_id = $w->user_id;
                                $tran->receiver_id = $w->user_id;

                                $tran->full_payment = $vv;
                                $tran->save();
                                
                                $w->save();
                                //$user->wallet = $user->wallet - $vv;
                                //$user->save();
                                $query = 'UPDATE user SET wallet = wallet + :amount WHERE id = :user_id';
                                $result = $conn->execute($query, array('user_id' => $w->user_id, 'amount' => $vv));
                                $form->reset();
                                $success = true;
                                $conn->commit();
                            } catch (Exception $e) {
                                $conn->rollback();
                            }
                        }
                    }
                            
                    return array(
                        'form' => array(
                            'values' => $form->getValues(),
                            'errors' => $form->getMessages(),
                            'success' => (isset($success) ? $success : false)
                            ),
                        'w' => $w->toArray(), 'i' => $i);
                }

            break;
            
            case 'reject':
                $id = $this->getParam('id');
                $w = DepositRequestTable::getInstance()->find($id);
                if($w->id) {
                    $w->status = DepositRequestTable::$status['rejected'];
                    $w->save();
                }

            break;
        }
        
        $view = $this->getParam('view');
        $l = '';
        switch($view) {
            case 'accepted':
                $l = '&view=accepted';
                $query = DepositRequestTable::getInstance()->getAcceptedRequests();
            break;
        
            case 'rejected':
                $l = '&view=rejected';
                $query = DepositRequestTable::getInstance()->getRejectedRequests();
            break;
        
            default:
                $query = DepositRequestTable::getInstance()->getPendingRequests();
            break;
        }
        $pagerLayout = new PagerLayoutWithArrows(
                new Doctrine_Pager(
                    $query,
                    $page, 25),
                      new Doctrine_Pager_Range_Sliding(array(
                            'chunk' => 5
                      )),
                '/admin/transactions?page={%page_number}'.$l
            );
        $pagerLayout->setTemplate('<li><a href="{%url}">{%page}</a></li>');
        $pagerLayout->setSelectedTemplate('<li class="selected">{%page}</li>');
        
        // Fetching users
        $requests = $pagerLayout->execute(array(), Doctrine::HYDRATE_ARRAY);
        
        return array(
            'requests' => $requests,
            'pagination' => $pagerLayout->display(array(), true),
            'view'    => $view
        );
    }
}
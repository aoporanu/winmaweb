<?php

class PagerLayoutWithArrows extends Doctrine_Pager_Layout {

    public function display($options = array(), $return = false) {
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

        $str .= '<li class="all">Total: ' . $pager->getNumResults() . '</li>';

        // Possible wish to return value instead of print it on screen
        if ($return) {
            return $str;
        }

        echo $str;
    }

}

class transactionController extends Cms_Controller {
    /*
     * 
     */

    protected $cart;

    public function init() {
        if (!$this->user->isAuthenticated()) {
            $this->redirect('/');
        }
        if ($this->user->hasRole('ADMIN')) {
            $this->redirect('/admin');
        }
    }

    public function showAction() {
        $this->setTemplate('myaccount/transactions/show.twig');

        $page = $this->getParam('page');

        $view = $this->getParam('view');
        $subview = $this->getParam('subview');
        $spendFee = 0;
        $transfer = 0;
        $spentT = 0;
        $form = new Zend_Form();
        switch ($view) {
            case 'cash_in_vouchers':
                $l = '&view=cash_in_vouchers';
                $query = CouponTable::getInstance()->getRedeemedCoupons(array('owner_id' => $this->user->getUser()->get('id')));
                $format = $this->getParam('format');
                if($format == 'csv') {
                    $fisier = ROOT_PATH . '/mda.csv';
                    $date = $query->execute(array(), Doctrine::HYDRATE_ARRAY);
                    if($fp = fopen($fisier, 'w')) {
                        fputs($fp, "Created At,Expires At,Product,Buyer,Cost,Voucher Code\n");
                        foreach($date as $valori) {
                            //fputcsv($fp, $valori['email'], ',', '"');
                            fputs($fp, $valori['created_at'].",".$valori['expire_at'].",".$valori['name'].",".$valori['Transaction']['Sender']['first_name'].$valori['Transaction']['Sender']['last_name'].($valori['Friend'] ? '(For Friend: '.$valori['Friend']['first_name'].' '.$valori['Friend']['last_name'].')' : '').",".$valori['price'].",".$valori['code']."\n");
                        }

                        fclose($fp);
                    }
                    header("Content-type: application/octet-stream");
                    header("Content-Disposition: attachment; filename=\"cash_in_vouchers.csv\"");

                    // citire fisier in string si afisare
                    echo file_get_contents($fisier);

                    die;
                }
                
                $couponCode = $form->createElement('text', 'coupon_code');
                $couponCode->setRequired(true);

                $form->addElement($couponCode);

                if ($this->request->getPost()) {
                    if ($form->isValid($this->request->getPost())) {
                        $u = $this->user->getUser();
                        if ($u->is_do) {
                            $coupon = CouponTable::getInstance()->findOneBy('code', trim($form->getValue('coupon_code')));
                            if ($coupon->id) {
                                //if ($coupon->owner_id == $this->user->getUser()->get('id')) {
                                //    $couponCode->addError('You can not retrive your own coupons');
                                //    $form->addElement($couponCode);
                                //} else {
                                    if ($coupon->status == CouponTable::$status['verified']) {
                                        $couponCode->addError('This Voucher has already been cashed in and the credit has already been transferred to your My Wallet.');
                                        $form->addElement($couponCode);
                                    } else {
                                        $receiver = TransactionTable::getInstance()->createQuery()
                                                ->addWhere('id = ?', $coupon->transaction_id)
                                                ->fetchOne();
                                        ;
                                        if ($receiver->receiver_id == $this->user->getUser()->get('id')) {
                                            //now lets add
                                            $conn = Doctrine_manager::getInstance()->getCurrentConnection();
                                            $conn->beginTransaction();
                                            try {
                                                if ($coupon->status == CouponTable::$status['stand-by']) {
                                                    throw new Exception('No such coupon');
                                                }
                                                $delay = SiteConfigTable::getInstance()->getPayoutDelay();
                                                $delay = $delay['config_value'];
                                                $mda = explode(' ', $coupon->created_at);
                                                $date1 = $mda[0];
                                                $date2 = date('Y-m-d');
                                                $diff = abs(strtotime($date2) - strtotime($date1));
                                                $days = floor(($diff)/ (60*60*24));
                                                if($days<$delay) {
                                                    throw new Exception('You need to wait '.($delay-$days).' days until you can cash in the voucher');
                                                }
                                                //first lets put on coupon the retriver id
                                                $coupon->verifier_id = $this->user->getUser()->get('id');
                                                $coupon->status = CouponTable::$status['verified'];
                                                $coupon->save();
                                                //now lets create the transactions, first lets get the do share transaction
                                                $doTran = TransactionTable::getInstance()
                                                        ->getDoShareTransaction(array('parent_id' => $coupon->transaction_id))
                                                        ->fetchOne();
                                                if ($doTran->status == TransactionTable::$status['stand-by-sent']) {
                                                    throw new Exception('This Voucher has already been cashed in and the credit has already been transferred to your My Wallet.');
                                                }
                                                $tran = new Transaction();
                                                $tran->parent_id = $doTran->id;
                                                $tran->transaction_type = TransactionTable::$type['do-share-do-receive'];
                                                $tran->sender_id = UserTable::BANK_ID;
                                                $tran->receiver_id = $this->user->getUser()->get('id');

                                                $tran->product_name = $coupon->name;
                                                $tran->product_id = $doTran->product_id;
                                                $tran->product_price = $doTran->product_price;
                                                $tran->quantity = $coupon->quantity;

                                                $tran->full_payment = $doTran->full_payment;
                                                $tran->save();

                                                //lets send the money to merchant(agent)
                                                $hmm = TransactionTable::getInstance()->createQuery()
                                                        ->addWhere('parent_id = ?', $doTran->parent_id)
                                                        ->addWhere('status = ?', TransactionTable::$status['stand-by'])
                                                        ->addWhere('transaction_type = ?', TransactionTable::$type['merchant-commission'])
                                                        ->fetchOne();
                                                $hmm->status = TransactionTable::$status['ok'];
                                                $hmm->save();
                                                
                                                $sf = SiteConfigTable::getInstance()->getSpendFee();
                                                $sf = $sf['config_value'];
                                                $for_virtual = round($hmm->full_payment*$sf/100, 2);
                                                $for_w = $hmm->full_payment - $for_virtual;
                                                $query2 = 'UPDATE user SET virtual_wallet = virtual_wallet + :amount, wallet = wallet + :w WHERE id = :user_id';
                                                $result2 = $conn->execute($query2, array('user_id' => $hmm->receiver_id, 'amount' => $for_virtual, 'w' => $for_w));
                                                
                                                //lets send the money to level(5)
                                                $hmm2 = TransactionTable::getInstance()->createQuery()
                                                        ->addWhere('parent_id = ?', $doTran->parent_id)
                                                        ->addWhere('status = ?', TransactionTable::$status['stand-by'])
                                                        ->addWhere('transaction_type = ?', TransactionTable::$type['level-commission'])
                                                        ->fetchOne();
                                                if($hmm2->id) {
                                                    $hmm2->status = TransactionTable::$status['ok'];
                                                    $hmm2->save();
                                                    $for_virtual = round($hmm->full_payment*$sf/100, 2);
                                                    $for_w = $hmm->full_payment - $for_virtual;
                                                    $query2 = 'UPDATE user SET virtual_wallet = virtual_wallet + :amount, wallet = wallet + :w WHERE id = :user_id';
                                                    $result2 = $conn->execute($query2, array('user_id' => $hmm2->receiver_id, 'amount' => $for_virtual, 'w' => $for_w));
                                                }
                                                //the deal owner get the money in the wallet
                                                //$thisUser = $this->user->getUser();
                                                //$thisUser->virtual_wallet = $thisUser->virtual_wallet + $doTran->full_payment;
                                                //$thisUser->save();
                                                $query2 = 'UPDATE user SET wallet = wallet + :amount WHERE id = :user_id';
                                                $result2 = $conn->execute($query2, array('user_id' => $this->user->getUser()->get('id'), 'amount' => $doTran->full_payment));

                                                //lets update the do share transaction status
                                                $doTran->status = TransactionTable::$status['stand-by-sent'];
                                                $doTran->save();

                                                //all seem ok lets commit
                                                $conn->commit();
                                                $this->redirect('/my-account/transactions?view=cash_in_vouchers');
                                            } catch (Exception $e) {
                                                if ($e->getMessage()) {
                                                    $couponCode->addError($e->getMessage());
                                                } else {
                                                    $couponCode->addError('Something went wrong, please try again');
                                                }
                                                $form->addElement($couponCode);
                                                $conn->rollback();
                                            }
                                        } else {
                                            $couponCode->addError('You have attempted to Cash In a Voucher that does not belong to you. WinMaWeb administration has been notified and they will investigate this breach in our Terms and Conditions to take appropriate action. If you think this message was an error please contact Customer Support.');
                                            $form->addElement($couponCode);
                                        }
                                    }
                               // }
                            } else {
                                $couponCode->addError('No such code');
                                $form->addElement($couponCode);
                            }
                        } else {
                            $couponCode->addError('You cannot retrive vouchers');
                            $form->addElement($couponCode);
                        }
                    }
                }
                break;
            case 'coupons':
                $l = '&view=coupons';
                $query = CouponTable::getInstance()->getUserCoupons(array('owner_id' => $this->user->getUser()->get('id')));
                
                if($subview === 'send_gift') {
                    $l = '&view=coupons&subview=sent_gift';
                    $query = CouponTable::getInstance()->getSentGiftCoupons(array('owner_id' => $this->user->getUser()->get('id')));
                }
                if($subview === 'received_gift') {
                    $l = '&view=coupons&subview=received_gift';
                    $query = CouponTable::getInstance()->getReceivedGiftCoupons(array('friend_id' => $this->user->getUser()->get('id')));
                }
                if($subview === 'donation') {
                    $l = '&view=coupons&subview=donation';
                    $query = CouponTable::getInstance()->getDonationCoupons(array('owner_id' => $this->user->getUser()->get('id')));
                }
                break;

            case 'received':
                $l = '&view=received';
                $query = TransactionTable::getInstance()->getReceivedTransactions(array('receiver_id' => $this->user->getUser()->get('id')));
                /*
                  $couponCode = $form->createElement('text', 'coupon_code');
                  $couponCode->setRequired(true);

                  $form->addElement($couponCode);

                  if( $this->request->getPost() ) {
                  if ($form->isValid($this->request->getPost())) {
                  $u = $this->user->getUser();
                  if($u->is_do) {
                  $coupon = CouponTable::getInstance()->findOneBy('code', $form->getValue('coupon_code'));
                  if($coupon->id) {
                  if($coupon->owner_id == $this->user->getUser()->get('id')) {
                  $couponCode->addError('You can not retrive your own coupons');
                  $form->addElement($couponCode);
                  } else {
                  if($coupon->status == CouponTable::$status['verified']) {
                  $couponCode->addError('Someone allready retrived this coupon code');
                  $form->addElement($couponCode);
                  } else {
                  //now lets add
                  $conn = Doctrine_manager::getInstance()->getCurrentConnection();
                  $conn->beginTransaction();
                  try {
                  if($coupon->status == CouponTable::$status['stand-by']) {
                  throw new Exception('No such coupon');
                  }
                  //first lets put on coupon the retriver id
                  $coupon->verifier_id = $this->user->getUser()->get('id');
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
                  $tran->transaction_type = TransactionTable::$type['do-share-do-receive'];
                  $tran->sender_id = UserTable::BANK_ID;
                  $tran->receiver_id = $this->user->getUser()->get('id');

                  $tran->product_name = $coupon->name;
                  $tran->quantity = $coupon->quantity;

                  $tran->full_payment = $doTran->full_payment;
                  $tran->save();

                  //lets send the money to merchant(agent)
                  $hmm = TransactionTable::getInstance()->createQuery()
                  ->addWhere('parent_id = ?', $doTran->parent_id)
                  ->addWhere('status = ?', TransactionTable::$status['stand-by'])
                  ->addWhere('transaction_type = ?', TransactionTable::$type['merchant-commission'])
                  ->fetchOne();
                  $hmm->status = TransactionTable::$status['ok'];
                  $hmm->save();

                  $query2 = 'UPDATE user SET virtual_wallet = virtual_wallet + :amount WHERE id = :user_id';
                  $result2 = $conn->execute($query2, array('user_id' => $hmm->receiver_id, 'amount' => $hmm->full_payment));

                  //the deal owner get the money in the wallet
                  //$thisUser = $this->user->getUser();
                  //$thisUser->virtual_wallet = $thisUser->virtual_wallet + $doTran->full_payment;
                  //$thisUser->save();
                  $query2 = 'UPDATE user SET wallet = wallet + :amount WHERE id = :user_id';
                  $result2 = $conn->execute($query2, array('user_id' => $this->user->getUser()->get('id'), 'amount' => $doTran->full_payment));

                  //lets update the do share transaction status
                  $doTran->status = TransactionTable::$status['stand-by-sent'];
                  $doTran->save();

                  //all seem ok lets commit
                  $conn->commit();

                  } catch (Exception $e) {
                  if($e->getMessage()) {
                  $couponCode->addError($e->getMessage());
                  } else {
                  $couponCode->addError('Something went wrong, please try again');
                  }
                  $form->addElement($couponCode);
                  $conn->rollback();
                  }
                  }
                  }
                  } else {
                  $couponCode->addError('No such code');
                  $form->addElement($couponCode);
                  }
                  } else {
                  $couponCode->addError('You cannot retrive coupons');
                  $form->addElement($couponCode);
                  }
                  }
                  }
                 */
                break;

            case 'network':
                $l = '&view=network';
                $query = TransactionTable::getInstance()->getNetworkTransactions(array('receiver_id' => $this->user->getUser()->get('id')));
                break;

            case 'wallet':
                if ($this->user->getUser()->get('virtual_wallet') > 0) {
                    $spendFee = SiteConfigTable::getInstance()->getSpendFee();
                    $spendFee = (int) $spendFee['config_value'];

                    //now lets see how much this user spent :x
                    $lastTransfer = TransactionTable::getInstance()->getLastTransfer(array('receiver_id' => $this->user->getUser()->get('id')));
                    if ($lastTransfer['id']) {
                        $spent = TransactionTable::getInstance()->getSpentValue(array('sender_id' => $this->user->getUser()->get('id'),
                            'from_date' => $lastTransfer['created_at']));
                        if ($spent['spent']) {
                            $spentT = -$spent['spent'];
                        }
                    } else {
                        // noone yet
                        $spent = TransactionTable::getInstance()->getSpentValue(array('sender_id' => $this->user->getUser()->get('id')));
                        if ($spent['spent']) {
                            $spentT = -$spent['spent'];
                        }
                    }
                    $ac = $this->getParam('ac');
                    $user = $this->user->getUser();

                    $howMuch = ceil($user->virtual_wallet * $spendFee / 100);
                    if ($howMuch <= $spentT) {
                        $transfer = 1;
                        if ($ac === 'transfer') {

                            $conn = Doctrine_manager::getInstance()->getCurrentConnection();
                            $conn->beginTransaction();

                            try {
                                $user->wallet = $user->wallet + $user->virtual_wallet;
                                $vw = $user->virtual_wallet;
                                $user->virtual_wallet = 0;
                                $user->save();
                                $type = TransactionTable::$type;

                                $tran = new Transaction();
                                $tran->parent_id = 0;
                                $tran->transaction_type = $type['transfer-to-wallet'];
                                $tran->sender_id = $this->user->getUser()->get('id');
                                $tran->receiver_id = $this->user->getUser()->get('id');

                                $tran->full_payment = $vw;
                                $tran->save();
                                $conn->commit();
                            } catch (Doctrine_Exception $e) {
                                $conn->rollback();
                            }
                        }
                    } else {
                        if ($ac === 'transfer') {
                            
                        }
                    }
                }
                $l = '&view=wallet';
                $query = TransactionTable::getInstance()->getWalletTransactions(array('receiver_id' => $this->user->getUser()->get('id')));
                break;
            case 'all_vouchers':
                $l = '&view=all_vouchers';
                $format = $this->getParam('format');
                $query = CouponTable::getInstance()->getAllVouchers(array('receiver_id' => $this->user->getUser()->get('id')));
                
                if($format == 'csv') {
                    $fisier = ROOT_PATH . '/mda.csv';
                    $date = $query->execute(array(), Doctrine::HYDRATE_ARRAY);
                    if($fp = fopen($fisier, 'w')) {
                        fputs($fp, "Created At,Expires At,Product,Buyer,Cost,Voucher Number\n");
                        foreach($date as $valori) {
                            //fputcsv($fp, $valori['email'], ',', '"');
                            fputs($fp, $valori['created_at'].",".$valori['expire_at'].",".$valori['name'].",".$valori['Transaction']['Sender']['first_name'].$valori['Transaction']['Sender']['last_name'].($valori['Friend'] ? '(For Friend: '.$valori['Friend']['first_name'].' '.$valori['Friend']['last_name'].')' : '').",".$valori['price'].",".$valori['code2']."\n");
                        }

                        fclose($fp);
                    }
                    header("Content-type: application/octet-stream");
                    header("Content-Disposition: attachment; filename=\"sold_vouchers.csv\"");

                    // citire fisier in string si afisare
                    echo file_get_contents($fisier);

                    die;
                }
                break;
            default:
                $l = '';
                $query = TransactionTable::getInstance()->getSentTransactions(array('sender_id' => $this->user->getUser()->get('id')));
                break;
        }

        $pagerLayout = new PagerLayoutWithArrows(
                        new Doctrine_Pager(
                                $query,
                                $page, 25),
                        new Doctrine_Pager_Range_Sliding(array(
                            'chunk' => 5
                        )),
                        '/my-account/transactions?page={%page_number}' . $l
        );
        $pagerLayout->setTemplate('<li><a href="{%url}">{%page}</a></li>');
        $pagerLayout->setSelectedTemplate('<li class="selected">{%page}</li>');

        // Fetching users
        $transactions = $pagerLayout->execute(array(), Doctrine::HYDRATE_ARRAY);
        $transactionType = array_flip(TransactionTable::$type);

        $transactionType[8] = 'Verification & Test Transaction';
        $transactionType[1] = 'Deal Purchase';
        
        if($view == 'cash_in_vouchers') {
            foreach($transactions as $key=>$transaction) {
                $hmm = Doctrine_Query::create()
                    ->select('t.*')
                    ->from('Transaction t')
                    ->addWhere('t.parent_id = ?', $transaction['transaction_id'])
                    ->addWhere('t.transaction_type = ?', TransactionTable::$type['do-share'])
                    ->fetchOne(array(), Doctrine::HYDRATE_ARRAY);
                    
                $transactions[$key]['merchant_share'] = $hmm;
            }
        }
        
        return array(
            'transactions' => $transactions,
            'pagination' => $pagerLayout->display(array(), true),
            'transactionType' => $transactionType,
            'view' => $view,
            'spendFee' => $spendFee,
            'transfer' => $transfer,
            'spent' => $spentT,
            'howmuch' => $howMuch,
            'form' => array(
                'values' => $form->getValues(),
                'errors' => $form->getMessages(),
                'success' => (isset($success) ? $success : false)
            ),
            'subview' => $subview
        );
    }

    public function detailAction() {
        $this->setTemplate('myaccount/transactions/details.twig');

        $id = $this->getParam('trans_id');
        if (!$id) {
            return $this->notFoundAction();
        }
        $transaction = TransactionTable::getInstance()->getUserTransactionDetails(array(
                    'id' => $id,
                    'user_id' => $this->user->getUser()->get('id')
                ))->fetchOne(array(), Doctrine::HYDRATE_ARRAY);

        if (!$transaction['id']) {
            return $this->notFoundAction();
        }

        $transactionType = array_flip(TransactionTable::$type);
        $transactionType[8] = 'Merchant Verification & Test Transaction';
        $transactionType[1] = 'Deal Purchase(from wallet)';
        $transactionType[80] = 'Deal Purchase(from wmw wallet)';

        return array(
            'transaction' => $transaction,
            'transactionType' => $transactionType
        );
    }

    public function couponTransactionDetailAction() {

        $this->setTemplate('myaccount/transactions/details.twig');

        $id = $this->getParam('trans_id');
        if (!$id) {
            return $this->notFoundAction();
        }

        $t = TransactionTable::getInstance()->createQuery()
                ->addWhere('parent_id = ?', $id)
                ->addWhere('transaction_type = ?', TransactionTable::$type['do-share'])
                ->fetchOne();

        $transaction = TransactionTable::getInstance()->createQuery()
                ->addWhere('parent_id = ?', $t['id'])
                ->addWhere('transaction_type = ?', TransactionTable::$type['do-share-do-receive'])
                ->addWhere('receiver_id = ?', $this->user->getUser()->get('id'))
                ->fetchOne();

        if (!$transaction['id']) {
            return $this->notFoundAction();
        }

        $transactionType = array_flip(TransactionTable::$type);
        $transactionType[8] = 'Merchant Verification & Test Transaction';
        $transactionType[1] = 'Deal Purchase';

        return array(
            'transaction' => $transaction,
            'transactionType' => $transactionType
        );
    }

    public function couponDetailAction() {
        $this->setTemplate('myaccount/transactions/couponDetails.twig');

        $id = $this->getParam('coupon_id');
        $getFriend = $this->getParam('friend');
        if (!$id) {
            return $this->notFoundAction();
        }
        if($getFriend) {
            $coupon = CouponTable::getInstance()->getFriendCouponDetails(array(
                    'id' => $id,
                    'friend_id' => $this->user->getUser()->get('id')
                ))->fetchOne(array(), Doctrine::HYDRATE_ARRAY);
            $this->setTemplate('myaccount/transactions/couponDetailsFriend.twig');
        } else {
            $coupon = CouponTable::getInstance()->getUserCouponDetails(array(
                        'id' => $id,
                        'owner_id' => $this->user->getUser()->get('id')
                    ))->fetchOne(array(), Doctrine::HYDRATE_ARRAY);

            if (!$coupon['id']) {
                $coupon = CouponTable::getInstance()->getRedeemedCouponDetails(array(
                            'id' => $id,
                            'user_id' => $this->user->getUser()->get('id')
                        ))->fetchOne(array(), Doctrine::HYDRATE_ARRAY);
                if (!$coupon['id']) {
                    return $this->notFoundAction();
                }
            }
        }
        //echo '<pre>';
        //print_r($coupon);die;
        $ac = $this->getParam('ac');
        //pdf
        if ($ac === 'pdf') {
            if ($coupon['friend'] && $coupon['friend_id'] <> $this->user->getUser()->get('id')) {
                return $this->notFoundAction();
            }
            $cost = new Zend_Currency(array('value' => $coupon['price'], 'symbol' => 'S$'), 'en_US');
            $date_start = date('D, d M Y H:i:s', strtotime($coupon['created_at']));
            $date_end = date('D, d M Y H:i:s', strtotime($coupon['expire_at']));

            ob_start();
            include_once ROOT_PATH . '/lib/dompdf/voucher.php';
            $voucher_content = ob_get_contents();
						print_r($voucher_content);
            ob_end_clean();

            include_once ROOT_PATH . '/lib/dompdf/dompdf_config.inc.php';
            $dompdf = new DOMPDF();
            $dompdf->set_paper('a4', 'portrait');
            $dompdf->load_html($voucher_content);
            $dompdf->render();

//$dompdf->stream('doc.pdf');
            $dompdf->stream($coupon['name'] . '-voucher.pdf');



//$pdfFileHandle = fopen($filePath.$fileName, 'w');
//file_put_contents($filePath.$fileName, $dompdf->output());
//fclose($pdfFileHandle);

            die;


            require(ROOT_PATH . '/lib/fpdf/fpdf.php');
            $pdf = new FPDF('P', 'mm', 'A5');
            $pdf->AddPage();
            $pdf->SetFont('Arial', '', 14);
            $pdf->Cell(40, 10, 'Offer: ' . $coupon['name']);
            $pdf->Ln();
            $pdf->Cell(40, 10, 'Quantity: ' . $coupon['quantity']);
            $pdf->Ln();
            $pdf->Cell(40, 10, 'Cost: ' . new Zend_Currency(array('value' => $coupon['price']), 'en_US'));
            $pdf->Ln();
            $pdf->Cell(40, 10, 'Created at: ' . date('D, d M Y H:i:s', strtotime($coupon['created_at'])));
            $pdf->Ln();
            $pdf->Cell(40, 10, 'Expires at: ' . date('D, d M Y H:i:s', strtotime($coupon['expire_at'])));
            $pdf->Ln();
            $pdf->SetTextColor(155);
            $pdf->SetFont('Arial', '', 11);
            $pdf->Cell(40, 10, 'Code: ' . $coupon['code']);

            $pdf->Output();
            die();
        }

        return array(
            'coupon' => $coupon,
            'user_id' => $this->user->getUser()->get('id')
        );
    }

    public function withdrawAction() {
        $view = $this->getParam('view');

        switch ($view) {
            case 'giro':

                $this->setTemplate('myaccount/withdrawGiro.twig');
                $user = $this->user->getUser();

                $form = new Zend_Form();
                
                $val = $form->createElement('text', 'val');
                $val->addValidator('Float', false)
                    ->addValidator('GreaterThan', true, array('min' => 50, 'messages' => 'Minimum is 50$ to withdraw'))
                    ->setRequired(true)
                    /* ->addValidator ('regex', false, array(
                    'pattern'=>'/^\d+(\d{1,5})?(\.\d{1,2})?$/',
                    'messages'=>array(
                    'regexInvalid'=>'required',
                    'regexNotMatch'=>'number required')
                    )) */
                    ->addFilter('StringToLower');
        
                $beneficiary_name = $form->createElement('text', 'beneficiary_name')->setRequired();
                
                $bank_code = $form->createElement('text', 'bank_code')->setRequired();
                $bank_branch_code = $form->createElement('text', 'bank_branch_code')->setRequired();
                $bank_account_number = $form->createElement('text', 'bank_account_number')->setRequired();
                //$bank_name = $form->createElement('text', 'bank_name')->setRequired();
                $bank_name = $form->createElement('select', 'bank_name');
                $bank_name->setRequired();
                
                $bank_name->addMultiOption('OCBC', 'OCBC');
                $bank_name->addMultiOption('UOB', 'UOB');
                $bank_name->addMultiOption('DBS', 'DBS');
                $bank_name->addMultiOption('StandardChartered', 'StandardChartered');
                $bank_name->addMultiOption('CitiBank', 'CitiBank');
                $bank_name->addMultiOption('HSBC ', 'HSBC');

            $bank_name->addValidator('InArray', false, array(array_keys($bank_name->getMultiOptions()), 'messages' =>'This option it is not in the original select values'));
                $bank_address = $form->createElement('text', 'bank_address')->setRequired();
                
                
                $form->addElement($val)->addElement($beneficiary_name)->addElement($bank_code)->addElement($bank_branch_code)->addElement($bank_account_number)->addElement($bank_name)
                        ->addElement($bank_address);
$requestStatus = WithdrawRequestTable::$status;
                if ($this->request->getPost()) {
                    if ($form->isValid($this->request->getPost())) {

                       $vv = round($form->getValue('val'), 2);
                        if ($vv > $user->wallet) {
                            $val->addError('Value is higher than the wallet');
                        } else {
                            $conn = Doctrine_manager::getInstance()->getCurrentConnection();
                            $conn->beginTransaction();
                            try {
                                $req = new WithdrawRequest();
                                $req->amount = $vv;
                                $req->type = 2;
                                $req->user_id = $user->id;
                                $req->status = $requestStatus['pending'];
                                
                                $req->beneficiary_name = $form->getValue('beneficiary_name');
                                $req->bank_code = $form->getValue('bank_code');
                                $req->bank_branch_code = $form->getValue('bank_branch_code');
                                $req->bank_account_number = $form->getValue('bank_account_number');
                                $req->bank_name = $form->getValue('bank_name');
                                $req->bank_address = $form->getValue('bank_address');
                                
                                $req->save();
                                //$user->wallet = $user->wallet - $vv;
                                //$user->save();
                                $query = 'UPDATE user SET wallet = wallet - :amount WHERE id = :user_id';
                                $result = $conn->execute($query, array('user_id' => $user->id, 'amount' => $vv));
                                $form->reset();
                                $success = true;
                                $conn->commit();
                            } catch (Exception $e) {
                                $conn->rollback();
                            }
                        }
                    }
                }

                
                $query = WithdrawRequestTable::getInstance()->getUserRequests(array('user_id' => $this->user->getUser()->get('id')));

        $pagerLayout = new PagerLayoutWithArrows(
                        new Doctrine_Pager(
                                $query,
                                $page, 25),
                        new Doctrine_Pager_Range_Sliding(array(
                            'chunk' => 5
                        )),
                        '/my-account/withdraw?view=giro&page={%page_number}'
        );
        $pagerLayout->setTemplate('<li><a href="{%url}">{%page}</a></li>');
        $pagerLayout->setSelectedTemplate('<li class="selected">{%page}</li>');

        // Fetching users
        $requests = $pagerLayout->execute(array(), Doctrine::HYDRATE_ARRAY);


        return array(
            'form' => array(
                'values' => $form->getValues(),
                'errors' => $form->getMessages(),
                'kkt' => $form->bank_name,
                'success' => (isset($success) ? $success : false)
            ),
            'requests' => $requests,
            'pagination' => $pagerLayout->display(array(), true),
            'requestStatus' => array_flip($requestStatus),
        );
              /*  return array(
                    'form' => array(
                        'values' => $form->getValues(),
                        'errors' => $form->getMessages(),
                        'success' => (isset($success) ? $success : false)
                    )
                );
*/
                break;
        }

        $this->setTemplate('myaccount/withdraw.twig');



        $form = new Zend_Form();
        $val = $form->createElement('text', 'val');
        $val->addValidator('Float', false)
                ->addValidator('GreaterThan', true, array('min' => 50, 'messages' => 'Minimum is 50$ to withdraw'))
                ->setRequired(true)
                /* ->addValidator ('regex', false, array(
                  'pattern'=>'/^\d+(\d{1,5})?(\.\d{1,2})?$/',
                  'messages'=>array(
                  'regexInvalid'=>'required',
                  'regexNotMatch'=>'number required')
                  )) */
                ->addFilter('StringToLower');
    $user = $this->user->getUser();
        $email = $form->createElement('text', 'paypal_email');
        $email->addValidator('emailAddress', false)
                ->setRequired(true)
                ->addFilter('StringToLower');
        $email->setValue($user->paypal_email);
        $form->addElement($email);
        
        $form->addElement($val);
        $requestStatus = WithdrawRequestTable::$status;
        
        if ($this->request->getPost()) {
            if ($form->isValid($this->request->getPost())) {
                $vv = round($form->getValue('val'), 2);
                if ($vv > $user->wallet) {
                    $val->addError('Value is higher than the wallet');
                } else {
                    $conn = Doctrine_manager::getInstance()->getCurrentConnection();
                    $conn->beginTransaction();
                    try {
                        $user->paypal_email = $form->getValue('paypal_email');
                        $user->save();
                        
                        $req = new WithdrawRequest();
                        $req->amount = $vv;
                        $req->type = 1;
                        $req->user_id = $user->id;
                        $req->status = $requestStatus['pending'];
                        $req->save();
                        //$user->wallet = $user->wallet - $vv;
                        //$user->save();
                        $query = 'UPDATE user SET wallet = wallet - :amount WHERE id = :user_id';
                        $result = $conn->execute($query, array('user_id' => $user->id, 'amount' => $vv));
                        $form->reset();
                        $success = true;
                        $conn->commit();
                    } catch (Exception $e) {
                        $conn->rollback();
                    }
                }
            }
        }

        $m = $this->getParam('m');

        if ($m == 'del') {
            $conn = Doctrine_manager::getInstance()->getCurrentConnection();
            $conn->beginTransaction();
            $wid = $this->getParam('wid');
            $hmm = WithdrawRequestTable::getInstance()->createQuery()
                    ->addWhere('id = ?', $wid)
                    ->addWhere('user_id = ?', $this->user->getUser()->get('id'))
                    ->addWhere('status = ?', WithdrawRequestTable::$status['pending'])
                    ->fetchOne();
            if ($hmm->id) {
                try {
                    $query = 'UPDATE user SET wallet = wallet + :amount WHERE id = :user_id';
                    $result = $conn->execute($query, array('user_id' => $user->id, 'amount' => $hmm->amount));
                    $hmm->delete();
                    $conn->commit();
                } catch (Exception $e) {
                    $conn->rollback();
                }
            }
        }

        $query = WithdrawRequestTable::getInstance()->getUserRequests(array('user_id' => $this->user->getUser()->get('id')));

        $pagerLayout = new PagerLayoutWithArrows(
                        new Doctrine_Pager(
                                $query,
                                $page, 25),
                        new Doctrine_Pager_Range_Sliding(array(
                            'chunk' => 5
                        )),
                        '/my-account/withdraw?page={%page_number}'
        );
        $pagerLayout->setTemplate('<li><a href="{%url}">{%page}</a></li>');
        $pagerLayout->setSelectedTemplate('<li class="selected">{%page}</li>');

        // Fetching users
        $requests = $pagerLayout->execute(array(), Doctrine::HYDRATE_ARRAY);


        return array(
            'form' => array(
                'values' => $form->getValues(),
                'errors' => $form->getMessages(),
                'success' => (isset($success) ? $success : false)
            ),
            'requests' => $requests,
            'pagination' => $pagerLayout->display(array(), true),
            'requestStatus' => array_flip($requestStatus),
        );
    }

    public function depositAction() {
        $view = $this->getParam('view');
        if($view == 'giro') {
            $this->setTemplate('myaccount/transactions/depositd.twig');
            $user = $this->user->getUser();

                $form = new Zend_Form();
                
                $val = $form->createElement('text', 'val');
                $val->addValidator('Float', false)
                    ->addValidator('GreaterThan', true, array('min' => 0, 'messages' => 'Minimum is 50$ to withdraw'))
                    ->setRequired(true)
                    /* ->addValidator ('regex', false, array(
                    'pattern'=>'/^\d+(\d{1,5})?(\.\d{1,2})?$/',
                    'messages'=>array(
                    'regexInvalid'=>'required',
                    'regexNotMatch'=>'number required')
                    )) */
                    ->addFilter('StringToLower');
        
                $beneficiary_name = $form->createElement('text', 'beneficiary_name')->setRequired();
                
                $bank_code = $form->createElement('text', 'bank_code')->setRequired();
                $bank_branch_code = $form->createElement('text', 'bank_branch_code')->setRequired();
                $bank_account_number = $form->createElement('text', 'bank_account_number')->setRequired();
                //$bank_name = $form->createElement('text', 'bank_name')->setRequired();
                $bank_name = $form->createElement('select', 'bank_name');
                $bank_name->setRequired();
                
                $bank_name->addMultiOption('OCBC', 'OCBC');
                $bank_name->addMultiOption('UOB', 'UOB');
                $bank_name->addMultiOption('DBS', 'DBS');
                $bank_name->addMultiOption('StandardChartered', 'StandardChartered');
                $bank_name->addMultiOption('CitiBank', 'CitiBank');
                $bank_name->addMultiOption('HSBC ', 'HSBC');

            $bank_name->addValidator('InArray', false, array(array_keys($bank_name->getMultiOptions()), 'messages' =>'This option it is not in the original select values'));
                $bank_address = $form->createElement('text', 'bank_address')->setRequired();
                
                
                $form->addElement($beneficiary_name)->addElement($bank_code)->addElement($bank_branch_code)->addElement($bank_account_number)->addElement($bank_name)
                        ->addElement($bank_address);
$requestStatus = WithdrawRequestTable::$status;
                if ($this->request->getPost()) {
                    if ($form->isValid($this->request->getPost())) {
                        $conn = Doctrine_manager::getInstance()->getCurrentConnection();
                        $conn->beginTransaction();
                        try {
                            $req = new DepositRequest();
                            //$req->amount = $vv;
                            $req->type = 2;
                            $req->user_id = $user->id;
                            $req->status = $requestStatus['pending'];

                            $req->beneficiary_name = $form->getValue('beneficiary_name');
                            $req->bank_code = $form->getValue('bank_code');
                            $req->bank_branch_code = $form->getValue('bank_branch_code');
                            $req->bank_account_number = $form->getValue('bank_account_number');
                            $req->bank_name = $form->getValue('bank_name');
                            $req->bank_address = $form->getValue('bank_address');

                            $req->save();
                            //$user->wallet = $user->wallet - $vv;
                            //$user->save();
                            $form->reset();
                            $success = true;
                            $conn->commit();
                        } catch (Exception $e) {
                            $conn->rollback();
                        }
                    }
                }
                $query = DepositRequestTable::getInstance()->getUserRequests(array('user_id' => $this->user->getUser()->get('id')));

            $pagerLayout = new PagerLayoutWithArrows(
                            new Doctrine_Pager(
                                    $query,
                                    $page, 25),
                            new Doctrine_Pager_Range_Sliding(array(
                                'chunk' => 5
                            )),
                            '/my-account/withdraw?view=giro&page={%page_number}'
            );
            $pagerLayout->setTemplate('<li><a href="{%url}">{%page}</a></li>');
            $pagerLayout->setSelectedTemplate('<li class="selected">{%page}</li>');

            // Fetching users
            $requests = $pagerLayout->execute(array(), Doctrine::HYDRATE_ARRAY);


            return array(
                'form' => array(
                    'values' => $form->getValues(),
                    'errors' => $form->getMessages(),
                    'kkt' => $form->bank_name,
                    'success' => (isset($success) ? $success : false)
                ),
                'requests' => $requests,
                'pagination' => $pagerLayout->display(array(), true),
                'requestStatus' => array_flip($requestStatus),
            );
        }
        
        $this->setTemplate('myaccount/transactions/deposit.twig');
        $mda = $this->getParam('m');
        if($mda) {
            $pf = SiteConfigTable::getInstance()->getPaypalFee();
            $pf = $pf['config_value'];
            $new = $mda+$mda*$pf/100;
            $mda = round(($new-$mda)*$pf/100+$new, 2);
        }
        $form = new Zend_Form();
        $val = $form->createElement('text', 'val');
        $val->addValidator('Float', false)
                ->addValidator('GreaterThan', true, array('min' => 0, 'messages' => 'Select a higher value'))
                ->setRequired(true)
                ->setValue($mda)
                /* ->addValidator ('regex', false, array(
                  'pattern'=>'/^\d+(\d{1,5})?(\.\d{1,2})?$/',
                  'messages'=>array(
                  'regexInvalid'=>'required',
                  'regexNotMatch'=>'number required')
                  )) */
                ->addFilter('StringToLower');

        $form->addElement($val);

        $user = $this->user->getUser();
        if ($this->request->getPost()) {
            if ($form->isValid($this->request->getPost())) {
                $vv = round($form->getValue('val'), 2);

                $user->wallet = $user->wallet + $vv;
                $user->save();

                $type = TransactionTable::$type;
                $sTran = new Transaction();
                $sTran->parent_id = $tran->id;
                $sTran->transaction_type = $type['deposit'];
                //the money from
                $sTran->sender_id = $this->user->getUser()->get('id');
                $sTran->receiver_id = $this->user->getUser()->get('id');

                $sTran->full_payment = $vv;
                $sTran->save();
                $success = true;
            }
        }

        return array(
            'form' => array(
                'values' => $form->getValues(),
                'errors' => $form->getMessages(),
                'success' => (isset($success) ? $success : false)
            ),
            'user_id' => $this->user->getUser()->get('id'),
            ''
        );
    }

    public function depositPaypalAction() {
        $temp_file = 'test.txt';
        $temp_handle = fopen($temp_file, 'w');
        fwrite($temp_handle, '1');
        fclose($temp_handle);
        ini_set('log_errors', true);
        ini_set('error_log', ROOT_PATH . '/ipn_errors.log');
        error_log('depositPaypalIPNAction');
        require_once(ROOT_PATH . '/lib/Cms/payment/paypal/ipnlistener.php');
        $listener = new IpnListener();
        //$listener->use_sandbox = true;
        try {
            $listener->requirePostMethod();
            $verified = $listener->processIpn();
        } catch (Exception $e) {
            error_log($e->getMessage());
            exit(0);
        }
        if ($verified) {
            error_log('ver');
            $vv = $listener->getVal();
            error_log($vv);
            if ($vv > 0) {
                $user = $this->user->getUser();
                $user->wallet = $user->wallet + $vv;
                $user->save();
                $type = TransactionTable::$type;
                $sTran = new Transaction();
                $sTran->parent_id = $tran->id;
                $sTran->transaction_type = $type['deposit'];
                //the money from
                $sTran->sender_id = $this->user->getUser()->get('id');
                $sTran->receiver_id = $this->user->getUser()->get('id');

                $sTran->full_payment = $vv;
                $sTran->save();
                $success = true;
            }
        } else {
            error_log('not');
        }
    }

}
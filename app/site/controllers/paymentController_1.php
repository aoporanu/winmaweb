<?php

class paymentController extends Cms_Controller
{
    /*
     * 
     */
    protected $cart;

    public function init() {
        $this->cart = new Zend_Session_Namespace('shopCart');
        $this->cart->setExpirationSeconds(600);
    }
    
    public function shopCartAction()
    {
        $this->setTemplate('payment/shopCart.twig');
        
        $ac = $this->getParam('ac');
        if ($ac === 'add') {
            $product_id = $this->getParam('product_id');
            if($product_id) {
                //$this->cart = array('product_id' => $product_id, 'qty' => 1);
                $this->cart->product_id = $product_id;
                $this->cart->qty = 1;
                $this->redirect('/shopping-cart');
            }
        }
        if ($ac === 'qty') {
            $i = $this->getParam('i');
            $this->cart->qty = $i;
            $this->redirect('/shopping-cart');
        }
        
        if(!$this->cart->product_id) {
            return array();
        }
        
        $productObj = ProductTable::getInstance()->getProductById(array('product_id' => $this->cart->product_id))->fetchOne(array());
        $product = $productObj->toArray();
        if($product['stock'] - $product['sold'] <= 0) {
            return array('err' => 'Product out of stock');
        }
        
        if($this->user->getUser())
        {
            if($product['user_id'] == $this->user->getUser()->get('id')) {
                return array('err' => 'You cannot buy your own products');
            }
        }
        
        $form = new Zend_Form();
        $qty = $form->createElement('select', 'cart_qty');
        $qty->setRequired();
        
        for($x = 1; $x <= $product['stock'] - $product['sold']; $x++){
            $qty->addMultiOption($x, $x);
        }
        
        $qty->addValidator('InArray', false, array(array_keys($qty->getMultiOptions()), 'messages' =>'This quantity value it is not in the original select values'))
                ->addValidator('GreaterThan', true, array('min' => 0, 'messages' => 'Please enter a positive number'))
                ->setValue(1);
        if($this->cart->qty > 1) {
            $qty->setValue($this->cart->qty);
        }
        if($this->cart->qty > $product['stock'] - $product['sold']) {
            $qty->setValue(1);
        }
        
        $form->addElement($qty);
        
         if( $this->request->getPost() ) {
            if ($form->isValid($this->request->getPost())) {
                $err = 0;
                //check if the user is authentificated
                if (!$this->user->isAuthenticated()) {
                    $err = 1;
                    $form->addError('You need to be logged in before you can buy something.');
                }
                //check if the product exist
                if (!$product['id']) {
                    $err = 1;
                    $form->addError('This product do not exist.');
                }
                //check if the user has enough money in wallet
                $quantity = $form->getValue('cart_qty');
                if ($product['id'] && ($this->user->getUser()->get('wallet') < $product['price'] * $quantity)) {
                    $err = 1;
                    $form->addError('You do not have enought money in your wallet to buy this product, please add more money in order to buy this product.');
                }
                //check product stock
                
                if($product['stock'] <= 0 || ($product['stock'] - $product['sold'] < $quantity)) {
                    $err = 1;
                    $form->addError('This product is out of stock.');
                }
                //all is ok
                if($err == 0) {
                    $price = $quantity*$product['price'];
                    $amount = 0;
                    $transactions = array();
                    //lets get the site fee
                    $factor = SiteConfigTable::getInstance()->getSiteFee();
                    $factor = (int)$factor['config_value'];
                    
                    //lets get the % of each commission level
                    $rootLevel = Doctrine_Core::getTable('Level')->find(1);
                    $rootLevel = $rootLevel->getNode()->getChildren();
                    $commission = array();
                    $x = 1;
                    foreach($rootLevel as $level) {
                        $commission[$x] = $level['commission'];
                        $x++;
                    }
                    // merchant commission
                    $mCommission = SiteConfigTable::getInstance()->getOfferCommission();
                    $mCommission = (int)$mCommission['config_value'];
                    
                    //how many levels we need to get from this user up
                    $levels = $x - 1;
                    

                    $conn = Doctrine_manager::getInstance()->getCurrentConnection();
                    $conn->beginTransaction();
                    $type = TransactionTable::$type;

                    //first transaction, here we deduct from the buyer wallet the money and we also create a transaction for that
                    $tran = new Transaction();
                    $tran->parent_id = 0;
                    $tran->transaction_type = $type['buy'];
                    $tran->sender_id = $this->user->getUser()->get('id');
                    $tran->receiver_id = $product['user_id'];

                    $tran->product_id = $product['id'];
                    $tran->product_name = $product['name'];
                    $tran->product_price = $product['price'];
                    $tran->quantity = $quantity;
                    $tran->full_payment = -$price;
                    $tran->save();
                    if($tran->id) {
                        //here we deduct the money from his wallet
                        $buyer = $this->user->getUser();
                        $buyer->wallet = $buyer->wallet - $price;
                        try {
                            $buyer->save();
                            //now here we create the second transaction, this transaction is for the seller(the one who receive the money)
                            $sTran = new Transaction();
                            $sTran->parent_id = $tran->id;
                            $sTran->transaction_type = $type['sell'];
                            //the money from
                            $sTran->sender_id = $this->user->getUser()->get('id');
                            $sTran->receiver_id = $product['user_id'];

                            $sTran->product_id = $product['id'];
                            $sTran->product_name = $product['name'];
                            $sTran->product_price = $product['price'];
                            $sTran->quantity = $quantity;
                            $sTran->full_payment = $price;
                            $sTran->save();

                            if($sTran->id) {
                                //ok both transaction were succesffuly
                                //now lets add the site fee transactions along with site payments to diferent ancestors of the seller
                                //first is the site fee, we send this money to the root user (root user is also the banker and the root)
                                //root user has always id: 2
                                $receiversTran = new Doctrine_Collection('Transaction');
                                $usersWallet = new Doctrine_Collection('User');
                                
                                $feeTotal = 0;
                                $amount = 0;
                                //
                                //  Offer commission
                                //
                                $offerCommission = SiteConfigTable::getInstance()->getOfferCommission();
                                $offerCommission = (int)$offerCommission['config_value'];
                                
                                if($offerCommission > 0) {
                                    $fee = round($price*$offerCommission/100, 2);
                                    $feeTotal = $feeTotal + $fee;
                                    $ocTran = new Transaction();
                                    //$feeTran->parent_id = 0;
                                    //root(banker) user receive the site fee as a normal "receive" transaction
                                    $ocTran->transaction_type = $type['offer-commission'];
                                    //the money from
                                    $ocTran->sender_id = 2; //the bank send him this money, just for evaluation
                                    $ocTran->receiver_id = $product['user_id'];
                                    $ocTran->full_payment = $fee;
                                    $ocTran->hint = 'Offer commission ('. $fee .')';
                                    $receiversTran->add($ocTran);
                                }
                                //first calculation //this might be 0 
                                $amount = $price - round($price*$offerCommission/100, 2);
                                
                                if($siteFee > 0) {
                                    $fee = round($amount*$siteFee/100, 2);
                                    $feeTotal = $feeTotal + $fee;
                                    $feeTran = new Transaction();
                                    //$feeTran->parent_id = 0;
                                    //root(banker) user receive the site fee as a normal "receive" transaction
                                    $feeTran->transaction_type = $type['receive-site-fee'];
                                    //the money from
                                    $feeTran->sender_id = $product['user_id'];
                                    $feeTran->receiver_id = 2;
                                    $feeTran->full_payment = $fee;
                                    $feeTran->hint = 'Site fee received ('. $fee .')';
                                    $receiversTran->add($feeTran);
                                    
                                    $rootUser = UserTable::getInstance()->find(2);
                                    $rootUser->wallet = $rootUser->wallet + $fee;
                                    $rootUser->save();
                                }
                                $amount = $amount - round($price*$siteFee/100, 2);

                                if($levels > 0) {
                                    $parents = UserTable::getInstance()->getAscendents(array(
                                        'user_id'   => $product['user_id']), $levels);
                                    $y = 1;
                                    if(count($parents)) {
                                        foreach($parents AS $parent) {
                                            //we skip first level, as is the product user_id, we need whats above him
                                            if($parent['lvl'] > 1) {
                                                //amount
                                                if($commission[$y] > 0) {
                                                    $amount = $amount - round($amount*$commission[$y]/100, 2);
                                                    $feeTotal = $feeTotal + round($amount*$commission[$y]/100, 2);
                                                    //create transaction to send to this user ancestors, 
                                                    $receiveTran = new Transaction();
                                                    //$receiveTran->parent_id = $feeTran->id;
                                                    $receiveTran->transaction_type = $type['receive'];
                                                    //the money from
                                                    $receiveTran->sender_id = $product['user_id'];
                                                    $receiveTran->receiver_id = $parent['_id'];
                                                    $receiveTran->hint = 'Commission received ('. round($amount*$commission[$y]/100, 2).'), this will be sent in virtual_wallet';
                                                    $receiveTran->full_payment = round($amount*$commission[$y]/100, 2);
                                                    $receiversTran->add($receiveTran);
                                                    
                                                    //update each parent's virtual wallet
                                                    $parentUser = UserTable::getInstance()->find($parent['_id']);
                                                    $parentUser->virtual_wallet = $parentUser->virtual_wallet + round($amount*$commission[$y]/100, 2);
                                                    $usersWallet->add($parentUser);
                                                    
                                                }
                                                $y++;
                                            }
                                        }
                                    }
                                }

                                //$receiversTran->save();
                                //$conn->commit();
                                if($receiversTran->count()) {
                                    //Now we create the site fee for the user to see, this is the sum of all others, but the user dont need to know all that info
                                    $sf = new Transaction();
                                    $sf->transaction_type = $type['site-fee'];
                                    $sf->parent_id = $sTran->id;
                                    $sf->sender_id = $product['user_id'];
                                    $sf->receiver_id = 2;
                                    $sf->full_payment = -$feeTotal;
                                    $sf->hint = 'Site fee sent this is just for the sender ('. ($feeTotal) .')';
                                    $sf->save();
                                    if($sf->id) {
                                        //we add all site commisions/fees to this parent transaction
                                        foreach($receiversTran as $t){
                                            $t->parent_id = $sf->id;
                                        }
                                        try {
                                            $receiversTran->save();
                                            $usersWallet->save();
                                        }catch(Doctrine_Exception $e) {
                                            $form->addError('There was a error. Everything was rolled back, please try again later.');
                                            $conn->rollback();
                                        }
                                    } else {
                                        $form->addError('There was a error. Everything was rolled back, please try again later.');
                                        $conn->rollback();
                                    }
                                }

                                //now lets add the money to the seller virtual_wallet
                                $seller = UserTable::getInstance()->find($product['user_id']);
                                if($seller->id) {
                                    $realAmount = $price - $feeTotal;
                                    $seller->virtual_wallet = $seller->virtual_wallet + $realAmount;
                                    try {
                                        //money added
                                        $seller->save();
                                        $productObj->sold = $productObj->sold + $quantity;
                                        $productObj->save();
                                        //that was it
                                        //now lets commit
                                        $conn->commit();
                                        unset($this->cart->qty);
                                        unset($this->cart->product_id);
                                        $this->redirect('/my-account/transactions');
                                    }catch(Doctrine_Exception $e) {
                                        $form->addError('There was a error. Everything was rolled back, please try again later.');
                                        $conn->rollback();
                                    }
                                } else {
                                    $form->addError('There was a error. Everything was rolled back, please try again later.');
                                    $conn->rollback();
                                }
                            } else {
                                $form->addError('There was a error. Everything was rolled back, please try again later.');
                                $conn->rollback();
                            }
                        }catch(Doctrine_Exception $e) {
                            $form->addError('There was a error. Everything was rolled back, please try again later.');
                            $conn->rollback();
                        }


                    } else {
                        $form->addError('There was a error. Everything was rolled back, please try again later.');
                        $conn->rollback();
                    }
                //}
                    
                }
            }
         }
        
        return array(
            'product' => $product,
            'form' => array(
                        'values' => $form->getValues(),
                        'errors' => $form->getMessages(),
                        'qtys'  => $form->cart_qty,
                        'success' => (isset($success) ? $success : false)
                    )
            );
    }
    
    public function paypalIPNAction()
    {
        /*
        Since this script is executed on the back end between the PayPal server and this
        script, you will want to log errors to a file or email. Do not try to use echo
        or print--it will not work! 

        Here I am turning on PHP error logging to a file called "ipn_errors.log". Make
        sure your web server has permissions to write to that file. In a production 
        environment it is better to have that log file outside of the web root.
        */
        ini_set('log_errors', true);
        ini_set('error_log', ROOT_PATH.'/ipn_errors.log');


        // instantiate the IpnListener class
        require_once(ROOT_PATH . '/lib/cms/payment/paypal/ipnlistener.php');
        $listener = new IpnListener();
        $listener->use_sandbox = true;

        try {
            $listener->requirePostMethod();
            $verified = $listener->processIpn();
        } catch (Exception $e) {
            error_log($e->getMessage());
            exit(0);
        }


        /*
        The processIpn() method returned true if the IPN was "VERIFIED" and false if it
        was "INVALID".
        */
        if ($verified) {
            /*
            Once you have a verified IPN you need to do a few more checks on the POST
            fields--typically against data you stored in your database during when the
            end user made a purchase (such as in the "success" page on a web payments
            standard button). The fields PayPal recommends checking are:

                1. Check the $_POST['payment_status'] is "Completed"
                    2. Check that $_POST['txn_id'] has not been previously processed 
                    3. Check that $_POST['receiver_email'] is your Primary PayPal email 
                    4. Check that $_POST['payment_amount'] and $_POST['payment_currency'] 
                       are correct

            Since implementations on this varies, I will leave these checks out of this
            example and just send an email using the getTextReport() method to get all
            of the details about the IPN.  
            */
            //mail('YOUR EMAIL ADDRESS', 'Verified IPN', $listener->getTextReport());
            error_log('ver');
            error_log($listener->getTextReport());

        } else {
            /*
            An Invalid IPN *may* be caused by a fraudulent transaction attempt. It's
            a good idea to have a developer or sys admin manually investigate any 
            invalid IPN.
            */
            //mail('YOUR EMAIL ADDRESS', 'Invalid IPN', $listener->getTextReport());
            error_log('not');
            error_log($listener->getTextReport());
        }
        
        die();
    }
}
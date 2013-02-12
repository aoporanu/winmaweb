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
    
    function base_encode($num, $alphabet) {
        $base_count = strlen($alphabet);
        $encoded = '';
        while ($num >= $base_count) {
        $div = $num/$base_count;
        $mod = ($num-($base_count*intval($div)));
        $encoded = $alphabet[$mod] . $encoded;
        $num = intval($div);
        }

        if ($num) $encoded = $alphabet[$num] . $encoded;

        return $encoded;
    }
    
    public function shopCartAction()
    {
        $this->setTemplate('payment/shopCart.twig');
        
        $ac = $this->getParam('ac');
        if ($ac === 'add') {
            $product_id = $this->getParam('product_id');
            $option_id = $this->getParam('option_id');
            $friend = $this->getParam('friend');
            if($product_id) {
                $this->cart->products[$product_id] = array('product_id' => $product_id, 'qty' => 1, 'option_id' => $option_id, 'friend' => $friend);
                $this->cart->friend = $friend;
                //$this->cart->product_id = $product_id;
                //$this->cart->option_id = $option_id;
                //$this->cart->qty = 1;
                //$this->cart->friend = $friend;
                $this->redirect('/shopping-cart');
            }
        }
        if ($ac === 'qty') {
            $product_id = $this->getParam('product_id');
            $i = $this->getParam('i');
            if($product_id) {
                $this->cart->products[$product_id]['qty'] = $i;
                $this->redirect('/shopping-cart');
            }
        }
        if ($ac === 'remove') {
            $product_id = $this->getParam('product_id');
            if($product_id) {
                unset($this->cart->products[$product_id]);
                $this->redirect('/shopping-cart');
            }
        }
        if($this->user->isAuthenticated()) {
            $mdaUSER = $this->user->getUser();
            if(empty($mdaUSER->phone) || empty($mdaUSER->first_name) || empty($mdaUSER->last_name) || empty($mdaUSER->gender) || empty($mdaUSER->age) 
                    || empty($mdaUSER->UserAddress->address)|| empty($mdaUSER->UserAddress->city)|| empty($mdaUSER->UserAddress->county)|| empty($mdaUSER->UserAddress->postcode)) {
                return array('err' => 22);
            }
        }
        $form = new Zend_Form();
        foreach($this->cart->products AS $shopCartProduct) {
            if(!$shopCartProduct['product_id'] || !$shopCartProduct['option_id']) {
                unset($this->cart->products);
                return array();
                //unset($this->cart->products[])
            }

            $productObj = ProductTable::getInstance()->getProductById(array('product_id' => $shopCartProduct['product_id']))->fetchOne(array());
            
            $product = $productObj->toArray();

            $optionObj = ProductPriceTable::getInstance()->find($shopCartProduct['option_id']);
            $products[$product['id']] = $productObj;
            $options[$product['id']] = $optionObj;
            //print_r($options);
            if($shopCartProduct['product_id'] <> $optionObj->product_id) {
                //return array();
            }

            if($optionObj->sold >= $optionObj->stock) {
                unset($this->cart->products[$product['id']]);
                unset($products[$product['id']]);
                //return array('err' => 'Offer sold out');
            }

            /*if($this->user->getUser())
            {
                if($product['user_id'] == $this->user->getUser()->get('id')) {
                    return array('err' => 'You cannot buy your own products');
                }
            }*/

            

            $op = $form->createElement('select', 'cart_op_'.$product['id']);
            $op->setRequired();

            $hh = ProductPriceTable::getInstance()->getProductPrices(array('product_id' => $product['id']))->execute(array(), Doctrine::HYDRATE_ARRAY);
            foreach($hh as $h) {
                $op->addMultiOption($h['id'], $h['name']);
            }

            $op->addValidator('InArray', false, array(array_keys($op->getMultiOptions()), 'messages' =>'This option it is not in the original select values'))
                    ->setValue($shopCartProduct['option_id']);

            $qty = $form->createElement('select', 'cart_qty_'.$product['id']);
            $qty->setRequired();

    //        for($x = 1; $x <= $optionObj->stock - $optionObj->sold; $x++){
                                    if ($optionObj->stock - $optionObj->sold > $product['max_buy']) {
                                            $max_buy = $product['max_buy'];
                                    } else {
                                            $max_buy = $optionObj->stock - $optionObj->sold;
                                    }
                                    for($x = 1; $x <= $max_buy; $x++){
                $qty->addMultiOption($x, $x);
            }

            $qty->addValidator('InArray', false, array(array_keys($qty->getMultiOptions()), 'messages' =>'This quantity value it is not in the original select values'))
                    ->addValidator('GreaterThan', true, array('min' => 0, 'messages' => 'Please enter a positive number'))
                    ->setValue(1);
            if($shopCartProduct['qty'] > 1) {
                $qty->setValue($shopCartProduct['qty']);
            }
            if($shopCartProduct['qty'] > $optionObj->stock - $optionObj->sold) {
                $qty->setValue(1);
            }
            //for form
            
            $form->addElement($qty);
            $form->addElement($op);
            $formMDA[$product['id']]['options'] = $op->getMultiOptions();
            $formMDA[$product['id']]['qty'] = $qty->getMultiOptions();
            
        } //foreach
        
        
        if($this->cart->friend == 1) {
            /*$femail = $form->createElement('text', 'email');
            $femail->addValidator('emailAddress', false)
                    ->setRequired()
                    ->addFilter('StringToLower');
            
            $freemail = $form->createElement('text', 'reemail');
            $freemail->addValidator('emailAddress', false)
                    ->setRequired()
                    ->addFilter('StringToLower');
            */
            $ref = $form->createElement('text', 'ref');
            $ref->setRequired()
                    ->addFilter('StringToLower');
            
            $msg = $form->createElement('textarea', 'message');
            
            $form->addElement($ref)
                    ->addElement($msg);
        }
        
         if( $this->request->getPost() ) {
            if ($form->isValid($this->request->getPost())) {
                $err = 0;
                //check if the user is authentificated
                if (!$this->user->isAuthenticated()) {
                    $err = 1;
                    $form->addError('You need to be logged in before you can buy something.');
                }
                $showDepositButton = false;
                $totalCHK = 0;
                if(!$this->cart->products) {
                    $err = 1;
                    $form->addError('No products.');
                }
                if($this->cart->friend) {
                    $fr = UserTable::getInstance()->findOneBy('ref_id', $form->getValue('ref'));
                    if(!$fr->id) {
                        $err = 1;
                        $form->addError('No user whit that referral id.');
                    }
                }
                
                foreach($this->cart->products AS $shopCartProduct) {
                    $productObj = ProductTable::getInstance()->getProductById(array('product_id' => $shopCartProduct['product_id']))->fetchOne(array());
                    $product = $productObj->toArray();

                    $optionObj = ProductPriceTable::getInstance()->find($shopCartProduct['option_id']);
                    //check if the product exist
                    if (!$product['id']) {
                        $err = 1;
                        $form->addError('This product do not exist(#'.$shopCartProduct['product_id'].').');
                    }
                    
                    if($this->cart->friend == 1) {
                        if($form->getValue('email') != $form->getValue('reemail')) {
                            $err = 1;
                            $form->addError('Friend email do not correspond in the retype email field.');
                        }
                    }
                    //check if the user has enough money in wallet
                    $quantity = $form->getValue('cart_qty_'.$product['id']);
                    //$showDepositButton = false;
                    if ($shopCartProduct['id'] && ($this->user->getUser()->get('wallet') < $optionObj->get('price') * $quantity)) {
                        $err = 1;
                        $form->addError('You do not have enought money in your wallet to buy this product, please add more money in order to buy this product.');
                        $showDepositButton = true;
                    }
                    
                    //check product stock

                    if($optionObj->get('stock') <= 0 || ($optionObj->get('stock') - $optionObj->get('sold') < $quantity)) {
                        $err = 1;
                        $form->addError('This product is out of stock.');
                    }
                    $totalCHK = $totalCHK + $optionObj->get('price') * $quantity;
                    if($this->cart->products[$product['id']]['qty'] > $product['max_buy']) {
                        $err = 1;
                        $form->addError('The quantity is higher than maximum available number you can buy');
                    }

                    
                    
                    if($this->cart->friend == 1) {
                        $count = TransactionTable::getInstance()->createQuery('t')
                            ->select('sum(t.quantity) as s, t.id')
                            ->addWhere('transaction_type = ?', TransactionTable::$type['buy'])
                            ->addWhere('sender_id = ?', $fr->id)
                            ->addWhere('product_id = ?', $product['id'])
                            //->groupBy('id')
                            ->fetchOne();
                        
                        $couponCount = CouponTable::getInstance()->createQuery('c')
                            ->select('c.*, t.*')
                            ->leftJoin('c.Transaction t')
                            ->addWhere('c.friend_id = ?', $fr->id)
                            ->addWhere('transaction_type = ?', TransactionTable::$type['buy'])
                            //->addWhere('sender_id = ?', $this->user->getUser()->get('id'))
                            ->addWhere('product_id = ?', $product['id'])
                            //->groupBy('id')
                            ->count();
                        if($product['max_buy'] < ($count->s + $couponCount + $this->cart->products[$product['id']]['qty'])) {
                            $err = 1;
                            $form->addError('Your friend already bought the maximum available number of this deal('.$product['name'].').');
                        }
                    } else {
                        $count = TransactionTable::getInstance()->createQuery('t')
                                ->select('sum(t.quantity) as s, t.id')
                                ->addWhere('transaction_type = ?', TransactionTable::$type['buy'])
                                ->addWhere('sender_id = ?', $this->user->getUser()->get('id'))
                                ->addWhere('product_id = ?', $product['id'])
                                //->groupBy('id')
                                ->fetchOne();
                        $couponCount = CouponTable::getInstance()->createQuery('c')
                                ->select('c.*, t.*')
                                ->leftJoin('c.Transaction t')
                                ->addWhere('c.friend_id = ?', $this->user->getUser()->get('id'))
                                ->addWhere('transaction_type = ?', TransactionTable::$type['buy'])
                                //->addWhere('sender_id = ?', $this->user->getUser()->get('id'))
                                ->addWhere('product_id = ?', $product['id'])
                                //->groupBy('id')
                                ->count();

                        if($product['max_buy'] < ($count->s + $couponCount + $this->cart->products[$product['id']]['qty'])) {
                            $err = 1;
                            $form->addError('You already bought the maximum available number of this deal('.$product['name'].').');
                        }
                    }
                }
                //if($product['max_buy'] <= ($count->s + $this->cart->qty)) {
                 //   $err = 1;
                  //  $form->addError('You allready bought the maximum available number of this deal1 ('.$count->s.')');
                //}
                
                if($this->user->getUser()->get('wallet') < $totalCHK) {
                    $err = 1;
                    $form->addError('You do not have enought money');
                    $showDepositButton = true;
                }
                //all is ok
                if($err == 0) {
                    foreach($this->cart->products AS $shopCartProduct) {
                        $productObj = ProductTable::getInstance()->getProductById(array('product_id' => $shopCartProduct['product_id']))->fetchOne(array());
                        $product = $productObj->toArray();

                        $optionObj = ProductPriceTable::getInstance()->find($shopCartProduct['option_id']);
                        $quantity = $form->getValue('cart_qty_'.$product['id']);
                        $price = $quantity*$optionObj->get('price');
                        $amount = 0;
                        $transactions = array();
                        //lets get the site fee
                        //$factor = SiteConfigTable::getInstance()->getSiteFee();
                        //$factor = (int)$factor['config_value'];
                        $factor = (int)$product['factor'];
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
                        $status = TransactionTable::$status;

                        //first transaction, here we deduct from the buyer wallet the money and we also create a transaction for that, the money goes to bank
                        

                        try {
                            $price = $optionObj->get('price');
                            //now lets create the coupon :), not yet, we create the cuppon after the deal is on
                            //first we generate the code, also with the number 
                            $chars = "23456789ABCDEFGHJKLMNPQRSTUVWXYZ";
                            $alphabet = '23456789ABCDEFGHJKLMNPQRSTUVWXYZ';
                            $res = "";
                            for($k = 0; $k < $quantity;$k++) {
                                //echo $k;
                                    $tran = new Transaction();
                                    $tran->parent_id = 0;
                                    $tran->transaction_type = $type['buy'];
                                    $tran->status = $status['stand-by'];
                                    $tran->sender_id = $this->user->getUser()->get('id');
                //                    $tran->receiver_id = $product['user_id'];
                                    $tran->receiver_id = $product['merchant_user_id'] == '0' ? $product['user_id'] : $product['merchant_user_id'];

                                    $tran->product_id = $product['id'];
                                    $tran->product_name = $optionObj->name;
                                    $tran->product_price = $optionObj->price;
                                    $tran->quantity = 1;
                                    $tran->full_payment = -$price;
                                    $tran->save();
                                    $res = $this->base_encode($tran->id.$k, $alphabet);
                                    for ($i = 0; $i < 10; $i++) {
                                        $res .= $chars[mt_rand(0, strlen($chars)-1)];
                                    }
                                    $mt = explode(' ', microtime());
                                    $res2 = $this->base_encode($mt[1].$k, $alphabet);
                                    for ($i = 0; $i < 10; $i++) {
                                        $res2 .= $chars[mt_rand(0, strlen($chars)-1)];
                                    }

                                    $coupon = new Coupon();
                                    $coupon->transaction_id = $tran->id;
                                    $coupon->owner_id = $this->user->getUser()->get('id');
                                    $coupon->name = $optionObj->name;
                                    $coupon->quantity = 1;
                                    $coupon->price = $price;
                                    //we create the unq code with microtime and main transaction id
                                    $coupon->code = $res;
                                    $coupon->code2 = $res2;
                                    $coupon->expire_at = $optionObj->expire_at;
                                    $coupon->status = CouponTable::$status['stand-by'];

                                    if($this->cart->friend == 1) {
                                        $coupon->friend = 1;
                                        //$coupon->email = $form->getValue('email');
                                        $coupon->friend_id = $fr->id;
                                        $coupon->msg = $form->getValue('message');
                                    }

                                    $coupon->save();
                                //not yet
                                //}//end quantity

                                //we deduct the price from the user wallet
                                //$buyer = $this->user->getUser();
                                //$buyer->wallet = $buyer->wallet - $price;
                                //$buyer->save();
                                $query = 'UPDATE user SET wallet = wallet - :price WHERE id = :user_id';
                                $result = $conn->execute($query, array('user_id' => $this->user->getUser()->get('id'), 'price' => $price));

                                //now we create the factor transaction, and also calculate the factor
                                $bankShare = round($price*$factor/100, 2);
                                $doShare = $price - $bankShare;
                                //first we create the type[do-share], as this will get in standby
                                $doTran = new Transaction();
                                $doTran->parent_id = $tran->id; // parent transaction, is the main buy transaction
                                $doTran->transaction_type = $type['do-share'];
                                $doTran->sender_id = $this->user->getUser()->get('id');
                                $doTran->receiver_id = $tran->receiver_id;
                                $doTran->status = $status['stand-by']; //we put this this one in stand by, it wont go to anyone wallet yet
                                $doTran->full_payment = $doShare;
                                $doTran->hint = 'Deal owner share received ('. $doShare .'), this will remain in stand-by, until the deal owner use the coupon code';
                                $doTran->product_id = $tran->product_id;
                                $doTran->product_name = $tran->product_name;
                                $doTran->product_price = $tran->product_price;
                                $doTran->quantity = 1;
                                $doTran->save();
                                //now we create the bank share type, as this will also have subtransactions with merchant/user commission levels and actualy how much bank receive
                                if($bankShare > 0) {
                                    $bankTran = new Transaction();
                                    $bankTran->parent_id = $tran->id; // parent transaction, is the main buy transaction
                                    $bankTran->transaction_type = $type['bank-share'];
                                    $bankTran->sender_id = $this->user->getUser()->get('id');
                                    $bankTran->receiver_id = UserTable::BANK_ID;
                                    $bankTran->full_payment = $bankShare;
                                    $bankTran->status = $status['stand-by']; //we put this this one in stand by, it wont go to anyone wallet yet
                                    $bankTran->hint = 'Bank share received ('. $bankShare .'), this will be split in other transactions, to see how much each person get';
                                    $bankTran->product_id = $tran->product_id;
                                    $bankTran->product_name = $tran->product_name;
                                    $bankTran->product_price = $tran->product_price;
                                    $bankTran->quantity = 1;
                                    $bankTran->save();
                                }
                                $receiversTran = new Doctrine_Collection('Transaction');
                                //$usersWallet = new Doctrine_Collection('User');
                                $amount = $bankShare;
                                $userLevelCommission = 0;
                                //now lets calculate user level commissions, this is for the buyer ascendets and NOT seller ascendents
                                if($levels > 0) {
                                    $parents = UserTable::getInstance()->getAscendents(array(
                                                'user_id'   => $this->user->getUser()->get('id')), $levels);
                                    $y = 1;
                                    if(count($parents)) {
                                        foreach($parents AS $parent) {
                                            //we skip first level, as is the product user_id, we need whats above him
                                            if($parent['lvl'] > 1) {
                                                //amount
                                                if($commission[$y] > 0) {
                                                    //amount is from bank share
                                                    //$c = floor($bankShare*$commission[$y]/100);
                                                    $c = round($bankShare*$commission[$y]/100, 2);
                                                    if($c > 0) { // there might be a posibility with floor :x
                                                        $userLevelCommission = $userLevelCommission + $c;

                                                        //create transaction to send to this user ancestors, 
                                                        $receiveTran = new Transaction();
                                                        $receiveTran->transaction_type = $type['level-commission'];
                                                        $receiveTran->parent_id = $tran->id; // parent transaction is the bank share tran//UPDATE parent transaction is  main transaction
                                                        //the money from
                                                        $receiveTran->sender_id = UserTable::BANK_ID;
                                                        $receiveTran->receiver_id = $parent['_id'];
                                                        $receiveTran->hint = 'User level('.$y.') commission received ('. $c .'), this will be sent in virtual_wallet';
                                                        //ddd
                                                        
                                                        $receiveTran->product_id = $tran->product_id;
                                                        $receiveTran->product_name = $tran->product_name;
                                                        $receiveTran->product_price = $tran->product_price;
                                                        $receiveTran->quantity = 1;
                                                        
                                                        $receiveTran->full_payment = $c;                                                                                                                                               $receiveTran->product_id = $product['id'];
                                                        $receiveTran->status = $status['stand-by']; //status standby, as this might be reverted if the deal is not on
                                                        $receiversTran->add($receiveTran);

                                                        //update each parent's virtual wallet
                                                        //echo $parent['_id'] .' - '.$c.'<br/>';
                                                        //$parentUser = UserTable::getInstance()->find($parent['_id']);
                                                        //$parentUser->virtual_wallet = $parentUser->virtual_wallet + $c;
                                                        //$usersWallet->add($parentUser);
                                                        //$parentUser->save();
                                                    }
                                                }
                                                $y++;
                                            }
                                        }
                                    }
                                }

                                //now we calculate the merchant commission(offer commission) this will go to the merchant virtual wallet
                                if($mCommission > 0) {
                                    //$c = floor($bankShare*$mCommission/100);
                                    $c = round($bankShare*$mCommission/100, 2);
                                    if($c > 0) {
                                        $userLevelCommission = $userLevelCommission + $c;

                                        $receiveTran = new Transaction();
                                        $receiveTran->transaction_type = $type['merchant-commission'];
                                        $receiveTran->parent_id = $tran->id; // parent transaction is the bank share tran//UPDATE parent_id is the buy transaction
                                        //$receiveTran->parent_id = $bankTran->id; //UPDATE agent commission is the bank share tran(comission after the wmw fator)
                                        //the money from
                                        $receiveTran->sender_id = UserTable::BANK_ID;
                                        $receiveTran->receiver_id = $product['user_id']; //this goes to merchant
        //                                $receiveTran->hint = 'Merchant commission received ('. $c .'), this will be sent in virtual_wallet';
                                        $receiveTran->hint = 'Agent commission received ('. $c .'), this will be sent in virtual_wallet';
                                        $receiveTran->full_payment = $c;
                                        //we also show the merchant who bought his product and witch product
                                        $receiveTran->product_id = $product['id'];
                                        $receiveTran->product_name = $optionObj->name;
                                        $receiveTran->product_price = $optionObj->price;
                                        $receiveTran->status = $status['stand-by']; //status standby, as this might be reverted if the deal is not on
                                        $receiveTran->quantity = 1;

                                        $receiversTran->add($receiveTran);

                                        //update each parent's virtual wallet
                                        //$parentUser = UserTable::getInstance()->find($product['user_id']);
                                        //$parentUser->virtual_wallet = $parentUser->virtual_wallet + $c;
                                        //$parentUser->save();
                                        //$usersWallet->add($parentUser);
                                    }
                                }
                                //now we calculate the bank share, what actualy left for the bank, and we also make a transaction and we also put this in bank wallet
                                $bankRealShare = $bankShare - $userLevelCommission;
                                if($bankRealShare > 0) {
                                    $receiveTran = new Transaction();
                                    $receiveTran->transaction_type = $type['bank-share-left'];
                                    //$receiveTran->parent_id = $bankTran->id; // parent transaction is the bank share tran
                                    $receiveTran->parent_id = $tran->id;
                                    //the money from
                                    $receiveTran->sender_id = UserTable::BANK_ID;
                                    $receiveTran->receiver_id = UserTable::BANK_ID; //this goes to bank
                                    $receiveTran->hint = 'Bank real share received ('. $bankRealShare .'), this will be sent in wallet';
                                    $receiveTran->full_payment = $bankRealShare;
                                    $receiveTran->status = $status['stand-by']; //status standby, as this might be reverted if the deal is not on
                                    $receiveTran->product_id = $tran->product_id;
                                    $receiveTran->product_name = $tran->product_name;
                                    $receiveTran->product_price = $tran->product_price;
                                    $receiveTran->quantity = 1;
                                    $receiversTran->add($receiveTran);

                                    //update each parent's virtual wallet // not yet as this deal might not be on
                                    //$rootUser = UserTable::getInstance()->find(UserTable::BANK_ID);
                                    //$rootUser->wallet = $rootUser->wallet + $bankRealShare;
                                    //$rootUser->save();
                                }

                                $receiversTran->save();
                                //$usersWallet->save();

                                //$productObj->sold = $productObj->sold + $quantity;
                                //$productObj->save();
                                $query = 'UPDATE product SET sold = sold + :qty WHERE id = :product_id';
                                $result = $conn->execute($query, array('product_id' => $productObj->get('id'), 'qty' => 1));

                                $query = 'UPDATE product_price SET sold = sold + :qty WHERE id = :option_id';
                                $result = $conn->execute($query, array('option_id' => $optionObj->get('id'), 'qty' => 1));
                            }//end quantity
                            //we do the checks if the deal is on , //in a crontab//, live
                            //now lets check if the deal is on, so we can send the money to users wallets
                            $checkObj = ProductTable::getInstance()->find($productObj->get('id'));
                            if($checkObj->get('sold') >= $checkObj->get('min_sold')) {
                                $checkObj->is_active = 1;
                                $checkObj->save();
                                //now lets get all transactions for this product that are on stand-by
                                $tr = TransactionTable::getInstance()->getStandByTransactions(array('product_id' => $productObj->get('id')));
                                //$trCol = new Doctrine_Collection('Transaction');
                                foreach($tr as $t) {
                                    if($t->transaction_type == $type['buy']) {
                                        //lets get the coupon
                                        $coupon = CouponTable::getInstance()->getTransactionCoupon(array('transaction_id' => $t->id));
                                        if($coupon->id) {
                                            $coupon->status = CouponTable::$status['not-verified'];
                                            $coupon->save();
                                            if($coupon->friend == 1) {
                                                $u = UserTable::getInstance()->find($coupon->owner_id);
                                                $p = ProductTable::getInstance()->find($t->product_id);
                                                $po = UserTable::getInstance()->find($t->receiver_id);
                                                /*$msg = 'Hi,<br><br>
                                                    Your friend ' . $u->first_name . ' ' . $u->last_name . ' sent you a gift<br /><br />
                                                    He bought this product <a href="http://www.winmaweb.com/'.$po->username.'/'.$p->slug.'.html">'.$p->name.'</a><br /><br />
                                                    He also sent you this message: <br />
                                                    '.nl2br($coupon->msg).'<br /><br />
                                                    You can find your gift coupon in the attached pdf file.<br /><br />
                                                    Thank you.';

                                                require(ROOT_PATH . '/lib/fpdf/fpdf.php');
                                                $pdf = new FPDF('P','mm','A5');
                                                $pdf->AddPage();
                                                $pdf->SetFont('Arial','',14);
                                                $pdf->Cell(40,10,'Offer: '.$coupon->name);
                                                $pdf->Ln();
                                                $pdf->Cell(40,10,'Quantity: '.$coupon->quantity);
                                                $pdf->Ln();
                                                $pdf->Cell(40,10,'Amount: '. new Zend_Currency(array('value' => $coupon->price), 'en_US') );
                                                $pdf->Ln();
                                                $pdf->Cell(40,10,'Created at: '.date('D, d M Y H:i:s', strtotime($coupon->created_at)));
                                                $pdf->Ln();
                                                $pdf->Cell(40,10,'Expire at: '.date('D, d M Y H:i:s', strtotime($coupon->expire_at)));
                                                $pdf->Ln();
                                                $pdf->SetTextColor(155);
                                                $pdf->SetFont('Arial','',11);
                                                $pdf->Cell(40,10,'Code: '.$coupon->code);

                                                //$pdf->Output('coupon', 'S');

                                                require_once 'Swift/swift_required.php';
                                                $transport = Swift_SendmailTransport::newInstance('/usr/sbin/sendmail -bs');
                                                $mailer = Swift_Mailer::newInstance($transport);
                                                //Create a message
                                                $message = Swift_Message::newInstance('Winmaweb.com Gift')
                                                ->setFrom(array('office@winmaweb.com' => 'winmaweb'))
                                                ->setBody($msg, 'text/html');
                                                $message->setTo(array($coupon->email));
                                                $attachment = Swift_Attachment::newInstance($pdf->Output('coupon', 'S'), 'coupon.pdf', 'application/pdf');
                                                // Attach it to the message
                                                $message->attach($attachment);

                                                //$mailer->send($message);*/
                                            }
                                            $dealowner = UserTable::getInstance()->find($t->receiver_id);
                                            if($dealowner->id) {
                                                $msg = 'Hi,<br><br>
                                                A deal has been purchased, deal voucher verification code is: <strong>'.$coupon->code2.'</strong>
                                                Thank you.';
                                                require_once 'Swift/swift_required.php';
                                                $transport = Swift_SendmailTransport::newInstance('/usr/sbin/sendmail -bs');
                                                $mailer = Swift_Mailer::newInstance($transport);
                                                //Create a message
                                                $message = Swift_Message::newInstance('Winmaweb.com Deal Purchase')
                                                ->setFrom(array('office@winmaweb.com' => 'winmaweb'))
                                                ->setBody($msg, 'text/html');
                                                $message->setTo(array($dealowner->email));

                                                //$mailer->send($message);
                                            }
                                        }
                                        
                                        $t->status = $status['ok'];
                                        $t->save();
                                        $trChild = TransactionTable::getInstance()->getStandByBankTransactions(array('parent_id' => $t->get('id')));
                                        foreach($trChild as $cc) {
                                            if($cc->receiver_id == UserTable::BANK_ID) {
                                                $cc->status = $status['ok'];
                                                $cc->save();
                                                $query = 'UPDATE user SET wallet = wallet + :amount WHERE id = :user_id';
                                                $result = $conn->execute($query, array('user_id' => $cc->receiver_id, 'amount' => $cc->full_payment));
                                            } else {
                                                //$query = 'UPDATE user SET virtual_wallet = virtual_wallet + :amount WHERE id = :user_id';
                                                //$result = $conn->execute($query, array('user_id' => $cc2->receiver_id, 'amount' => $cc2->full_payment));
                                            }
                                            /*$trChild2 = TransactionTable::getInstance()->getStandByChildTransactions2(array('parent_id' => $cc->get('id')));
                                            foreach($trChild2 as $cc2) {
                                                
                                                if($cc2->receiver_id == UserTable::BANK_ID) {
                                                    $cc2->status = $status['ok'];
                                                    $cc2->save();
                                                    $query = 'UPDATE user SET wallet = wallet + :amount WHERE id = :user_id';
                                                    $result = $conn->execute($query, array('user_id' => $cc2->receiver_id, 'amount' => $cc2->full_payment));
                                                } else {
                                                    //$query = 'UPDATE user SET virtual_wallet = virtual_wallet + :amount WHERE id = :user_id';
                                                    //$result = $conn->execute($query, array('user_id' => $cc2->receiver_id, 'amount' => $cc2->full_payment));
                                                }
                                            }*/
                                        }
                                    } 

                                }
                                //$trCol->save();
                            }

                            //now lets commit
                            $conn->commit();

                        } catch (Exception $e) {
                            $form->addError('There was a error. Everything was rolled back, please try again later.'.$e->getMessage().' - ' . $e->getFile());
                            $conn->rollback();
                        }
                    }
                    unset($this->cart->products);
                    $this->redirect('/my-account/transactions');
                }
            }
         }
        
        return array(
            'product' => $product,
            'option' => $optionObj,
            'products' => $products,
            'form' => array(
                        'values' => $form->getValues(),
                        'errors' => $form->getMessages(),
                        'qtys'  => $form->cart_qty,
                        'options'  => $formMDA,
                        'success' => (isset($success) ? $success : false)
                    ),
            'friend' => $this->cart->friend,
            'options' => $options,
						'showDepositButton' => $showDepositButton
            );
    }
    
    public function cron()
    {
        //now lets check if the deal is on, so we can send the money to users wallets
        $checkObj = ProductTable::getInstance()->find($productObj->get('id'));
        if($checkObj->get('sold') >= $checkObj->get('min_sold')) {
            //now lets get all transactions for this product that are on stand-by
            $tr = TransactionTable::getInstance()->getStandByTran(array('product_id' => $productObj->get('id')));
        }
        
        die;
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
        require_once(ROOT_PATH . '/lib/Cms/payment/paypal/ipnlistener.php');
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
//            error_log('ver');
//            error_log($listener->getTextReport());
					$values = $listener->getPostValues();
					$vv = $values['mc_gross'];
//						error_log($vv);
						if ($vv > 0) {
//							$user = $this->user->getUser();
							$usr = Doctrine_Core::getTable('User')->find($values['item_number']);
//							error_log($user);
//							error_log($user->wallet);
							$usr->wallet = $usr->wallet + $vv;
							$usr->save();
							$type = TransactionTable::$type;
							$sTran = new Transaction();
							$sTran->parent_id = $tran->id;
							$sTran->transaction_type = $type['deposit'];
//							//the money from
							$sTran->sender_id = $values['item_number'];
							$sTran->receiver_id = $values['item_number'];

							$sTran->full_payment = $vv;
							
							$sTran->paypal_txn_id = $values['txn_id'];
							$sTran->paypal_txn_type = $values['txn_type'];
							$sTran->paypal_payment_status = $values['payment_status'];
							$sTran->paypal_payment_date = $values['payment_date'];
							$sTran->paypal_mc_gross = $values['mc_gross'];
							$sTran->paypal_mc_currency = $values['mc_currency'];
							$sTran->paypal = $values['payer_email'];
							$sTran->save();
//							$success = true;
						}

        } else {
            /*
            An Invalid IPN *may* be caused by a fraudulent transaction attempt. It's
            a good idea to have a developer or sys admin manually investigate any 
            invalid IPN.
            */
            //mail('YOUR EMAIL ADDRESS', 'Invalid IPN', $listener->getTextReport());
//            error_log('not');
//            error_log($listener->getTextReport());
        }
        
        die();
    }
}
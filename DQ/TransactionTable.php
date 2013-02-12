<?php

class TransactionTable extends Doctrine_Table
{
    /*static public $type1 = array(
        'deposit'   => 0,   //deposit transaction, with this type the user deposit money from his/her paypal account into the wallet
        'buy'       => 1,   //buy transaction, the user baught a product/service, for the seller, another transaction will be made with the 'sell' type
        'withdraw'  => 2,   //withdrawal transaction, the user withdraw money from his wallet to his paypal account
        'site-fee'  => 3,   //site fee transaction, this transaction has also subtransactions for admins to see how the fee was calculated
        'sell'      => 4,   //sell transaction, the user sold an product, and he receive the money
        'receive'   => 5,    //receive transaction, this is when a user receive money from the site, by only one reason when a descendat of the user will sell a product, this will always get in the virtual_wallet
        'receive-site-fee'   => 6,   //receive transaction, but this kind of transaction is only for the site fees, and this transation will always get to the root(banker) user(id:2)
        'transfer-to-wallet' => 7,   //transert to wallet transaction, the name says it all, with this transaction the user transfer the money from his virtual wallet to his wallet
        'merchant-fee'  =>  8,   // merchant fee transaction
        'offer-commission'  => 9 //every merchant account receive a % commission for each offer they sell, this will go in the network transactions, and is calulated same as tax
    );*/
    //do = deal owner
    static public $type = array(
        'deposit'   => 0,   //deposit transaction, with this type the user deposit money from his/her paypal account into the wallet
        'buy'       => 1,   //buy transaction, the user bought a product/service
        'withdraw'  => 2,   //withdrawal transaction, the user withdraw money from his wallet to his paypal account
        'bank-share'  => 3,   //this is the bank share after the factor calculation, this also get subtransactions to share the money to other levels etc, and whats left will go to bank wallet
        'do-share'  => 4, //deal owner share after the factor calculation, this money stay in standby(check self::status), if the do use the unique cupon code this will get transafered to his virtual wallet, other this money can be moved to bank after a perriod of time, from this id we also calculate the md5 cupon code
        'do-share-do-receive'   => 5, //deal owner get his money after he complete the right cupon code, money get in virtual wallet, subtransaction of self::type[do-share]
        'do-share-bank-receive'   => 6,   //bank receive the deal owner share, this happen if the do fail to collect his money in the set time interval, subtransaction of self::type[do-share]
        'transfer-to-wallet' => 7,   //transert to wallet transaction, the name says it all, with this transaction the user transfer the money from his virtual wallet to his wallet
        'merchant-fee'  =>  8,   // merchant fee transaction
        'merchant-commission'  => 9, //every merchant account receive a % commission for each offer they sell, this will go in the network transactions, and is calculated from bank share, and its a subtransaction of self::type[bank-share]
//				'agent-commission'  => 9, //every merchant account receive a % commission for each offer they sell, this will go in the network transactions, and is calculated from bank share, and its a subtransaction of self::type[bank-share]
        'level-commission' => 10, //the buyer network receive commission, this is calculated from bank share, and its a subtransaction of self::type[bank-share]
        'bank-share-left' => 11, //this is the bank share that remain after we calculate merchant commission and level commission, and its a subtransaction of self::type[bank-share]
        'product-refund' => 12,
        'donation' =>55,
        'withdraw-giro' => 60,
        'deposit-giro' =>65,
        'deposit-paypal-fee'=> 75,
        'buy-wmw' => 80
    );
    
    const DEPOSIT = 0;
    const BUY = 1;
    
    const WITHDRAW = 2;
    
    const BANK_SHARE = 3;
    const DO_SHARE = 4;
    
    const DO_SHARE_DO_RECEIVE = 5;
    const DO_SHARE_BANK_RECEIVE = 6;
    
    const TRANSFER_TO_WALLET = 7;
    
    const MERCHANT_FEE = 8;
    const MERCHANT_COMMISSION = 9;
//		const AGENT_COMMISSION = 9;
    const LEVEL_COMMISSION = 10;
    const BANK_SHARE_LEFT = 11;
    
    /*
     * @status
     * values
     * -1 : something went wrong when received money from paypal,
     *      the money were received but the custom field was empty or had an invalid value,
     *      so the money did realy got in any user wallet, please refund.
     * 0 :  all is ok with the transaction
     * 
     * 1 :   money are in stand by, this is for self::type[do-share], stand by means that the money is not in any wallet yet
     * 2 :   money where sent(check subtransactions), this is for self::type[do-share-*],
     *         sent mean the money were sent to wallets, by other subtransactions
     */
    static public $status = array(
        'refund'  => -1,
        'ok' => 0,//all is ok
        'stand-by' => 1, //money are in stand by, this is for self::type[do-share](UPDATE also for BUY, MERCHANT_COMMISION, LEVEL_COMMISSION ), stand by means that the money is not in any wallet yet
        'stand-by-sent' => 2 //money where sent(check subtransactions), this is for self::type[do-share-*], stand-by-sent mean the money were sent to wallets, by other subtransactions
    );
    
    //admin actions on a transaction
    static public $action = array(
        'no-action'  => 0, //no action was taken on this transaction
        'refunded'    => 1 //this transaction was refunded, only for paypal payments, only rarely this could happen
    );
 
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Transaction');
    }
    
    public function getTypes()
    {
        return self::$type;
    }
    
    public function getStatus()
    {
        return self::$status;
    }
    
    public function getActions()
    {
        return self::$action;
    }
    
    public function getRefundTransactions($params = array())
    {
        return $this->createQuery()
                ->from('Transaction t')
                ->leftJoin('t.byUser bu')
                ->addWhere('t.status = ?', self::$status['refund'])
                ->addWhere('t.action = ?', self::$action['no-action']);
    }
    
    public function getRefundHistory($params = array())
    {
        return $this->createQuery()
                ->from('Transaction t')
                ->leftJoin('t.byUser bu')
                ->addWhere('t.status = ?', self::$status['refund'])
                ->addWhere('t.action = ?', self::$action['refunded']);
    }
    
    public function getTransactionDetails($params = array())
    {
        return $this->createQuery()
                ->from('Transaction t')
                ->leftJoin('t.byUser bu')
                ->leftJoin('t.fromUser fu')
                ->leftJoin('t.Product p')
                ->addWhere('t.id = ?', $params['id']);
    }
    
    /*
     * Payer(byUser)
     * get all transactions
     */
    public function getTransactionsQuery($params = array())
    {
        return $this->createQuery()
                ->from('Transaction.t');
    }
    
    public function getNormalTransactions($q = null)
    {
        if (is_null($q))
        {
            $q = Doctrine_Query::create()
                    ->from('Transaction t');
        }
        $alias = $q->getRootAlias();
        
        return $q->addOrderBy($alias.'.created_at DESC');
    }
    
    public function getBuyerTransactions($params = array())
    {
        return $this->createQuery()
                ->select('t.*, s.username, p.id, p.name')
                ->from('Transaction t')
                ->leftJoin('t.Sender s')
                ->leftJoin('t.Product p')
                ->addWhere('t.receiver_id = ? OR t.sender_id = ?', array($params['user_id'], $params['user_id']))
                ->orderBy('created_at DESC');
    }
    
    public function getUserTransactionDetails($params = array())
    {
        $q =  $this->createQuery()
                ->from('Transaction t')
                ->leftJoin('t.Receiver r')
                ->leftJoin('t.Sender s')
                ->leftJoin('s.UserAddress ua')
                ->leftJoin('ua.Country c')
                ->leftJoin('r.Company uc')
                ->leftJoin('uc.CompanyAddress');
        
                $q->addWhere('t.id = ?', $params['id'])
                    ->addWhere('t.sender_id = ?', $params['user_id'])
                    ->andWhereIn('t.transaction_type', array(self::$type['buy'], self::$type['buy-wmw'], self::$type['merchant-fee'], self::$type['donation']))//('t.transaction_type = ?', self::$type['buy'])
                    ->orWhere('t.receiver_id = ?', $params['user_id'])
                    ->addWhere('t.id = ?', $params['id'])
                    ->andWhereIn('t.transaction_type', array(self::$type['level-commission'], self::$type['merchant-commission'], self::$type['do-share-do-receive'], self::$type['deposit'], self::$type['transfer-to-wallet'], self::$type['withdraw'], self::$type['withdraw-giro'], self::$type['deposit-giro']));
//										->orWhere('t.receiver_id = ?', $params['user_id'])
//										->addWhere('t.parent_id = ?', $params['id'])
//										->andWhereIn('t.transaction_type', array(self::$type['merchant-commission']));
//										->orWhere('t.parent_id = ?', $params['id'])
//										->andWhereIn('t.transaction_type', array(self::$type['merchant-commission']));
        
        return $q;
    }
    
    /*
     * Return user sent trasactions, with witch he baught an offer, or payed an administration fee
     * @type: 'buy'
     */
    public function getSentTransactions($params = array())
    {
        return $this->createQuery()
                ->select('t.*, r.username, r.id, p.*, c.id as cid')
                ->from('Transaction t')
                ->leftJoin('t.Receiver r')
                ->leftJoin('t.Product p')
								->leftJoin('t.Coupon c')
                ->addWhere('t.sender_id = ?', $params['sender_id'])
                ->andWhereIn('t.transaction_type', array(self::$type['product-refund'],self::$type['buy'], self::$type['buy-wmw'], self::$type['merchant-fee'], self::$type['donation']))
                ->orderBy('created_at DESC');
    }
    
    /*
     * Merchant fee transaction and coupon retrival transaction
     */
    
    public function getReceivedTransactions($params = array())
    {
        return $this->createQuery()
                ->select('t.*, s.username, s.id, t2.*')
                ->from('Transaction t')
                ->leftJoin('t.Sender s')
                ->addWhere('t.status = ?', self::$status['ok'])
                ->addWhere('t.receiver_id = ?', $params['receiver_id'])
                ->andWhere('t.transaction_type = ?', self::$type['merchant-commission'])
//                ->orWhere('t.receiver_id = ?', $params['receiver_id'])
//                ->andWhere('t.transaction_type = ?', self::$type['do-share-do-receive'])
//                ->andWhere('t.status = ?', self::$status['ok'])
                ->orderBy('t.created_at DESC');
    }
    
    public function getNetworkTransactions($params = array())
    {
        return $this->createQuery()
                ->select('t.*, s.username, s.id, t2.*')
                ->from('Transaction t')
                ->leftJoin('t.Sender s')
                ->addWhere('t.receiver_id = ?', $params['receiver_id'])
                ->andWhereIn('t.transaction_type', array(self::$type['level-commission']))
                ->orderBy('t.created_at DESC');
    }
    
    public function getWalletTransactions($params = array())
    {
        return $this->createQuery()
                ->select('t.*, s.username, s.id, t2.*')
                ->from('Transaction t')
                ->addWhere('t.receiver_id = ?', $params['receiver_id'])
                ->andWhereIn('t.transaction_type', array(self::$type['deposit'], self::$type['transfer-to-wallet'], self::$type['withdraw'], self::$type['withdraw-giro'], self::$type['deposit-giro']))
                ->orderBy('t.created_at DESC');
    }
    
    public function getLastTransfer($params = array())
    {
        return $this->createQuery()
                ->select('t.*')
                ->from('Transaction t')
                ->addWhere('t.receiver_id = ?', $params['receiver_id'])
                ->andWhere('t.transaction_type = ?', self::$type['transfer-to-wallet'])
                ->orderBy('t.created_at DESC')
                ->fetchOne(array(), Doctrine::HYDRATE_ARRAY);
    }
    
    public function getSpentValue($params = array())
    {
        $q = $this->createQuery()
                ->select('SUM(t.full_payment) as spent')
                ->from('Transaction t')
                ->addWhere('t.sender_id = ?', $params['sender_id'])
                ->whereIn('t.transaction_type', array(self::$type['buy'], self::$type['buy-wmw'], self::$type['donation']));
        if($params['from_date']) {
            $q->addWhere('t.created_at > ?', $params['from_date']);
        }
        
        return $q->fetchOne(array(), Doctrine::HYDRATE_ARRAY);
    }
    
    public function getBuyTransactionsStatistic($params = array(), $type = 'daily')
    {
        if($type === 'daily') {
            $q = $this->createQuery()
                    ->addSelect('day(created_at) AS d, count(month(created_at)) AS total, sum(quantity) AS qty, sum(full_payment) AS payment')
                    ->addWhere('month(created_at) = ?', $params['month'])
                    ->addWhere('year(created_at) = ?', $params['year'])
                    ->whereIn('transaction_type', array(self::$type['buy'], self::$type['buy-wmw']))
                    ->groupBy('d');
            if($params['user_id']) {
                $q->addWhere('sender_id = ?',$params['user_id']);
            }
            
            return $q->execute(array(), Doctrine::HYDRATE_ARRAY);
        }
        
        if($type === 'monthly') {
            $q = $this->createQuery()
                    ->addSelect('month(created_at) AS m, count(month(created_at)) AS total, sum(quantity) AS qty, sum(full_payment) AS payment')
                    ->addWhere('year(created_at) = ?', $params['year'])
                    ->whereIn('transaction_type', array(self::$type['buy'], self::$type['buy-wmw']))
                    ->groupBy('m');
           if($params['user_id']) {
                $q->addWhere('sender_id = ?',$params['user_id']);
            }
            return $q->execute(array(), Doctrine::HYDRATE_ARRAY);
        }
    }
    
    public function getSoldTransactionsStatistic($params = array(), $type = 'daily')
    {
        if($type === 'daily') {
            $q = $this->createQuery()
                    ->addSelect('day(created_at) AS d, count(month(created_at)) AS total, sum(quantity) AS qty, sum(full_payment) AS payment')
                    ->addWhere('month(created_at) = ?', $params['month'])
                    ->addWhere('year(created_at) = ?', $params['year'])
                    ->addWhere('transaction_type = ?', self::$type['merchant-commission'])
                    ->groupBy('d');
            if($params['user_id']) {
                $q->addWhere('receiver_id = ?',$params['user_id']);
            }
            
            return $q->execute(array(), Doctrine::HYDRATE_ARRAY);
        }
        
        if($type === 'monthly') {
            $q = $this->createQuery()
                    ->addSelect('month(created_at) AS m, count(month(created_at)) AS total, sum(quantity) AS qty, sum(full_payment) AS payment')
                    ->addWhere('year(created_at) = ?', $params['year'])
                    ->addWhere('transaction_type = ?', self::$type['merchant-commission'])
                    ->groupBy('m');
           if($params['user_id']) {
                $q->addWhere('receiver_id = ?',$params['user_id']);
            }
            return $q->execute(array(), Doctrine::HYDRATE_ARRAY);
        }
    }
    
    
    public function getBankTaxTransactions($params = array())
    {
        return $this->createQuery()
                ->select('t.*, s.username, s.id')
                ->from('Transaction t')
                ->leftJoin('t.Sender s')
                ->addWhere('t.status = ?', self::$status['ok'])
                ->addWhere('t.receiver_id = ?', UserTable::BANK_ID)
                ->andWhere('t.transaction_type = ?', self::$type['bank-share-left'])
                ->orWhere('t.receiver_id = ?', UserTable::BANK_ID)
                ->andWhere('t.transaction_type = ?', self::$type['merchant-fee'])
                ->orWhere('t.receiver_id = ?', UserTable::BANK_ID)
                ->andWhere('t.transaction_type = ?', self::$type['do-share-bank-receive'])
                ->orderBy('t.created_at DESC');
    }
    
    public function getBankNetworkTransactions($params = array())
    {
        return $this->createQuery()
                ->select('t.*, s.username, s.id')
                ->from('Transaction t')
                ->leftJoin('t.Sender s')
                ->addWhere('t.status = ?', self::$status['ok'])
                ->addWhere('t.receiver_id = ?', UserTable::BANK_ID)
                ->andWhere('t.transaction_type = ?', self::$type['level-commission'])
                ->orderBy('t.created_at DESC');
    }
    
    public function getBankWalletTransactions($params = array())
    {
        return $this->createQuery()
                ->select('t.*, s.username, s.id')
                ->from('Transaction t')
                ->addWhere('t.receiver_id = ?', UserTable::BANK_ID)
                ->andWhereIn('t.transaction_type', array(self::$type['deposit'], self::$type['transfer-to-wallet'], self::$type['withdraw'], self::$type['withdraw-giro'], self::$type['deposit-giro']))
                ->orderBy('t.created_at DESC');
    }
    
    
    /*
     * Retrive the do-share transaction for a given coupon code
     */
    public function getDoShareTransaction($params = array())
    {
        return $this->createQuery()
                ->addWhere('parent_id = ?', $params['parent_id'])
                ->whereIn('transaction_type', array(self::$type['do-share']));
    }
    
    public function getStandByTransactions($params = array())
    {
        return $this->createQuery()
                ->addWhere('status = ?', self::$status['stand-by'])
                ->addWhere('product_id = ?', $params['product_id'])
                ->execute(array());
    }
    
    public function getStandByChildTransactions($params = array())
    {
        return $this->createQuery()
                ->addWhere('status = ?', self::$status['stand-by'])
                ->addWhere('parent_id = ?', $params['parent_id'])
                ->whereIn('transaction_type', array(self::$type['bank-share']))
                ->execute(array());
    }
    
    //just the bank money go direcly into bank, the other are received after the merchant redeem the coupon
    public function getStandByBankTransactions($params = array())
    {
        return $this->createQuery()
                ->addWhere('status = ?', self::$status['stand-by'])
                ->addWhere('parent_id = ?', $params['parent_id'])
                ->whereIn('transaction_type', array(self::$type['bank-share-left']))
                ->execute(array());
    }
    
    public function getStandByChildTransactions2($params = array())
    {
        return $this->createQuery()
                ->addWhere('status = ?', self::$status['stand-by'])
                ->addWhere('parent_id = ?', $params['parent_id'])
                ->whereNotIn('transaction_type', array(self::$type['merchant-commission']))
                ->execute(array());
    }
    
    public function getWalletStatistic($params = array(), $type = 'daily')
    {
        if($type === 'daily') {
            $q = $this->createQuery()
                    ->addSelect('day(created_at) AS d, count(month(created_at)) AS total, sum(quantity) AS qty, sum(full_payment) AS payment')
                    ->addWhere('month(created_at) = ?', $params['month'])
                    ->addWhere('year(created_at) = ?', $params['year'])
                    ->whereIn('transaction_type', array(self::$type['buy'], self::$type['buy-wmw']))
                    ->groupBy('d');
            if($params['user_id']) {
                $q->addWhere('sender_id = ?',$params['user_id']);
            }
            
            return $q->execute(array(), Doctrine::HYDRATE_ARRAY);
        }
        
        if($type === 'monthly') {
            $q = $this->createQuery()
                    ->addSelect('month(created_at) AS m, count(month(created_at)) AS total, sum(quantity) AS qty, sum(full_payment) AS payment')
                    ->addWhere('year(created_at) = ?', $params['year'])
                    ->whereIn('transaction_type', array(self::$type['buy'], self::$type['buy-wmw']))
                    ->groupBy('m');
           if($params['user_id']) {
                $q->addWhere('sender_id = ?',$params['user_id']);
            }
            return $q->execute(array(), Doctrine::HYDRATE_ARRAY);
        }
    }
}

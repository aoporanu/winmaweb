<?php

class CouponTable extends Doctrine_Table
{
    static public $status = array(
        'not-verified' => 0,
        'verified' => 1,
        'stand-by' => 2,
        'donation' => 10
    );
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Coupon');
    }
    
    public function getUserCoupons($params = array())
    {
        return $this->createQuery('c')
                ->addWhere('c.owner_id = ?', $params['owner_id'])
                ->addWhere('c.friend = 0')
                ->andWhereIn('status', array(self::$status['not-verified'], self::$status['verified']))
								->orderBy('created_at DESC');
    }
    
    public function getDonationCoupons($params = array())
    {
        return $this->createQuery('c')
                ->addWhere('c.owner_id = ?', $params['owner_id'])
                ->andWhereIn('status', array(self::$status['donation']))
                ->orderBy('created_at DESC');
    }
    
    public function getSentGiftCoupons($params = array())
    {
        return $this->createQuery('c')
                ->addWhere('c.owner_id = ?', $params['owner_id'])
                ->addWhere('c.friend = 1')
                ->andWhereIn('status', array(self::$status['not-verified'], self::$status['verified']))
								->orderBy('created_at DESC');
    }
    
    public function getReceivedGiftCoupons($params = array())
    {
        return $this->createQuery('c')
                ->addWhere('c.friend_id = ?', $params['friend_id'])
                ->addWhere('c.friend = 1')
                ->andWhereIn('status', array(self::$status['not-verified'], self::$status['verified']))
								->orderBy('created_at DESC');
    }
    
    public function getUserCouponDetails($params = array())
    {
        return $this->createQuery('c')
                ->leftJoin('c.Friend')
                ->leftJoin('c.Transaction t')
                ->leftJoin('t.Product p')
                ->leftJoin('c.Owner o')
                ->addWhere('c.owner_id = ?', $params['owner_id'])
                ->addWhere('c.id = ?', $params['id']);
    }
    
    public function getFriendCouponDetails($params = array())
    {
        return $this->createQuery('c')
                ->leftJoin('c.Friend')
                ->leftJoin('c.Transaction t')
                ->leftJoin('t.Product p')
                ->addWhere('c.friend_id = ?', $params['friend_id'])
                ->addWhere('c.id = ?', $params['id']);
    }
    
    public function getNotVerifiedCoupons($params = array())
    {
        return $this->createQuery('c')
                ->leftJoin('c.Owner u')
                ->addWhere('status = ?', self::$status['not-verified']);
    }
    
    public function getVerifiedCoupons($params = array())
    {
        return $this->createQuery('c')
                ->leftJoin('c.Owner o')
                ->leftJoin('c.Verifier r')
                ->addWhere('status = ?', self::$status['verified']);
    }
    
    public function getTransactionCoupon($params = array())
    {
        return $this->createQuery('c')
                ->addWhere('c.status = ?', self::$status['stand-by'])
                ->addWhere('c.transaction_id = ?', $params['transaction_id'])
                ->fetchOne();
    }
		
    public function getRedeemedCoupons($params = array()) {
                return $this->createQuery('c')
                    ->leftJoin('c.Transaction t')
                    ->leftJoin('c.Friend f')
                    ->leftJoin('t.Sender s')
                    ->addWhere('c.verifier_id = ?', $params['owner_id'])
                    ->andWhereIn('status', array(self::$status['verified']))
                    ->orderBy('created_at DESC');
    }
		
    public function getRedeemedCouponDetails($params = array())
    {
        return $this->createQuery('c')
                ->leftJoin('c.Transaction t')
                ->leftJoin('t.Product p')
                ->leftJoin('c.Friend f')
                ->leftJoin('t.Sender s')
                ->addWhere('c.verifier_id = ?', $params['user_id'])
                ->addWhere('c.id = ?', $params['id']);
    }
    
    public function getAllVouchers($params = array())
    {
        return $this->createQuery('c')
                ->leftJoin('c.Transaction t')
                ->leftJoin('c.Friend f')
                ->leftJoin('t.Sender s')
                ->addWhere('t.receiver_id = ?', $params['receiver_id']);
    }
}

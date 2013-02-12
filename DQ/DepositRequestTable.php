<?php

class DepositRequestTable extends Doctrine_Table
{
    static public $status = array(
        'pending'  => 0,
        'rejected' => 1,
        'accepted'  => 2
    );
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('DepositRequest');
    }
    
    public function getStatus()
    {
        return self::$status;
    }
    
    public function getUserRequests($params = array())
    {
        return $this->createQuery()
                ->addWhere('user_id = ?', $params['user_id'])
                ->orderBy('created_at DESC');
    }
    
    public function getPendingRequests($params = array())
    {
        return $this->createQuery()
                ->from('DepositRequest wr')
                ->leftJoin('wr.User u')
                ->addWhere('wr.status = ?', self::$status['pending'])
                ->orderBy('wr.created_at ASC');
    }
    
    public function getRejectedRequests($params = array())
    {
        return $this->createQuery()
                ->from('DepositRequest wr')
                ->leftJoin('wr.User u')
                ->addWhere('wr.status = ?', self::$status['rejected'])
                ->orderBy('wr.created_at DESC');
    }
    
    public function getAcceptedRequests($params = array())
    {
        return $this->createQuery()
                ->from('DepositRequest wr')
                ->leftJoin('wr.User u')
                ->addWhere('wr.status = ?', self::$status['accepted'])
                ->orderBy('wr.created_at DESC');
    }
}

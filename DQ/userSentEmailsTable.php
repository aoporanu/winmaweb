<?php

class UserSentEmailsTable extends Doctrine_Table
{
    public static function getInstance()
    {
        return Doctrine_Core::getTable('UserSentEmails');
    }
    
    public function chkEmail($params = array())
    {
        return $this->createQuery()
                    ->select('user_id')
                    ->addWhere('user_id = ?', $params['user_id'])
                    ->addWhere('email = ?', $params['email']);
    }
    
    public function getUserEmails($params = array())
    {
        return $this->createQuery()
                    ->addWhere('user_id = ?', $params['user_id']);
    }
    
    public function getUserRegEmails($params = array())
    {
        return $this->createQuery()
                    ->from('User u')    
                    ->innerJoin('u.UserSentEmails use ON use.email = u.email')
                    //->addWhere('use.user_id = ?', $params['user_id'])
                    ->addWhere('u.parent_id = ?', $params['user_id']);
    }
}
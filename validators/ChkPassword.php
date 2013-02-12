<?php

class Validate_chkPassword extends Zend_Validate_Abstract
{
    const MAIN = 'default';

    public $user_id = 0;
    
    protected $_messageTemplates = array(
        self::MAIN => "Current password do not match."
    );

    public function __construct($options) {
        $this->user_id = $options['user_id'];
    }
    
    public function isValid($value)
    {
        $this->_setValue($value);
        
        $q = Doctrine_Query::create()
                ->from('User')
                ->select('id')
                ->addWhere('password = ?', md5($value))
                ->addWhere('id = ?', $this->user_id);
        
        if(!$q->count()) {
            $this->_error(self::MAIN);
            return false;
        }

        return true;
    }
}
<?php

class Validate_dbEmail extends Zend_Validate_Abstract
{
    const MAIN = 'default';

    public $exclude_id = 0;
    
    protected $_messageTemplates = array(
        self::MAIN => "'%value%' was allready used by someone to register"
    );

    public function __construct($options = array()) {
        if($options['exclude_id']) {
            $this->exclude_id = $options['exclude_id'];
        }
    }
    
    public function isValid($value)
    {
        $this->_setValue($value);
        
        $q = Doctrine_Query::create()
                ->from('User')
                ->select('id')
                ->addWhere('email = ?', $value);
        if($this->exclude_id > 0) {
            $q->whereNotIn('id', array($this->exclude_id));
        }
        if($q->count()) {
            $this->_error(self::MAIN);
            return false;
        }

        return true;
    }
}
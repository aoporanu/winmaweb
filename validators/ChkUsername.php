<?php

class Validate_chkUsername extends Zend_Validate_Abstract
{
    const MAIN = 'default';
    const USED = 'used';

    public $exclude_id = 0;
    
    protected $_messageVariables = array(
        'exclude_id' => 'exclude_id'
    );
    
    protected $_messageTemplates = array(
        self::MAIN => "Username need to be formated only from alfanumeric characters and/or -.And character - must not be at the begining of the string",
        self::USED => "%value% is allready used by another user, please choose another username."
    );

    public function __construct($options = array()) {
        //$this->exclude_id = $options['exclude_id'];
    }
    
    public function isValid($value, $context = null)
    {
        $this->_setValue($value);

        if(substr($value, 0, 1) == '-') {
            $this->_error(self::MAIN);
            return false;
        }
        if(eregi( '[^a-zA-Z0-9-]', $value )) {
            $this->_error(self::MAIN);
            return false;
        }

        $number = UserTable::getInstance()->chkUsername(array('username' => $value))->count();
        
        if($number > 0) {
            $this->_error(self::USED);
            return false;
        }

        return true;
    }
}
<?php

class Validate_pNameUnq extends Zend_Validate_Abstract
{
    const USED = 'used';

    public $exclude_id = 0;
    public $user_id = 0;
    
    protected $_messageVariables = array(
        'exclude_id' => 'exclude_id'
    );
    
    protected $_messageTemplates = array(
        self::USED => "%value% is allready used by another product, please choose another name."
    );

    public function __construct($options) {
        $this->exclude_id = $options['exclude_id'];
        $this->user_id = $options['user_id'];
    }
    
    public function isValid($value, $context = null)
    {
        $this->_setValue($value);

        $number = Doctrine_Core::getTable('Product')->createQuery()
                    ->select('id')
                    ->whereNotIn('id', array($this->exclude_id))
                    ->whereIn('user_id', $this->user_id)
                    ->addWhere('name = ?', $value)
                    ->count();
        
        
        if($number > 0) {
            $this->_error(self::USED);
            return false;
        }

        return true;
    }
}
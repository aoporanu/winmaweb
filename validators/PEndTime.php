<?php

class Validate_pEndTime extends Zend_Validate_Abstract
{
    const MAIN = 'default';
    const MDA = 'used';

    protected $_messageTemplates = array(
        self::MAIN => "'End Time' field need to be at least one hour in the future from current time.",
        self::MDA => "'End Time' field need to be at least one hour in the future from 'Start Time' field."
    );

    public function __construct($options = array()) {
        
    }
    
    public function isValid($value, $context = null)
    {
        $this->_setValue($value);

        $tstamp = strtotime($value);
        
        if($tstamp <= (time() + 3600)) {
            $this->_error(self::MAIN);
            return false;
        }
        
        if(strtotime($context['start_time']) >= ($tstamp - 3600)) {
            $this->_error(self::MDA);
            return false;
        }

        return true;
    }
}
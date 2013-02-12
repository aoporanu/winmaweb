<?php

class Validate_Category extends Zend_Validate_Abstract
{
    const USED = 'used';

    public $fid = 0;
    public $level = 0;
    public $root_id = 0;
    public $lft = 0;
    public $rgt = 0;
    
    protected $_messageVariables = array(
        'fid' => 'fid'
    );
    
    protected $_messageTemplates = array(
        self::USED => "There is allready a category with this name \"%value%\"."
    );

    public function __construct($options) {
        $this->fid = $options['fid'];
        $this->level = $options['level'];
        $this->lft = $options['lft'];
        $this->rgt = $options['rgt'];
    }
    
    public function isValid($value, $context = null)
    {
        $this->_setValue($value);
        
        $slug = Doctrine_Inflector::urlize($value);
        
        $number = Doctrine_Core::getTable('Category')->createQuery()
                    ->select('id')
                    ->addWhere('name = ?', $value)
                    ->addWhere('slug = ?', $slug)
                    ->addWhere('level = ?', $this->level)
                    ->addWhere('lft >= ?', $this->lft)
                    ->addWhere('rgt <= ?', $this->rgt)
                    ->whereNotIn('id', array($this->fid))
                    ->count();
        
        if($number > 0) {
            $this->_error(self::USED);
            return false;
        }

        return true;
    }
}
<?php

class helpObj
{
    public function __construct() {
        
    }
    
    public function getHelp($id)
    {
        $conn = Doctrine_manager::getInstance()->getCurrentConnection();
        require_once(ROOT_PATH . '/lib/bbcode/parser.php');
        $mda =  new Parser();
        $help = HelpPagesTable::getInstance()->find($id, Doctrine::HYDRATE_ARRAY);
        
        return array('content' => $mda->p($help['content'], 1));
    }
}
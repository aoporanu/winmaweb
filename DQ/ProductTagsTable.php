<?php

class ProductTagsTable extends Doctrine_Table
{
    public static function getInstance()
    {
        return Doctrine_Core::getTable('ProductTags');
    }
    
}

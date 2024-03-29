<?php

/**
 * BaseProductTags
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $product_id
 * @property integer $tag_id
 * @property Product $Product
 * @property Tag $Tag
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseProductTags extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('product_tags');
        $this->hasColumn('product_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('tag_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Product', array(
             'local' => 'product_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Tag', array(
             'local' => 'tag_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));
    }
}
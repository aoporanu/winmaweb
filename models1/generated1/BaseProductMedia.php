<?php

/**
 * BaseProductMedia
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $product_id
 * @property integer $main
 * @property string $file_name
 * @property string $dir
 * @property enum $type
 * @property string $ext
 * @property Product $Product
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseProductMedia extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('product_media');
        $this->hasColumn('product_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('main', 'integer', 1, array(
             'type' => 'integer',
             'default' => 0,
             'length' => '1',
             ));
        $this->hasColumn('file_name', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('dir', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('type', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => 'image',
              1 => 'video',
              2 => 'pdf',
              3 => 'doc',
              4 => 'docx',
             ),
             'default' => 'image',
             ));
        $this->hasColumn('ext', 'string', 10, array(
             'type' => 'string',
             'length' => '10',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Product', array(
             'local' => 'product_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));
    }
}
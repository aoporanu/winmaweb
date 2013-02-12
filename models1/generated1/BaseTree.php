<?php

/**
 * BaseTree
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $name
 * @property string $meta_title
 * @property string $meta_content
 * @property string $content
 * @property Doctrine_Collection $Pages
 * @property Doctrine_Collection $PageTags
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTree extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('tree');
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('meta_title', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('meta_content', 'string', 1000, array(
             'type' => 'string',
             'length' => '1000',
             ));
        $this->hasColumn('content', 'string', 1000, array(
             'type' => 'string',
             'length' => '1000',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Tag as Pages', array(
             'refClass' => 'PageTags',
             'local' => 'tree_id',
             'foreign' => 'tag_id'));

        $this->hasMany('PageTags', array(
             'local' => 'id',
             'foreign' => 'tree_id'));

        $nestedset0 = new Doctrine_Template_NestedSet(array(
             'hasManyRoots' => true,
             'rootColumnName' => 'root_id',
             ));
        $sluggable0 = new Doctrine_Template_Sluggable(array(
             'unique' => true,
             'fields' => 
             array(
              0 => 'name',
             ),
             'uniqueBy' => 
             array(
              0 => 'lft',
              1 => 'rgt',
              2 => 'level',
              3 => 'root_id',
             ),
             'canUpdate' => true,
             ));
        $this->actAs($nestedset0);
        $this->actAs($sluggable0);
    }
}
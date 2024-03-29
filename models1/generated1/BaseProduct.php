<?php

/**
 * BaseProduct
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $user_id
 * @property integer $category_id
 * @property integer $company_id
 * @property string $name
 * @property string $short_description
 * @property string $description
 * @property string $terms
 * @property datetime $starttime
 * @property datetime $endtime
 * @property integer $sold
 * @property integer $min_sold
 * @property integer $max_buy
 * @property integer $factor
 * @property integer $status
 * @property integer $is_active
 * @property User $User
 * @property Company $Company
 * @property Category $Category
 * @property Doctrine_Collection $ProductPrice
 * @property Doctrine_Collection $ProductMedia
 * @property Doctrine_Collection $Products
 * @property Doctrine_Collection $ProductTags
 * @property Transaction $Transaction
 * @property Doctrine_Collection $Question
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseProduct extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('product');
        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('category_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('company_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('short_description', 'string', 1000, array(
             'type' => 'string',
             'length' => '1000',
             ));
        $this->hasColumn('description', 'string', 1000, array(
             'type' => 'string',
             'length' => '1000',
             ));
        $this->hasColumn('terms', 'string', 1000, array(
             'type' => 'string',
             'length' => '1000',
             ));
        $this->hasColumn('starttime', 'datetime', null, array(
             'type' => 'datetime',
             ));
        $this->hasColumn('endtime', 'datetime', null, array(
             'type' => 'datetime',
             ));
        $this->hasColumn('sold', 'integer', null, array(
             'type' => 'integer',
             'default' => 0,
             ));
        $this->hasColumn('min_sold', 'integer', null, array(
             'type' => 'integer',
             'default' => 1,
             ));
        $this->hasColumn('max_buy', 'integer', null, array(
             'type' => 'integer',
             'default' => 1,
             ));
        $this->hasColumn('factor', 'integer', null, array(
             'type' => 'integer',
             'default' => 0,
             ));
        $this->hasColumn('status', 'integer', null, array(
             'type' => 'integer',
             'default' => 0,
             ));
        $this->hasColumn('is_active', 'integer', null, array(
             'type' => 'integer',
             'default' => 0,
             ));


        $this->index('statusindex', array(
             'fields' => 
             array(
              0 => 'status',
             ),
             ));
        $this->index('createdindex', array(
             'fields' => 
             array(
              0 => 'created_at',
              1 => 'is_active',
             ),
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('User', array(
             'local' => 'user_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Company', array(
             'local' => 'company_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Category', array(
             'local' => 'category_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));

        $this->hasMany('ProductPrice', array(
             'local' => 'id',
             'foreign' => 'product_id'));

        $this->hasMany('ProductMedia', array(
             'local' => 'id',
             'foreign' => 'product_id'));

        $this->hasMany('Tag as Products', array(
             'refClass' => 'ProductTags',
             'local' => 'product_id',
             'foreign' => 'tag_id'));

        $this->hasMany('ProductTags', array(
             'local' => 'id',
             'foreign' => 'product_id'));

        $this->hasOne('Transaction', array(
             'local' => 'id',
             'foreign' => 'product_id'));

        $this->hasMany('Question', array(
             'local' => 'id',
             'foreign' => 'product_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $sluggable0 = new Doctrine_Template_Sluggable(array(
             'unique' => true,
             'fields' => 
             array(
              0 => 'name',
             ),
             'uniqueBy' => 
             array(
              0 => 'user_id',
             ),
             'canUpdate' => true,
             ));
        $this->actAs($timestampable0);
        $this->actAs($sluggable0);
    }
}
<?php

/**
 * BaseCoupon
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $transaction_id
 * @property integer $owner_id
 * @property integer $verifier_id
 * @property string $name
 * @property string $email
 * @property string $msg
 * @property integer $quantity
 * @property double $price
 * @property string $code
 * @property datetime $expire_at
 * @property integer $status
 * @property integer $friend
 * @property User $Owner
 * @property User $Verifier
 * @property Transaction $Transaction
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCoupon extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('coupon');
        $this->hasColumn('transaction_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('owner_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('verifier_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('email', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('msg', 'string', 1000, array(
             'type' => 'string',
             'length' => '1000',
             ));
        $this->hasColumn('quantity', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('price', 'double', null, array(
             'type' => 'double',
             ));
        $this->hasColumn('code', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('expire_at', 'datetime', null, array(
             'type' => 'datetime',
             ));
        $this->hasColumn('status', 'integer', 1, array(
             'type' => 'integer',
             'length' => '1',
             ));
        $this->hasColumn('friend', 'integer', 1, array(
             'type' => 'integer',
             'default' => 0,
             'length' => '1',
             ));


        $this->index('codeindex', array(
             'fields' => 
             array(
              0 => 'code',
             ),
             'type' => 'unique',
             ));
        $this->index('statusindex', array(
             'fields' => 
             array(
              0 => 'status',
             ),
             ));
        $this->index('friendindex', array(
             'fields' => 'friend',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('User as Owner', array(
             'local' => 'owner_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));

        $this->hasOne('User as Verifier', array(
             'local' => 'verifier_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));

        $this->hasOne('Transaction', array(
             'local' => 'transaction_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}
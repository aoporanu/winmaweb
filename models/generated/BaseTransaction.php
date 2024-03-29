<?php

/**
 * BaseTransaction
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $parent_id
 * @property integer $transaction_type
 * @property integer $sender_id
 * @property integer $receiver_id
 * @property integer $product_id
 * @property string $product_name
 * @property double $product_price
 * @property integer $quantity
 * @property double $full_payment
 * @property integer $status
 * @property integer $action
 * @property string $hint
 * @property string $paypal_txn_id
 * @property string $paypal_parent_txn_id
 * @property string $paypal_txn_type
 * @property string $paypal_payment_status
 * @property string $paypal_pending_reason
 * @property string $paypal_payment_date
 * @property string $paypal_mc_gross
 * @property string $paypal_mc_currency
 * @property string $paypal
 * @property Product $Product
 * @property User $Sender
 * @property User $Receiver
 * @property Doctrine_Collection $Coupon
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTransaction extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('transaction');
        $this->hasColumn('parent_id', 'integer', null, array(
             'type' => 'integer',
             'default' => 0,
             ));
        $this->hasColumn('transaction_type', 'integer', 1, array(
             'type' => 'integer',
             'default' => 0,
             'length' => '1',
             ));
        $this->hasColumn('sender_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('receiver_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('product_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('product_name', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('product_price', 'double', null, array(
             'type' => 'double',
             ));
        $this->hasColumn('quantity', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('full_payment', 'double', null, array(
             'type' => 'double',
             'default' => 0,
             ));
        $this->hasColumn('status', 'integer', 1, array(
             'type' => 'integer',
             'default' => 0,
             'length' => '1',
             ));
        $this->hasColumn('action', 'integer', 1, array(
             'type' => 'integer',
             'default' => 0,
             'length' => '1',
             ));
        $this->hasColumn('hint', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('paypal_txn_id', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('paypal_parent_txn_id', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('paypal_txn_type', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('paypal_payment_status', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('paypal_pending_reason', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('paypal_payment_date', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('paypal_mc_gross', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('paypal_mc_currency', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('paypal', 'string', 1000, array(
             'type' => 'string',
             'length' => '1000',
             ));


        $this->index('parentindex', array(
             'fields' => 
             array(
              0 => 'parent_id',
             ),
             ));
        $this->index('paypaltxnindex', array(
             'fields' => 
             array(
              0 => 'paypal_txn_id',
             ),
             'type' => 'unique',
             ));
        $this->index('transactiontypeindex', array(
             'fields' => 
             array(
              0 => 'transaction_type',
             ),
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Product', array(
             'local' => 'product_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));

        $this->hasOne('User as Sender', array(
             'local' => 'sender_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));

        $this->hasOne('User as Receiver', array(
             'local' => 'receiver_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));

        $this->hasMany('Coupon', array(
             'local' => 'id',
             'foreign' => 'transaction_id'));
        
        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}
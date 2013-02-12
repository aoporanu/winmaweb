<?php

/**
 * BaseUser
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $parent_id
 * @property integer $is_active
 * @property integer $is_banned
 * @property integer $is_do
 * @property integer $is_super_admin
 * @property integer $request_step
 * @property string $ref_id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $phone
 * @property string $first_name
 * @property string $last_name
 * @property string $company_name
 * @property string $vat_number
 * @property object $acl
 * @property string $paypal_email
 * @property double $wallet
 * @property double $virtual_wallet
 * @property datetime $last_emails_sent
 * @property datetime $activated_at
 * @property datetime $last_login
 * @property datetime $mrequest_at
 * @property datetime $mrequest_approved_at
 * @property string $code
 * @property datetime $pass_req_at
 * @property Doctrine_Collection $Roles
 * @property Doctrine_Collection $UserRole
 * @property Doctrine_Collection $UserMedia
 * @property UserSentEmails $UserSentEmails
 * @property UserAddress $UserAddress
 * @property Doctrine_Collection $Product
 * @property Doctrine_Collection $Company
 * @property Transaction $Transaction
 * @property Doctrine_Collection $WithdrawRequest
 * @property Coupon $Coupon
 * @property Doctrine_Collection $Question
 * @property Doctrine_Collection $Answer
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseUser extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('user');
        $this->hasColumn('parent_id', 'integer', null, array(
             'type' => 'integer',
             'default' => '0',
             ));
        $this->hasColumn('is_active', 'integer', 1, array(
             'type' => 'integer',
             'default' => '0',
             'length' => '1',
             ));
        $this->hasColumn('is_banned', 'integer', 1, array(
             'type' => 'integer',
             'default' => '0',
             'length' => '1',
             ));
        $this->hasColumn('is_do', 'integer', 1, array(
             'type' => 'integer',
             'default' => '0',
             'length' => '1',
             ));
        $this->hasColumn('is_super_admin', 'integer', 1, array(
             'type' => 'integer',
             'default' => '0',
             'length' => '1',
             ));
        $this->hasColumn('request_step', 'integer', 2, array(
             'type' => 'integer',
             'default' => '0',
             'length' => '2',
             ));
				$this->hasColumn('agent_request_step', 'integer', 2, array(
             'type' => 'integer',
             'default' => '0',
             'length' => '2',
             ));
        $this->hasColumn('ref_id', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             ));
        $this->hasColumn('username', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('password', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('email', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('phone', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('first_name', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('last_name', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('company_name', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('vat_number', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('acl', 'object', null, array(
             'type' => 'object',
             ));
        $this->hasColumn('paypal_email', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('wallet', 'double', null, array(
             'type' => 'double',
             'default' => 0,
             ));
        $this->hasColumn('virtual_wallet', 'double', null, array(
             'type' => 'double',
             'default' => 0,
             ));
        $this->hasColumn('last_emails_sent', 'datetime', null, array(
             'type' => 'datetime',
             ));
        $this->hasColumn('activated_at', 'datetime', null, array(
             'type' => 'datetime',
             ));
        $this->hasColumn('last_login', 'datetime', null, array(
             'type' => 'datetime',
             ));
        $this->hasColumn('mrequest_at', 'datetime', null, array(
             'type' => 'datetime',
             ));
        $this->hasColumn('mrequest_approved_at', 'datetime', null, array(
             'type' => 'datetime',
             ));
				$this->hasColumn('arequest_at', 'datetime', null, array(
             'type' => 'datetime',
             ));
        $this->hasColumn('arequest_approved_at', 'datetime', null, array(
             'type' => 'datetime',
             ));
        $this->hasColumn('code', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('pass_req_at', 'datetime', null, array(
             'type' => 'datetime',
             ));
				$this->hasColumn('gender', 'string', 10, array(
						'type' => 'string',
            'length' => '10',
						));
				$this->hasColumn('age', 'string', 2, array(
             'type' => 'string',
             'length' => '2',
             ));
				$this->hasColumn('is_private', 'boolean', null, array(
						'type'	=> 'boolean'
				));
				$this->hasColumn('my_status', 'string', 2, array(
             'type' => 'string',
             'length' => '255',
             ));
                $this->hasColumn('beneficiary_name', 2, array(
                    'type' => 'string',
                    'length' => '255'
                ));
                $this->hasColumn('bank_code', array(
                    'type' => 'string',
                    'length' => '45'
                ));
                $this->hasColumn('bank_branch_code', array(
                    'type' => 'string',
                    'length' => '45'
                ));
                $this->hasColumn('bank_account_number', array(
                    'type' => 'string',
                    'length' => '45'
                ));
                $this->hasColumn('bank_name', array(
                    'type' => 'string',
                    'length' => '45'
                ));
                $this->hasColumn('bank_address', array(
                    'type' => 'string',
                    'length' => '45'
                ));


        $this->index('parentindex', array(
             'fields' => 
             array(
              0 => 'parent_id',
             ),
             ));
        $this->index('emailindex', array(
             'fields' => 
             array(
              0 => 'email',
             ),
             'type' => 'unique',
             ));
        $this->index('usernameindex', array(
             'fields' => 
             array(
              0 => 'username',
             ),
             'type' => 'unique',
             ));
        $this->index('refidindex', array(
             'fields' => 
             array(
              0 => 'code',
             ),
             'type' => 'unique',
             ));
        $this->index('bannedindex', array(
             'fields' => 
             array(
              0 => 'is_banned',
             ),
             ));
        $this->index('doindex', array(
             'fields' => 
             array(
              0 => 'is_do',
             ),
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Role as Roles', array(
             'refClass' => 'UserRole',
             'local' => 'user_id',
             'foreign' => 'role_id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('UserRole', array(
             'local' => 'id',
             'foreign' => 'user_id'));

        $this->hasMany('UserMedia', array(
             'local' => 'id',
             'foreign' => 'user_id'));

        $this->hasOne('UserSentEmails', array(
             'local' => 'id',
             'foreign' => 'user_id'));

        $this->hasOne('UserAddress', array(
             'local' => 'id',
             'foreign' => 'user_id'));

        $this->hasMany('Product', array(
             'local' => 'id',
             'foreign' => 'user_id'));

        $this->hasMany('Company', array(
             'local' => 'id',
             'foreign' => 'user_id'));

        $this->hasOne('Transaction', array(
             'local' => 'id',
             'foreign' => 'sender_id'));

        $this->hasMany('WithdrawRequest', array(
             'local' => 'id',
             'foreign' => 'user_id'));

        $this->hasOne('Coupon', array(
             'local' => 'id',
             'foreign' => 'owner_id'));

        $this->hasMany('Question', array(
             'local' => 'id',
             'foreign' => 'user_id'));

        $this->hasMany('Answer', array(
             'local' => 'id',
             'foreign' => 'user_id'));
				
				$this->hasMany('MerchantToAgent', array(
             'local' => 'id',
             'foreign' => 'merchant_user_id'));
				
				$this->hasMany('MerchantToAgent', array(
             'local' => 'id',
             'foreign' => 'agent_user_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}
<?php
abstract class BaseMerchantToAgent extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('merchant_to_agent');
        $this->hasColumn('merchant_user_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('agent_user_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('User', array(
             'local' => 'merchant_user_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('User', array(
             'local' => 'agent_user_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));
    }
}
?>
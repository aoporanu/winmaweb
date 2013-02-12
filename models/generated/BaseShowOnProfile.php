<?php
abstract class BaseShowOnProfile extends Doctrine_Record
{
	public function setTableDefinition() {
		$this->setTableName('show_on_profile');
		$this->hasColumn('product_id', 'integer', null, array(
			'type'=>'integer'
		));
		$this->hasColumn('user_id', 'integer', null, array(
			'type'=>'integer'
		));
	}
	
	public function setUp() {
		parent::setUp();
		$this->hasMany('User', array('local'=>'user_id', 'foreign'=>'id'));
		$this->hasMany('Product', array('local'=>'product_id', 'foreign'=>'id'));
	}
}
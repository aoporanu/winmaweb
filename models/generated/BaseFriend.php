<?php
abstract class BaseFriend extends Doctrine_Record
{
	function setTableDefinition() {
		$this->setTableName('friends');
		$this->hasColumn('user_id', 'integer', null, array(
			'type'=>'integer'
		));
		$this->hasColumn('friends_id', 'integer', null, array(
			'type'=>'integer'
		));
		$this->hasColumn('pending', 'TinyInt');
		$this->hasColumn('created_at', 'timestamp', null, array(
			'type' => 'timestamp',
			'notnull' => true
		));
		$this->hasColumn('approved_at', 'timestamp', null, array(
			'type'		=> 'timestamp',
			'notnull'	=> true
		));
	}
	
	function setUp() {
		parent::setUp();
		$this->hasMany('User', array(
			'local' => 'user_id',
			'foreign' => 'id'
		));
	}
}
<?php

abstract class BaseMessage extends Doctrine_Record
{
	function setTableDefinition() {
		$this->setTableName('messages');
		$this->hasColumn('body', 'string', 255, array(
             'type' => 'string',
             'length' => '1000'
        ));
		$this->hasColumn('sender_id', 'integer', null, array(
			'type'	=> 'integer'
		));
		$this->hasColumn('receiver_id', 'integer', null, array(
			'type' => 'integer'
		));
		$this->hasColumn('created', 'DateTime', null, array(
			'type' => 'DateTime'
		));
		$this->hasColumn('subject', 'string', 255, array(
			'type' => 'string',
			'length' => '1000'
		));
		$this->hasColumn('deleted', 'TinyInt');
		$this->hasColumn('read', 'TinyInt');
		$this->hasColumn('reader_deleted', 'TinyInt');
		$this->hasColumn('sender_deleted', 'TinyInt');
	}
	
	function setUp() {
		parent::setUp();
		$this->hasMany('User', array(
             'local' => 'sender_id',
             'foreign' => 'id'));
    
		$this->hasMany('User', array(
             'local' => 'receiver_id',
             'foreign' => 'id'));
	}

}
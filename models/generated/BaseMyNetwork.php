<?php
abstract class BaseMyNetwork extends Doctrine_Record
{
	public function setTableDefinition() {
		$this->setTableName('my_network');
		$this->hasColumn('id', 'integer', null, array(
			'type'=>'integer'
		));
		$this->hasColumn('title', 'string', 255, array(
				'type' => 'string',
				'length' => '255',
		));
		$this->hasColumn('filename', 'string', 255, array(
				'type' => 'string',
				'length' => '255',
		));
	}
	
	public function setUp() {
		parent::setUp();
		
	}
}
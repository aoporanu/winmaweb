<?php

/**
 * BaseAnswer
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $user_id
 * @property integer $question_id
 * @property string $answer
 * @property User $User
 * @property Question $Question
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseAnswer extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('answer');
        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('question_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('answer', 'string', 1000, array(
             'type' => 'string',
             'length' => '1000',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('User', array(
             'local' => 'user_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Question', array(
             'local' => 'question_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));
    }
}
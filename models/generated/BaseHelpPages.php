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
abstract class BaseHelpPages extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('help_pages');
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('content', 'string', 1000, array(
             'type' => 'string',
             'length' => '1000',
             ));
    }

    public function setUp()
    {
        parent::setUp();
    }
}
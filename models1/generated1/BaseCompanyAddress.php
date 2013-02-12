<?php

/**
 * BaseCompanyAddress
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $company_id
 * @property string $address
 * @property string $city
 * @property string $county
 * @property string $postcode
 * @property integer $country_id
 * @property Company $Company
 * @property Country $Country
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCompanyAddress extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('company_address');
        $this->hasColumn('company_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('address', 'string', 1000, array(
             'type' => 'string',
             'length' => '1000',
             ));
        $this->hasColumn('city', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('county', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('postcode', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('country_id', 'integer', null, array(
             'type' => 'integer',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Company', array(
             'local' => 'company_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Country', array(
             'local' => 'country_id',
             'foreign' => 'id'));

        $geographical0 = new Doctrine_Template_Geographical();
        $this->actAs($geographical0);
    }
}
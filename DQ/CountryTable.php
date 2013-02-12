<?php

class CountryTable extends Doctrine_Table
{
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Country');
    }

    public function getCountries($params = array())
    {
        return $this->createQuery()
                    ->from('Country')
                    ->select('id, name')
										->addWhere('active=?', '1')
                    ->addOrderBy('name ASC');
    }
}

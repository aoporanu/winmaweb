<?php

class ProductPriceTable extends Doctrine_Table
{
    public static function getInstance()
    {
        return Doctrine_Core::getTable('ProductPrice');
    }
    
    public function getProductPrices($params = array())
    {
        return $this->createQuery('p')
                ->addWhere('p.product_id = ?', $params['product_id'])
                ->orderBy('p.price ASC');
    }
}

<?php

class SiteConfigTable extends Doctrine_Table
{
    public static function getInstance()
    {
        return Doctrine_Core::getTable('SiteConfig');
    }
    
    public function getSiteFee($params = array(), $hydrate = Doctrine::HYDRATE_ARRAY)
    {
        return $this->createQuery()
                ->addWhere('config_name = ?', 'site_fee')
                ->fetchOne(array(), $hydrate);
    }
    
    public function getSpendFee($params = array(), $hydrate = Doctrine::HYDRATE_ARRAY)
    {
        return $this->createQuery()
                ->addWhere('config_name = ?', 'spend_fee')
                ->fetchOne(array(), $hydrate);
    }
    
    public function getMerchantFee($params = array(), $hydrate = Doctrine::HYDRATE_ARRAY)
    {
        return $this->createQuery()
                ->addWhere('config_name = ?', 'merchant_fee')
                ->fetchOne(array(), $hydrate);
    }
    
    public function getOfferCommission($params = array(), $hydrate = Doctrine::HYDRATE_ARRAY)
    {
        return $this->createQuery()
                ->addWhere('config_name = ?', 'offer_commission')
                ->fetchOne(array(), $hydrate);
    }
    
    public function getPaypalFee($params = array(), $hydrate = Doctrine::HYDRATE_ARRAY)
    {
        return $this->createQuery()
                ->addWhere('config_name = ?', 'paypal_fee')
                ->fetchOne(array(), $hydrate);
    }
    
    public function getPayoutDelay($params = array(), $hydrate = Doctrine::HYDRATE_ARRAY)
    {
        return $this->createQuery()
                ->addWhere('config_name = ?', 'payout_delay')
                ->fetchOne(array(), $hydrate);
    }
}

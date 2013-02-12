<?php

class ProductTable extends Doctrine_Table
{
    const STATUS_PENDING = 0;
    const STATUS_ACCEPTED = 1;
    const STATUS_REJECTED = -1;
    
    const STATUS_VERIFIED = -2; // after an product expire and not sold 
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Product');
    }
		
		public function getSearchProducts($params = array()) {
			return $this->createQuery()
                    ->from('Product p')
                    ->leftJoin('p.ProductPrice pp')
                    ->leftJoin('p.ProductMedia pm')
										->leftJoin('p.User u')
										->addWhere('name LIKE ?', '%'.$params['term'].'%')
                    ->addWhere('p.status = 1')
										->addWhere('p.starttime <= ?', date('Y-m-d H:i:s'))
                    ->addWhere('p.endtime > ?', date('Y-m-d H:i:s'));
		}
		
		public function getProductsByTag($params = array()) {
			return $this->createQuery()
                    ->from('Product p')
                    ->leftJoin('p.ProductPrice pp')
                    ->leftJoin('p.ProductMedia pm')
										->innerJoin('p.ProductTags pt')
										->innerJoin('pt.Tag t')
										->leftJoin('p.User u')
										->where('pt.tag_id = t.id')
										->where('pt.product_id = p.id')
										->addWhere('t.name = ?', $params['term'])
                    ->addWhere('p.status = 1')
										->addWhere('p.starttime <= ?', date('Y-m-d H:i:s'))
                    ->addWhere('p.endtime > ?', date('Y-m-d H:i:s'));
		}

    public function getUserProductBySlug($params = array()) {
        return $this->createQuery()
                    ->from('Product p')
                    ->leftJoin('p.ProductAddress pa')
                    ->leftJoin('p.ProductPrice pp')
                    ->leftJoin('p.ProductMedia pm')
                    ->leftJoin('p.User u')
                    ->leftJoin('u.Company uc')
                    ->leftJoin('uc.CompanyAddress ca')
                    ->leftJoin('p.ProductTags pt')
                    ->leftJoin('pt.Tag t')
                    ->addWhere('p.slug = ?', $params['productSlug'])
                    ->addWhere('u.username = ?', $params['userSlug'])
                    ->addWhere('p.starttime <= ?', date('Y-m-d H:i:s'))
                    ->addWhere('p.endtime > ?', date('Y-m-d H:i:s'))
                    ->addWhere('p.status = 1')
                    ->addOrderBy('pm.main DESC, pp.price ASC');
    }
    
    public function getProductsByTags($params = array())
    {
        return $this->createQuery()
                    ->select('p.id, p.name, p.short_description, p.endtime, p.slug, p.sold, pp.*, pm.*')
                    ->from('Product p')
                    ->leftJoin('p.ProductPrice pp')
                    ->leftJoin('p.ProductMedia pm WITH pm.main = 1')
                    ->addSelect('pm.*')
                    ->leftJoin('p.ProductTags pt')
                    ->leftJoin('p.User u')
                    ->addSelect('u.username')
                    ->addWhere('p.starttime <= ?', date('Y-m-d H:i:s'))
                    ->addWhere('p.status = 1')
                    ->addWhere('p.endtime > ?', date('Y-m-d H:i:s'))
                    ->andWhereIn('pt.tag_id', $params['tags'])
                    ->andWhereNotIn('p.id', $params['exclude'])
                    ->addOrderBy('pp.price ASC');
    }
    
    public function getActiveProducts()
    {
        return $this->createQuery()
                    ->select('p.id, p.name, p.short_description, p.endtime, p.slug, pp.*, pm.*')
                    ->from('Product p')
                    ->leftJoin('p.ProductPrice pp')
                    ->leftJoin('p.ProductMedia pm WITH pm.main = 1')
                    ->addSelect('pm.*')
                    ->leftJoin('p.User u')
                    ->addSelect('u.username')
                    ->addWhere('p.status = 1')
                    ->addWhere('p.starttime <= ?', date('Y-m-d H:i:s'))
                    ->addWhere('p.endtime > ?', date('Y-m-d H:i:s'))
                    ->orderBy('p.created_at DESC')
                    ->addOrderBy('pp.price ASC');;
    }
    
    public function getProductById($params = array())
    {
        return $this->createQuery()
                    ->from('Product p')
                    ->leftJoin('p.ProductPrice pp')
                    ->leftJoin('p.ProductMedia pm WITH pm.main = 1')
                    ->leftJoin('p.User u')
                    ->addWhere('p.starttime <= ?', date('Y-m-d H:i:s'))
                    ->addWhere('p.endtime > ?', date('Y-m-d H:i:s'))
                    ->addWhere('p.id = ?', $params['product_id'])
                    ->orderBy('pp.price ASC');
    }
    
    public function getRandomProduct()
    {
        return $this->createQuery()
                    ->from('Product p')
                    ->leftJoin('p.ProductPrice pp')
                    ->leftJoin('p.ProductMedia pm WITH pm.main = 1')
                    ->leftJoin('p.User u')
                    ->leftJoin('u.Company uc')
                    ->leftJoin('uc.CompanyAddress ca')
                    ->addWhere('p.status = 1')
                    ->addWhere('p.starttime <= ?', date('Y-m-d H:i:s'))
                    ->addWhere('p.endtime > ?', date('Y-m-d H:i:s'))
                    //->orderBy('p.created_at DESC')
                    ->addOrderBy('pp.price ASC')
                    ->orderBy('RAND()')
                    ->limit(1);
    }
    
    public function getLastProduct()
    {
        return $this->createQuery()
                    ->from('Product p')
                    ->leftJoin('p.ProductPrice pp')
                    ->leftJoin('p.ProductAddress pa')
                    ->leftJoin('p.ProductMedia pm WITH pm.main = 1')
                    ->leftJoin('p.User u')
                    //->leftJoin('p.ProductPrice pp')
                    //->leftJoin('u.Company uc')
                    //->leftJoin('uc.CompanyAddress ca')
                    ->addWhere('p.status = 1')
                    ->addWhere('pp.stock > pp.sold')
                    ->addWhere('p.starttime <= ?', date('Y-m-d H:i:s'))
                    ->addWhere('p.endtime > ?', date('Y-m-d H:i:s'))
                    //->orderBy('p.created_at DESC')
                    ->addOrderBy('pp.price ASC')
                    ->orderBy('p.is_first DESC, p.created_at DESC')
                    ->limit(1);
    }
    
    public function getOtherProducts()
    {
        return $this->createQuery()
                    ->select('p.id, p.name, p.short_description, p.endtime, p.sold, p.slug, pp.*, pm.*')
                    ->from('Product p')
                    ->leftJoin('p.ProductPrice pp')
                    ->leftJoin('p.ProductMedia pm WITH pm.main = 1')
                    ->addSelect('pm.*')
                    ->leftJoin('p.User u')
                    ->addSelect('u.username')
                    ->addWhere('p.status = 1')
                    ->addWhere('p.starttime <= ?', date('Y-m-d H:i:s'))
                    ->addWhere('p.endtime > ?', date('Y-m-d H:i:s'))
                    ->orderBy('p.created_at DESC')
                    ->addOrderBy('pp.price ASC')
                    ->limit(5);
    }
		
		public function getIndexProducts() {
			return $this->createQuery()
							->select('p.id, p.name, p.short_description, p.endtime, p.sold, p.slug, pp.*, pm.*')
							->from('Product p')
							->leftJoin('p.ProductPrice pp')
							->leftJoin('p.ProductMedia pm WITH pm.main = 1')
							->addSelect('pm.*')
							->leftJoin('p.User u')
							->addSelect('u.username')
							->addWhere('p.status = 1')
							->addWhere('p.starttime <= ?', date('Y-m-d H:i:s'))
							->addWhere('p.endtime > ?', date('Y-m-d H:i:s'))
							->orderBy('RAND()')
							->limit(6);
		}
}

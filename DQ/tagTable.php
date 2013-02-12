<?php

class TagTable extends Doctrine_Table
{
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Tag');
    }

    public function getTagByName($params = array())
    {
        return $this->createQuery()
                    ->select('t.name AS value')
                    ->from('Tag t')
                    ->where('name LIKE ?', '%'.$params['term'].'%');
    }
		
		public function getTags() {
			return $this->createQuery()
                    ->select('t.name, count(t.name) as nr')
                    ->from('Tag t')
										->innerJoin('t.ProductTags pt')
										->innerJoin('pt.Product p')
										->where('pt.tag_id = t.id')
										->where('pt.product_id = p.id')
										->addWhere('p.status = 1')
										->addWhere('p.starttime <= ?', date('Y-m-d H:i:s'))
                    ->addWhere('p.endtime > ?', date('Y-m-d H:i:s'))
										->groupBy('t.name')
										->having('nr > 0')
										->orderBy('t.name asc');
		}
}

<?php

class CategoryTable extends Doctrine_Table
{
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Category');
    }

    /**
       * Gets tree element in one query
       */
    public function getCategoryTree()
    {

        $q = $this->createQuery('g')
            ->addWhere('g.level > ?', 0)
            ->orderBy('g.lft');
        return $q->execute(array(),  Doctrine_Core::HYDRATE_ARRAY_HIERARCHY);
    }

}

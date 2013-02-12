<?php

class categoryController extends Cms_Controller
{
    public function init()
    {
        if (!$this->user->hasRole('ADMIN')) {
            $this->redirect('/');
        }
    }
    
    public function showAction()
    {
        $ac = $this->getParam('ac');
        if($ac === 'del') {
            $cat_id = $this->getParam('cat_id');
            $cat = CategoryTable::getInstance()->find($cat_id);
            if($cat) {
                $cat->getNode()->delete();
            }
        }
        if($ac === 'sort') {
            $this->sort();
            die();
        }
        $this->setTemplate('category/show.twig');
        $categories = CategoryTable::getInstance()->getCategoryTree();
        
        return array('categories' => $categories);
    }
    
    public function addAction()
    {
        $this->setTemplate('category/add.twig');
        
        $parent_id = $this->getParam('parent_id');
        if(!$parent_id) {
            return $this->notFoundAction();
        }
        $parent = CategoryTable::getInstance()->find($parent_id);
        if(!$parent->id) {
            return $this->notFoundAction();
        }
        if($parent->level > 1) {
            return $this->forbiddenAction();
        }

        
        $form = new Zend_Form();
        
        $ptitle = $form->createElement('text', 'pname');
        $ptitle->setRequired();
        $ptitle->addPrefixPath('Validate', ROOT_PATH . '/validators', 'validate');
        $ptitle->addValidator('category', true, array('fid' => 0, 'level' => ($parent->level + 1), 'lft' => $parent->lft, 'rgt' => $parent->rgt));
                
        $form->addElement($ptitle);
        
        if( $this->request->getPost() ) {
            if ($form->isValid($this->request->getPost())) {
                $cat = new Category();
                $cat->name = $form->getValue('pname');
                $cat->getNode()->insertAsLastChildOf($parent);
                $form->clearElements();
                $success = true;
            }
        }
        
        return array(
            'form' => array(
                            'values' => $form->getValues(),
                            'errors' => $form->getMessages(),
                            'success' => (isset($success) ? $success : false)
                            ),
            'parent_id' => $parent_id,
        );
        
        
        return array();
    }
    
    public function editAction()
    {
        $this->setTemplate('category/edit.twig');
        
        $cat_id = $this->getParam('cat_id');
        $cat = Doctrine::getTable('Category')->find($cat_id);
        if(!$cat->id) {
            return $this->notFoundAction();
        }
        
        
        
        $parent = $cat->getNode()->getParent();
        
        $form = new Zend_Form();
        
        $ptitle = $form->createElement('text', 'pname');
        $ptitle->setRequired();
        $ptitle->addPrefixPath('Validate', ROOT_PATH . '/validators', 'validate');
        $ptitle->addValidator('category', true, array('fid' => $cat_id, 'level' => ($parent->level + 1), 'lft' => $parent->lft, 'rgt' => $parent->rgt));
        $ptitle->setValue($cat->name);
        
        $form->addElement($ptitle);
        
        if( $this->request->getPost() ) {
            if ($form->isValid($this->request->getPost())) {
                $cat->name = $form->getValue('pname');
                $cat->save();
                $success = true;
            }
        }
        
        return array(
            'form' => array(
                            'values' => $form->getValues(),
                            'errors' => $form->getMessages(),
                            'success' => (isset($success) ? $success : false)
                            ),
            'cat_id' => $cat_id,
        );
    }
    
    protected function sort() {
        $ids = $this->getParam('s_pages');
        $ids = array_reverse($ids);
        $pid = $this->getParam('parent_id');
        $parent = Doctrine::getTable('Category')->find($pid);
        if(!$parent->id) {
            return $this->notFoundAction();
        }
        foreach ($ids AS $id) {
            $node = Doctrine_Core::getTable('Category')->find($id);
            if ($node->getNode()->isDescendantOf($parent))
            {
                $node->getNode()->moveAsFirstChildOf($parent);
                $node->save();
            }
        }
    }
}
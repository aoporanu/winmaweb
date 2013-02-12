<?php

class Site_Forms_Product_Add extends Zend_Form
{
    public function init ()
    {
        $name = $form->createElement('text', 'name');
        $name->addPrefixPath('Validate', ROOT_PATH . '/validators', 'validate');
        $name->addValidator('pNameUnq', false, array('exclude_id' => 0, 'user_id' => $this->user->getUser()->get('id')))
                ->addValidator('stringLength', false, array(2, 200))
                 ->setRequired(true);
                 //->addFilter('StringToLower');
        
        $short_description = $form->createElement('textarea', 'short_description');
        $short_description->addValidator('stringLength', false, array(2, 200))
                        ->setRequired(true);
        
        $description = $form->createElement('textarea', 'description');
        $description->setRequired(true);
        
        $terms = $form->createElement('textarea', 'terms');
        
        /*$producer_price = $form->createElement('text', 'producer_price');
        $producer_price->addValidator('Float', true)
                   ->addValidator('GreaterThan', true, array('min' => 0, 'messages' => 'Price must be higher than 0'))
                   ->setRequired(true);
        
        $discount = $form->createElement('text', 'discount');
        $discount->addValidator('Int', true)
                   ->addValidator('GreaterThan', true, array('min' => 0, 'messages' => 'Discount must be higher than 0'))
                   ->addValidator('Between', true, array('min' => 1, 'max' => 99))
                   ->setRequired(true);
        
        $stock = $form->createElement('text', 'stock');
        $stock->addValidator('Int', true)
                   ->addValidator('GreaterThan', true, array('min' => 0, 'messages' => 'Stock must be higher than 0'))
                   ->setRequired(true);*/
        
        $tags = $form->createElement('text', 'tags');
        $tags->setRequired();
        
        $treeObject = Doctrine_Core::getTable('Category')->find(1);
        $tree = $treeObject->getNode()->getChildren();
        $category = $form->createElement('select', 'category');
        $subcategory = $form->createElement('select', 'subcategory');

        $to_check = array();
        $category->setRequired();
        $subcategory->setRequired();
        $category->addMultiOption('', '');
        $subcategory->addMultiOption('', 'Please selected a category first');

        foreach ($tree as $node) {
            $category->addMultiOption($node['id'], $node['name']);
            $children = $node->getNode()->getChildren();
            foreach($children as $child) {
                $to_check[$child['id']] = '';
                $subc[$node['id']][$child['id']] = $child['name'];
                if($this->request->getParam('category') == $node['id']) {
                    $subcategory->addMultiOption($child['id'], $child['name']);
                } 
            }
        }
        
        $category->addValidator('InArray', false, array(array_keys($category->getMultiOptions()), 'messages' =>'This category it is not in the original select values'));
        $subcategory->addValidator('InArray', false, array(array_keys($to_check), 'messages' =>'This subcategory it is not in the original select values'));
        
        $start_time = $form->createElement('text', 'start_time');
        $start_time->addValidator('Date', true, array('yyyy-MM-DD H:m'))
                   ->setRequired();
        $end_time = $form->createElement('text', 'end_time');
        $end_time->addPrefixPath('Validate', ROOT_PATH . '/validators', 'validate');
        $end_time->addValidator('pEndTime', true, array())
                   ->addValidator('date', true, array('format' => 'yyyy-MM-DD H:m'))
                   ->setRequired();
        
        $photo = new Zend_Form_Element_File('photo');
        $photo->addValidator('Extension', false, 'jpg,png,gif');
        $form->addElement($photo, 'photo');
        
        
        $form->addElement($name)
                ->addElement($tags)
                ->addElement($description)
                ->addElement($terms)
                ->addElement($short_description)
                ->addElement($producer_price)
                ->addElement($stock)
                ->addElement($discount)
                ->addElement($category)
                ->addElement($subcategory)
                ->addElement($start_time)
                ->addElement($end_time);
    }
}
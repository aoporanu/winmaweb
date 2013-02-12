<?php
class PagerLayoutWithArrows extends Doctrine_Pager_Layout
{
    public function display($options = array(), $return = false)
    {
        $pager = $this->getPager();
        $str = '';

        // First page
        $this->addMaskReplacement('page', '&laquo;', true);
        $options['page_number'] = $pager->getFirstPage();
        $str .= $this->processPage($options);

        // Previous page
        $this->addMaskReplacement('page', '&lsaquo;', true);
        $options['page_number'] = $pager->getPreviousPage();
        $str .= $this->processPage($options);

        // Pages listing
        $this->removeMaskReplacement('page');
        $str .= parent::display($options, true);

        // Next page
        $this->addMaskReplacement('page', '&rsaquo;', true);
        $options['page_number'] = $pager->getNextPage();
        $str .= $this->processPage($options);

        // Last page
        $this->addMaskReplacement('page', '&raquo;', true);
        $options['page_number'] = $pager->getLastPage();
        $str .= $this->processPage($options);

        // No
        $this->addMaskReplacement('page', 'All pages:', true);
        
        $str .= '<li class="all">Total: '.$pager->getNumResults().'</li>';
        
        // Possible wish to return value instead of print it on screen
        if ($return) {
            return $str;
        }

        echo $str;
    }
}

class productController extends Cms_Controller
{
    public function init()
    {
        if (!$this->user->hasRole('ADMIN')) {
            $this->redirect('/');
        }
    }
    
     public function showAction()
    {
        $this->setTemplate('product/show.twig');
        
        $page = $this->getParam('page');
        if($page < 1) {
            $page = 1;
        }
        
        $ac = $this->getParam('ac');
        
        if($ac == 'edit') {
            return $this->editAction();
        }
        
        if($ac == 'main') {
            $id = $this->getParam('id');
            $q = Doctrine_Query::create()
                        ->update('Product')
                        ->set('is_first', 0)
                        ->execute();
            $q = Doctrine_Query::create()
                        ->update('Product')
                        ->addWhere('id = ?', $id)
                        ->set('is_first', 1)
                        ->execute();
        }
        
        $show = $this->getParam('show');
        $s = '';
        switch($show) {
            case 'rejected':
                $s = '&show=rejected';
                $query = Doctrine_Query::create()
                            ->select('p.id, p.name, p.short_description, p.sold, p.starttime, p.status, p.factor, p.endtime, pm.*, u.*')
                            ->from('Product p')
                            ->leftJoin('p.ProductMedia pm WITH pm.main = 1')
                            ->leftJoin('p.User u')
                            ->addWhere('p.status = ?', ProductTable::STATUS_REJECTED);
            break;
        
            case 'accepted':
                $s = '&show=accepted';
                $query = Doctrine_Query::create()
                            ->select('p.id, p.name, p.short_description, p.sold, p.starttime, p.status, p.factor, p.is_first, p.endtime, pm.*, u.*')
                            ->from('Product p')
                            ->leftJoin('p.ProductMedia pm WITH pm.main = 1')
                            ->leftJoin('p.User u')
                            ->addWhere('p.status = ?', ProductTable::STATUS_ACCEPTED)
                        ->orderBy('is_first DESC');
            break;
        
            default:
                $query = Doctrine_Query::create()
                            ->select('p.id, p.name, p.short_description, p.sold, p.starttime, p.status, p.factor, p.endtime, p.is_first, pm.*, u.*')
                            ->from('Product p')
                            ->leftJoin('p.ProductMedia pm WITH pm.main = 1')
                            ->leftJoin('p.User u')
                            ->addWhere('p.status = ?', ProductTable::STATUS_PENDING);
            break;
        }
        
        $pagerLayout = new PagerLayoutWithArrows(
                new Doctrine_Pager(
                    $query,
                    $page, 25),
                      new Doctrine_Pager_Range_Sliding(array(
                            'chunk' => 5
                      )),
                '/admin/products?page={%page_number}'.$s
            );
        $pagerLayout->setTemplate('<li><a href="{%url}">{%page}</a></li>');
        $pagerLayout->setSelectedTemplate('<li class="selected">{%page}</li>');
        
        // Fetching users
        $products = $pagerLayout->execute(array(), Doctrine::HYDRATE_ARRAY);

        return array(
            'products' => $products,
            'pagination' => $pagerLayout->display(array(), true),
            'show' => $show
        );
    }
    
    public function editAction()
    {
        if(!$this->request->isXmlHttpRequest()) {
            return $this->notFoundAction();
        }
        
        $id = $this->getParam('id');
        $product = Doctrine_Query::create()
                    ->from('Product p')
                    ->leftJoin('p.ProductPrice pp')
                    ->addWhere('p.id = ?', $id)
                    ->leftJoin('p.User u')
                    ->fetchOne();
        if(!$product->id) {
            $this->forbiddenAction('You dont have acces to this product');
        }
        
        $this->setTemplate('product/edit.twig');
        
        $form = new Zend_Form();

        $factor = $form->createElement('text', 'factor');
        $factor->addValidator('Int', true)
                   ->addValidator('GreaterThan', true, array('min' => 0, 'messages' => 'Factor must be higher than 0'))
                   ->addValidator('Between', true, array('min' => 1, 'max' => 99))
                   ->setRequired(true)
                    ->setValue($product->factor);
        
        $name = $form->createElement('text', 'name');
        $name->addPrefixPath('Validate', ROOT_PATH . '/validators', 'validate');
        $name->addValidator('pNameUnq', false, array('exclude_id' => $product->id, 'user_id' => $product->User->id))
                ->addValidator('stringLength', false, array(2, 200))
                 ->setRequired(true)
                 ->setValue($product->name);
        $short_description = $form->createElement('textarea', 'short_description');
        $short_description->addValidator('stringLength', false, array(2, 200))
                        ->setRequired(true)
                 ->setValue($product->short_description);
        
        $description = $form->createElement('textarea', 'description');
        $description->setRequired(true)
                 ->setValue($product->description);
        
        $terms = $form->createElement('textarea', 'terms');
        $terms->setValue($product->terms);
        
        $query_tags = Doctrine_Query::create()
                    ->select('pt.product_id, t.name AS tag')
                    ->from('ProductTags pt')
                    ->leftJoin('pt.Tag t')
                    ->where('pt.product_id = ?', $product->id)
                    ->execute(array(), Doctrine::HYDRATE_ARRAY);
        $_tag = array();
        if($query_tags) {
            foreach($query_tags AS $_tags) {
                $_tag[] = $_tags['tag'];
            }
        }
        $tags = $form->createElement('text', 'tags');
        $tags->setRequired()
                ->setValue(implode(',', $_tag));
        
        $status = $form->createElement('select', 'status');
        $status->addMultiOption('0', 'Pending');
        $status->addMultiOption('-1', 'Rejected');
        $status->addMultiOption('1', 'Accepted');
				$status->addMultiOption('2', 'Not confirmed');
        $status->addValidator('InArray', false, array(array_keys($status->getMultiOptions())));
        $status->setValue($product->status);
        
//        $treeObject = Doctrine_Core::getTable('Category')->find(1);
//        $tree = $treeObject->getNode()->getChildren();
//        $category = $form->createElement('select', 'category');
//        $subcategory = $form->createElement('select', 'subcategory');

//        $to_check = array();
//        $category->setRequired();
//        $subcategory->setRequired();
//        $category->addMultiOption('', '');
//        $subcategory->addMultiOption('', 'Please selected a category first');

//        foreach ($tree as $node) {
//            $category->addMultiOption($node['id'], $node['name']);
//            $children = $node->getNode()->getChildren();
//            foreach($children as $child) {
//                $to_check[$child['id']] = '';
//                $subc[$node['id']][$child['id']] = $child['name'];
//                if($product->category_id == $child['id']) {
//                    $par = $child->getNode()->getParent()->toArray();
//                    $category->setValue($par['id']);
//                    $subcategory->setValue($child['id']);
//                    $subcategory->addMultiOption($child['id'], $child['name']);
//                }
//                /*if($this->request->getParam('category') == $node['id']) {
//                    $subcategory->addMultiOption($child['id'], $child['name']);
//                } */
//            }
//        }
        
//        $category->addValidator('InArray', false, array(array_keys($category->getMultiOptions()), 'messages' =>'This category it is not in the original select values'));
//        $subcategory->addValidator('InArray', false, array(array_keys($to_check), 'messages' =>'This subcategory it is not in the original select values'));
        
        $start_time = $form->createElement('text', 'start_time');
        $start_time->addValidator('Date', true, array('yyyy-MM-DD H:m'))
                   ->setRequired()
                 ->setValue($product->starttime);
        $end_time = $form->createElement('text', 'end_time');
        $end_time->addPrefixPath('Validate', ROOT_PATH . '/validators', 'validate');
        $end_time->addValidator('pEndTime', true, array())
                   ->addValidator('date', true, array('format' => 'yyyy-MM-DD H:m'))
                   ->setRequired()
                 ->setValue($product->endtime);
        
        $priceForm = new Zend_Form;
        
        if( $this->request->getPost() ) {
            $no = count($_POST['price']);
            if($no == 0) {
                $no = 1;
            }
        } else {
            $no = count($product->ProductPrice);
            $pp = $product->ProductPrice->toArray();
        }
        $y = 0;
        for($x = 1; $x<=$no; $x++) {
            $price_name[$x] = $priceForm->createElement('text', 'offer_price_name_'.$x);
            $price_name[$x]->setRequired(true)
                    ->setValue($pp[$y]['name']);
        
            $producer_price[$x] = $priceForm->createElement('text', 'producer_price_'.$x);
            $producer_price[$x]->addValidator('Float', true, array('locale' => 'en_US'))
                       ->addValidator('GreaterThan', true, array('min' => 0, 'messages' => 'Price must be higher than 0'))
                       ->setRequired(true)
                    ->setValue($pp[$y]['suplier_price']);

            $discount[$x] = $priceForm->createElement('text', 'discount_'.$x);
//            $discount[$x]->addValidator('Int', true)
                    $discount[$x]->addValidator('Float', true, array('locale' => 'en_US'))
                       ->addValidator('GreaterThan', true, array('min' => 0, 'messages' => 'Discount must be higher than 0'))
                       ->addValidator('Between', true, array('min' => 1, 'max' => 99))
                       ->setRequired(true)
                    ->setValue($pp[$y]['discount']);

            $stock[$x] = $priceForm->createElement('text', 'stock_'.$x);
            $stock[$x]->addValidator('Int', true)
                       ->addValidator('GreaterThan', true, array('min' => 0, 'messages' => 'Stock must be higher than 0'))
                       ->setRequired(true)
                    ->setValue($pp[$y]['stock']);
            $expire[$x] = $priceForm->createElement('text', 'expire_'.$x);
            $expire[$x]->addValidator('Date', true, array('yyyy-MM-DD'))
                   ->setRequired()->setValue($pp[$y]['expire_at']);
            
            $priceForm->addElement($producer_price[$x])
                ->addElement($stock[$x])
                ->addElement($discount[$x])
                ->addElement($price_name[$x])
                ->addElement($expire[$x]);
            $y++;
        }
        //company
        $companies = Doctrine_Query::create()
                        ->from('Company')
                        ->select('id, name')
                        ->addOrderBy('name ASC')
                        ->where('id = ?', $product->company_id)
                        ->execute(array(), DOCTRINE::HYDRATE_ARRAY);

        $company = $form->createElement('select', 'company');
        //$company->setRequired(true);
        foreach($companies AS $c){
            $company->addMultiOption($c['id'], $c['name']);
        }
        $company->addValidator('InArray', false, array(array_keys($company->getMultiOptions()), 'messages' =>'This company it is not in the original select values'));
        $company->setValue($product->company_id);
        //
        $min_sold = $form->createElement('text', 'min_sold');
        $min_sold->addValidator('Int', true)
                   ->addValidator('GreaterThan', true, array('min' => 0, 'messages' => 'Minimum sold deals need to be at least 1'))
                   ->setRequired(true)
                   ->setValue($product->min_sold);
        $max_sold = $form->createElement('text', 'max_sold');
        $max_sold->addValidator('Int', true)
                   ->addValidator('GreaterThan', true, array('min' => 0, 'messages' => 'Maximum amount of deals per user need to be at least 1'))
                   ->setRequired(true)
                    ->setValue($product->max_buy);
        
        
        $form->addSubForm($priceForm, 'OfferPrices');
        
        $form->addElement($name)
                ->addElement($tags)
                ->addElement($description)
                ->addElement($terms)
                ->addElement($short_description)
//                ->addElement($category)
//                ->addElement($subcategory)
                ->addElement($start_time)
                ->addElement($end_time)
                ->addElement($factor)
                ->addElement($status)
                ->addElement($min_sold)
                ->addElement($max_sold)
                ->addElement($company);
        
        if( $this->request->getPost() ) {
            if ($form->isValid($this->request->getPost())) {
                
                $product->name = $form->getValue('name');
                $product->short_description = $form->getValue('short_description');
                $product->description = $form->getValue('description');
                $product->terms = $form->getValue('terms');
                //$product->suplier_price = $form->getValue('producer_price');
                //$product->discount = $form->getValue('discount');
                //$product->stock = $form->getValue('stock');
                $product->starttime = $form->getValue('start_time');
                $product->endtime = $form->getValue('end_time');
//                $product->category_id = $form->getValue('subcategory');
                
                $product->min_sold = $form->getValue('min_sold');
                $product->max_buy = $form->getValue('max_sold');
                
                $product->company_id = $form->getValue('company');
                
                $product->status = $form->getValue('status');
                $product->factor = $form->getValue('factor');
                
                $product->save();
                
                Doctrine_Query::create()
                    ->delete('ProductPrice')
                    ->addWhere('product_id = ?', $product->id)
                    ->execute();
                
                $productPrices = new Doctrine_Collection('ProductPrice');
                $no = count($_POST['price']);
                if($no == 0) {
                    $no = 1;
                }
                $values = $form->getValues();

                for($x = 1; $x<=$no; $x++) {
                    $p = new ProductPrice();
                    $p->name = $values['OfferPrices']['offer_price_name_'.$x];
                    $p->suplier_price = $values['OfferPrices']['producer_price_'.$x];
                    $p->discount = $values['OfferPrices']['discount_'.$x];
                    $p->stock = $values['OfferPrices']['stock_'.$x];
                    $p->expire_at = $values['OfferPrices']['expire_'.$x];
                    
                    
                    $p->money_save = ($values['OfferPrices']['producer_price_'.$x]*$values['OfferPrices']['discount_'.$x]/100);
                    $p->price = $values['OfferPrices']['producer_price_'.$x] - $p->money_save;
                    $p->product_id = $product->id;
                    $productPrices->add($p);
                }
                $productPrices->save();
                
                Doctrine_Query::create()
                    ->delete('ProductTags')
                    ->addWhere('product_id = ?', $product->id)
                    ->execute();
                
                $collection = new Doctrine_Collection('ProductTags');
                $tags = explode(',', $form->getValue('tags'));

                foreach( $tags AS $tag) {
                    $t = new Tag();
                    $t->name = $tag;
                    $t->link('Products', array($product->id));
                    $collection->add($t);
                }

                $collection->save();


                $success = true;
            }
                
        }
        
        $is_ajax = $this->request->getParam('isajaxrequest');
        
        if(!$is_ajax) {
            $is_ajax = $this->request->isXmlHttpRequest();
        }
        
        return array(
                'form' => array(
                        'values' => $form->getValues(),
                        'errors' => $form->getMessages(),
//                        'categories' => $form->category,
//                        'subcategories' => $form->subcategory,
                        'status' => $form->status,
                        'companies' => $form->company,
                        'success' => (isset($success) ? $success : false)
                    ),
                'price_form' => $priceForm,
                'imgajax' => $is_ajax,
                'no' => $no,
                'product_id' => $id
            );
    }
		
		
		public function galleryAction()
    {
        $is_ajax = $this->request->getParam('isajaxrequest');
        
        if(!$is_ajax) {
            $is_ajax = $this->request->isXmlHttpRequest();
        }
        
        if(!$is_ajax) {
            //return $this->notFoundAction();
        }
        
        $id = $this->getParam('id');
        
        $product = Doctrine_Query::create()
                    ->select('p.id, p.name')
                    ->from('Product p')
                    ->addWhere('p.id = ?', $id)
//                    ->addWhere('p.user_id = ?', $this->user->getUser()->get('id'))
                    ->fetchOne();
//        if(!$product->id) {
//            $this->forbiddenAction('You dont have acces to this product');
//        }
        
        $action = $this->getParam('ac');
        switch($action)
        {
            case 'delete':
                $pic_id = $this->getParam('pic_id');
                $picObj = Doctrine_Query::create()
                            ->from('ProductMedia pm')
                            ->addWhere('pm.id = ?', $pic_id)
                            ->addWhere('pm.product_id = ?', $product->id)
                            ->count();
                if(!$picObj) {
                    $this->forbiddenAction('You dont have acces to this picture');
                }
                $q = Doctrine_Query::create()
                            ->delete('ProductMedia')
                            ->addWhere('product_id = ?', $product->id)
                            ->whereIn('id', array($pic_id));

                $numDeleted = $q->execute();
                if($numDeleted) {
                    @unlink(ROOT_PATH . '/uploads/products/images/product_'.$pic_id.'.jpg');
                    @unlink(ROOT_PATH . '/uploads/products/images/thumb120x67/product_'.$pic_id.'.jpg');
                    @unlink(ROOT_PATH . '/uploads/products/images/thumb250x156/product_'.$pic_id.'.jpg');
                    @unlink(ROOT_PATH . '/uploads/products/images/thumb380x237/product_'.$pic_id.'.jpg');
                }
            break;
            case 'main':
                $pic_id = $this->getParam('pic_id');
                $picObj = Doctrine_Query::create()
                            ->from('ProductMedia pm')
                            ->addWhere('pm.id = ?', $pic_id)
                            ->addWhere('pm.product_id = ?', $product->id)
                            ->count();
                if(!$picObj) {
                    $this->forbiddenAction('You dont have acces to this picture');
                }
                $q = Doctrine_Query::create()
                            ->update('ProductMedia')
                            ->addWhere('product_id = ?', $product->id)
                            ->addWhere('type = ?', 'image')
                            ->set('main', 0)
                            ->execute();
                $q = Doctrine_Query::create()
                        ->update('ProductMedia')
                        ->addWhere('product_id = ?', $product->id)
                        ->addWhere('id = ?', $pic_id)
                        ->set('main', 1)
                        ->execute();
            break;
            
            case 'crop':
                $pic_id = $this->getParam('pic_id');
                $picObj = Doctrine_Query::create()
                            ->from('ProductMedia pm')
                            ->addWhere('pm.id = ?', $pic_id)
                            ->addWhere('pm.product_id = ?', $product->id)
                            ->count();
                if(!$picObj) {
                    $this->forbiddenAction('You dont have acces to this picture');
                }
                return $this->crop($pic_id, $product->id);
            break;
        }
        
        $this->setTemplate('product/gallery.twig');
        
        $form = new Zend_Form();
        
        $photo = new Zend_Form_Element_File('photo');
        $photo->addValidator('Extension', false, 'jpg,png,gif');
        $form->addElement($photo, 'photo');
        
        if( $this->request->getPost() ) {
            if ($form->isValid($this->request->getPost())) {
                require_once(ROOT_PATH . '/lib/wi/WideImage.php');
                require_once(ROOT_PATH . '/lib/Cms/Image.php');
                
                if($_FILES['photo']['tmp_name']) {
                    $image = new Cms_Image($_FILES['photo']['tmp_name'], '/uploads/products/images', $product, 'product');
                    $image->setWidth(800);
                    $image->setHeight(800);
                    $image->createImage(array(
                        'fileName' => 'product',
                        'thumbs' => array(
                                array(
                                    'width' => 380,
                                    'height' => 237,
                                    'dir' => '/uploads/products/images/thumb380x237'
                                ),
                                array(
                                    'width' => 250,
                                    'height' => 156,
                                    'dir' => '/uploads/products/images/thumb250x156'
                                    ),
                                array(
                                    'width' => 120,
                                    'height' => 67,
                                    'dir' => '/uploads/products/images/thumb120x67'
                                ),
                                array(
                                    'width' => 800,
                                    'height' => 600,
                                    'dir' => '/uploads/products/images/thumbcrop'
                                )
                        )

                    ));
                }
            }
        }
        $product = Doctrine_Query::create()
                    ->select('p.id, p.name, pm.*')
                    ->from('Product p')
                    ->leftJoin('p.ProductMedia pm')
                    ->addWhere('p.id = ?', $id)
//                    ->addWhere('p.user_id = ?', $this->user->getUser()->get('id'))
                    ->fetchOne(array(), DOctrine::HYDRATE_ARRAY);
        
        return array(
                'form' => array(
                        'values' => $form->getValues(),
                        'errors' => $form->getMessages(),
                        'categories' => $form->category,
                        'subcategories' => $form->subcategory,
                        'success' => (isset($success) ? $success : false)
                    ),
                'imgajax' => $is_ajax,
                'product' => $product
        );
    }
		
		public function crop($pic_id, $prod_id)
    {
        $this->setTemplate('product/crop.twig');
        $form = new Zend_Form();
        $err = '';
        if( $this->request->getPost() ) {
            if ($form->isValid($this->request->getPost())) {
                require_once(ROOT_PATH . '/lib/wi/WideImage.php');
                require_once(ROOT_PATH . '/lib/Cms/Image.php');
                if($_POST['x'] == '' || $_POST['y'] == '') {
                    //$form->addError('You need to select a part of the image');
                    $err = 'You need to select a part of the image';
                } else {
                    $thumbs = array(
                                array(
                                    'width' => 380,
                                    'height' => 237,
                                    'dir' => '/uploads/products/images/thumb380x237'
                                ),
                                array(
                                    'width' => 250,
                                    'height' => 156,
                                    'dir' => '/uploads/products/images/thumb250x156'
                                    ),
                                array(
                                    'width' => 120,
                                    'height' => 67,
                                    'dir' => '/uploads/products/images/thumb120x67'
                                )
                        );
                    $origImage = WideImage::loadFromFile(ROOT_PATH.'/uploads/products/images/thumbcrop/product_' . $pic_id . '.jpg');
                    $newImg = $origImage->crop($_POST['x'], $_POST['y'], $_POST['w'], $_POST['h']);

                    //$newImg->saveToFile(ROOT_PATH . '/uploads/products/images/product_' . $pic_id . '.jpg', 100);
                    foreach($thumbs AS $thumb) {
                        $thumbImg = $newImg->resize($thumb['width'], $thumb['height'], 'outside', 'down');
                        $thumbImg = $thumbImg->resizeCanvas($thumb['width'], $thumb['height'], 'center', 'middle', 'ffffff', 'any');
                        $thumbImg->saveToFile(ROOT_PATH . $thumb['dir'] . '/product_' . $pic_id . '.jpg', 100);
                    }
                }
            }
        }
        
        return array(
            'image' => '/uploads/products/images/thumbcrop/product_'.$pic_id.'.jpg',
            'pic_id' => $pic_id,
            'prod_id' => $prod_id,
            'err' => $err
        );
    }
}
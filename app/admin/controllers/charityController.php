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

class charityController extends Cms_Controller
{
    public function init()
    {
        if (!$this->user->hasRole('ADMIN')) {
            $this->redirect('/');
        }
    }
    
    public function showAction()
    {
        $this->setTemplate('charity/show.twig');
        
        $show = $this->getParam('show');
        $s = '';
        switch($show) {
            case 'expired':
                $s = '&show=expired';
                $query = Doctrine_Query::create()
                            ->select('c.id, c.name, c.short_description, c.sold, c.starttime, c.status, p.endtime, c.amount, cm.*')
                            ->from('Charity c')
                            ->addWhere('c.endtime < ?', date('Y-m-d H:i:s'))
                            ->leftJoin('c.CharityMedia cm WITH cm.main = 1');
            break;
        
            case 'will':
                $s = '&show=will';
                $query = Doctrine_Query::create()
                            ->select('c.id, c.name, c.short_description, c.sold, c.starttime, c.status, p.endtime, c.amount, cm.*')
                            ->from('Charity c')
                            ->addWhere('c.starttime > ?', date('Y-m-d H:i:s'))
                            ->leftJoin('c.CharityMedia cm WITH cm.main = 1');
            break;
        
            default:
                $action = $this->getParam('ac');
                if($action === 'main') {
                    $id = $this->getParam('id');
                    $q = Doctrine_Query::create()
                                ->update('Charity')
                                ->set('is_first', 0)
                                ->execute();
                    $q = Doctrine_Query::create()
                                ->update('Charity')
                                ->addWhere('id = ?', $id)
                                ->set('is_first', 1)
                                ->execute();
                }
                $query = Doctrine_Query::create()
                            ->select('c.id, c.name, c.short_description, c.sold, c.starttime, c.status, p.endtime, c.amount, c.is_first, cm.*')
                            ->from('Charity c')
                            ->addWhere('c.starttime <= ?', date('Y-m-d H:i:s'))
                            ->addWhere('c.endtime >= ?', date('Y-m-d H:i:s'))
                            ->leftJoin('c.CharityMedia cm WITH cm.main = 1')
                            ->orderBy('c.is_first DESC');
            break;
        }
        
        $pagerLayout = new PagerLayoutWithArrows(
                new Doctrine_Pager(
                    $query,
                    $page, 25),
                      new Doctrine_Pager_Range_Sliding(array(
                            'chunk' => 5
                      )),
                '/admin/charity?page={%page_number}'.$s
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
    
    public function addAction()
    {
        $this->setTemplate('charity/add.twig');
        $is_ajax = $this->request->getParam('isajaxrequest');
        
        if(!$is_ajax) {
            $is_ajax = $this->request->isXmlHttpRequest();
        }
        
        $form = new Zend_Form();
				
        $name = $form->createElement('text', 'name');
        $name->addPrefixPath('Validate', ROOT_PATH . '/validators', 'validate');
        $name->addValidator('pNameUnq', false, array('exclude_id' => 0, 'user_id' => $this->user->getUser()->get('id')))
                ->addValidator('stringLength', false, array(2, 200))
                 ->setRequired(true);
        
        $short_description = $form->createElement('textarea', 'short_description');
        $short_description->addValidator('stringLength', false, array(2, 200))
                        ->setRequired(true);
        
        $description = $form->createElement('textarea', 'description');
        $description->setRequired(true);
        
        $terms = $form->createElement('textarea', 'terms');
        $start_time = $form->createElement('text', 'start_time');
        $start_time->addValidator('Date', true, array('yyyy-MM-DD H:m'))
                   ->setRequired();
        $end_time = $form->createElement('text', 'end_time');
        $end_time->addPrefixPath('Validate', ROOT_PATH . '/validators', 'validate');
        $end_time->addValidator('pEndTime', true, array())
                   ->addValidator('date', true, array('format' => 'yyyy-MM-DD H:m'))
                   ->setRequired();
        //address
        $address = $form->createElement('text', 'address');
        $address->setRequired(true);

        $city = $form->createElement('text', 'city');
        $city->setRequired(true);

        $county = $form->createElement('text', 'county');
        $county->setRequired(true);

        $postcode = $form->createElement('text', 'postcode');
        $postcode->setRequired(true);
        
        $country = $form->createElement('select', 'country');
        $country->setRequired(true);
        $countries = Doctrine_Query::create()
                        ->from('Country')
                        ->select('id, name')
                        ->addWhere('active=?', '1')
                        ->addOrderBy('name ASC')
                        ->execute(array(), DOCTRINE::HYDRATE_ARRAY);
        
        foreach($countries AS $c){
            $country->addMultiOption($c['id'], $c['name']);
        }
        $country->addValidator('InArray', false, array(array_keys($country->getMultiOptions()), 'messages' =>'This country it is not in the original select values'));
        $g_lat = $form->createElement('hidden', 'g_lat');
        $g_lat->setValue(0)->setRequired(true);
        $g_lng = $form->createElement('hidden', 'g_lng');
        $g_lng->setValue(0)->setRequired(true);
        
        $photo = new Zend_Form_Element_File('photo123');
        $photo->addValidator('Extension', false, 'jpg,png,gif');
        
        $form->addElement($name)
                ->addElement($short_description)
                ->addElement($description)
                ->addElement($terms)
                ->addElement($start_time)
                ->addElement($end_time)
                ->addElement($address)
                ->addElement($city)
                ->addElement($county)
                ->addElement($postcode)
                ->addElement($country)
                ->addElement($g_lat)
                ->addElement($g_lng)
                ->addElement($photo);
        if( $this->request->getPost() ) {
            if ($form->isValid($this->request->getPost())) {
                if($photo->isValid()) {
                    
                    $charity = new Charity();
                    $charity->name = $form->getValue('name');
                    $charity->short_description = $form->getValue('short_description');
                    $charity->description = $form->getValue('description');
                    $charity->terms = $form->getValue('terms');
                    $charity->starttime = $form->getValue('start_time');
                    $charity->endtime = $form->getValue('end_time');
                    $charity->user_id = $this->user->getUser()->get('id');
                    
                    $charity->CharityAddress->address = $form->getValue('address');
                    $charity->CharityAddress->city = $form->getValue('city');
                    $charity->CharityAddress->county = $form->getValue('county');
                    $charity->CharityAddress->postcode = $form->getValue('postcode');
                    $charity->CharityAddress->country_id = $form->getValue('country');
                    $charity->CharityAddress->latitude = $form->getValue('g_lat');
                    $charity->CharityAddress->longitude = $form->getValue('g_lng');
                    
                    $charity->save();
                    
                    require_once(ROOT_PATH . '/lib/wi/WideImage.php');
                    require_once(ROOT_PATH . '/lib/Cms/Image.php');
                    
                    if($_FILES['photo123']['tmp_name']) {
                        $image = new Cms_Image($_FILES['photo123']['tmp_name'], '/uploads/charity/images', $charity, 'charity');
                        $image->setWidth(800);
                        $image->setHeight(800);
                        $image->createImage(array(
                            'fileName' => 'charity',
                            'thumbs' => array(
                                    array(
                                        'width' => 380,
                                        'height' => 237,
                                        'dir' => '/uploads/charity/images/thumb380x237'
                                    ),
                                    array(
                                        'width' => 250,
                                        'height' => 156,
                                        'dir' => '/uploads/charity/images/thumb250x156'
                                        ),
                                    array(
                                        'width' => 120,
                                        'height' => 67,
                                        'dir' => '/uploads/charity/images/thumb120x67'
                                    )
                            )

                        ));
                    }
                    $success = true;
                    $form->reset();
                } else {
                    $form->addError('Invalid image');
                    $success = false;
                    $err_img = 'Invalid image type.';
                }
            }
        }
        return array(
            'form' => array(
                        'values' => $form->getValues(),
                        'errors' => $form->getMessages(),
                        'countries' => $form->country,
                        'success' => (isset($success) ? $success : false)
                    ),
                'imgajax' => $is_ajax,
                'err_img' => $err_img
        );
    }
    
    public function editAction()
    {
        $is_ajax = $this->request->getParam('isajaxrequest');
        
        if(!$is_ajax) {
            $is_ajax = $this->request->isXmlHttpRequest();
        }
        $id = $this->getParam('id');
        $charity = Doctrine_Query::create()
                    ->from('Charity c')
                    ->leftJoin('c.CharityAddress ca')
                    ->addWhere('c.id = ?', $id)
                    ->fetchOne();
        if(!$charity->id) {
            $this->forbiddenAction('This charity do not exists!');
        }
        
        $this->setTemplate('charity/edit.twig');
        
        $form = new Zend_Form();
				
        $name = $form->createElement('text', 'name');
        $name->addPrefixPath('Validate', ROOT_PATH . '/validators', 'validate');
        $name->addValidator('pNameUnq', false, array('exclude_id' => 0, 'user_id' => $this->user->getUser()->get('id')))
                ->addValidator('stringLength', false, array(2, 200))
                 ->setRequired(true)
                ->setValue($charity->name);
        
        $short_description = $form->createElement('textarea', 'short_description');
        $short_description->addValidator('stringLength', false, array(2, 200))
                        ->setRequired(true)->setValue($charity->short_description);
        
        $description = $form->createElement('textarea', 'description');
        $description->setRequired(true)->setValue($charity->description);
        
        $terms = $form->createElement('textarea', 'terms')->setValue($charity->terms);
        $start_time = $form->createElement('text', 'start_time');
        $start_time->addValidator('Date', true, array('yyyy-MM-DD H:m'))
                   ->setRequired()->setValue($charity->starttime);
        $end_time = $form->createElement('text', 'end_time');
        $end_time->addPrefixPath('Validate', ROOT_PATH . '/validators', 'validate');
        $end_time->addValidator('pEndTime', true, array())
                   ->addValidator('date', true, array('format' => 'yyyy-MM-DD H:m'))
                   ->setRequired()->setValue($charity->endtime);
        //address
        $address = $form->createElement('text', 'address');
        $address->setRequired(true)->setValue($charity->CharityAddress->address);

        $city = $form->createElement('text', 'city');
        $city->setRequired(true)->setValue($charity->CharityAddress->city);

        $county = $form->createElement('text', 'county');
        $county->setRequired(true)->setValue($charity->CharityAddress->county);

        $postcode = $form->createElement('text', 'postcode');
        $postcode->setRequired(true)->setValue($charity->CharityAddress->postcode);
        
        $country = $form->createElement('select', 'country');
        $country->setRequired(true);
        $countries = Doctrine_Query::create()
                        ->from('Country')
                        ->select('id, name')
                        ->addWhere('active=?', '1')
                        ->addOrderBy('name ASC')
                        ->execute(array(), DOCTRINE::HYDRATE_ARRAY);
        
        foreach($countries AS $c){
            $country->addMultiOption($c['id'], $c['name']);
        }
        $country->addValidator('InArray', false, array(array_keys($country->getMultiOptions()), 'messages' =>'This country it is not in the original select values'));
        $g_lat = $form->createElement('hidden', 'g_lat');
        $g_lat->setValue(0)->setRequired(true)->setValue($charity->CharityAddress->latitude);
        $g_lng = $form->createElement('hidden', 'g_lng');
        $g_lng->setValue(0)->setRequired(true)->setValue($charity->CharityAddress->longitude);
        
        
        
        $form->addElement($name)
                ->addElement($short_description)
                ->addElement($description)
                ->addElement($terms)
                ->addElement($start_time)
                ->addElement($end_time)
                ->addElement($address)
                ->addElement($city)
                ->addElement($county)
                ->addElement($postcode)
                ->addElement($country)
                ->addElement($g_lat)
                ->addElement($g_lng);
        if( $this->request->getPost() ) {
            if ($form->isValid($this->request->getPost())) {
                
                    //$charity = new Charity();
                    $charity->name = $form->getValue('name');
                    $charity->short_description = $form->getValue('short_description');
                    $charity->description = $form->getValue('description');
                    $charity->terms = $form->getValue('terms');
                    $charity->starttime = $form->getValue('start_time');
                    $charity->endtime = $form->getValue('end_time');
                    $charity->user_id = $this->user->getUser()->get('id');
                    
                    $charity->CharityAddress->address = $form->getValue('address');
                    $charity->CharityAddress->city = $form->getValue('city');
                    $charity->CharityAddress->county = $form->getValue('county');
                    $charity->CharityAddress->postcode = $form->getValue('postcode');
                    $charity->CharityAddress->country_id = $form->getValue('country');
                    $charity->CharityAddress->latitude = $form->getValue('g_lat');
                    $charity->CharityAddress->longitude = $form->getValue('g_lng');
                    
                    $charity->save();
                    
                    $success = true;
            }
        }
        return array(
            'form' => array(
                        'values' => $form->getValues(),
                        'errors' => $form->getMessages(),
                        'countries' => $form->country,
                        'success' => (isset($success) ? $success : false)
                    ),
                'imgajax' => $is_ajax,
                'err_img' => $err_img,
            'cid' => $charity->id
        );
    }
    
    public function galleryAction()
    {
        $is_ajax = $this->request->getParam('isajaxrequest');
        
        if(!$is_ajax) {
            $is_ajax = $this->request->isXmlHttpRequest();
        }
        
        if(!$is_ajax) {
            return $this->notFoundAction();
        }
        
        $id = $this->getParam('id');
        
        $charity = Doctrine_Query::create()
                    ->select('c.id, c.name')
                    ->from('Charity c')
                    ->addWhere('c.id = ?', $id)
                    ->fetchOne();
        if(!$charity->id) {
            $this->forbiddenAction('You dont have acces to this product');
        }
        
        $action = $this->getParam('ac');
        switch($action)
        {
            case 'delete':
                $pic_id = $this->getParam('pic_id');
                $picObj = Doctrine_Query::create()
                            ->from('CharityMedia pm')
                            ->addWhere('pm.id = ?', $pic_id)
                            ->addWhere('pm.charity_id = ?', $charity->id)
                            ->count();
                if(!$picObj) {
                    $this->forbiddenAction('You dont have acces to this picture');
                }
                $q = Doctrine_Query::create()
                            ->delete('CharityMedia')
                            ->addWhere('charity_id = ?', $charity->id)
                            ->whereIn('id', array($pic_id));

                $numDeleted = $q->execute();
                if($numDeleted) {
                    @unlink(ROOT_PATH . '/uploads/charity/images/product_'.$pic_id.'.jpg');
                    @unlink(ROOT_PATH . '/uploads/charity/images/thumb120x67/product_'.$pic_id.'.jpg');
                    @unlink(ROOT_PATH . '/uploads/charity/images/thumb250x156/product_'.$pic_id.'.jpg');
                    @unlink(ROOT_PATH . '/uploads/charity/images/thumb380x237/product_'.$pic_id.'.jpg');
                }
            break;
            case 'main':
                $pic_id = $this->getParam('pic_id');
                $picObj = Doctrine_Query::create()
                            ->from('CharityMedia pm')
                            ->addWhere('pm.id = ?', $pic_id)
                            ->addWhere('pm.charity_id = ?', $charity->id)
                            ->count();
                if(!$picObj) {
                    $this->forbiddenAction('You dont have acces to this picture');
                }
                $q = Doctrine_Query::create()
                            ->update('CharityMedia')
                            ->addWhere('charity_id = ?', $charity->id)
                            ->addWhere('type = ?', 'image')
                            ->set('main', 0)
                            ->execute();
                $q = Doctrine_Query::create()
                        ->update('CharityMedia')
                        ->addWhere('charity_id = ?', $charity->id)
                        ->addWhere('id = ?', $pic_id)
                        ->set('main', 1)
                        ->execute();
            break;
        }
        
        $this->setTemplate('charity/gallery.twig');
        
        $form = new Zend_Form();
        
        $photo = new Zend_Form_Element_File('photo');
        $photo->addValidator('Extension', false, 'jpg,png,gif');
        $form->addElement($photo, 'photo');
        
        if( $this->request->getPost() ) {
            if ($form->isValid($this->request->getPost())) {
                require_once(ROOT_PATH . '/lib/wi/WideImage.php');
                require_once(ROOT_PATH . '/lib/Cms/Image.php');
                
                if($_FILES['photo']['tmp_name']) {
                    $image = new Cms_Image($_FILES['photo']['tmp_name'], '/uploads/charity/images', $charity, 'charity');
                    $image->setWidth(800);
                    $image->setHeight(800);
                    $image->createImage(array(
                        'fileName' => 'charity',
                        'thumbs' => array(
                                array(
                                    'width' => 380,
                                    'height' => 237,
                                    'dir' => '/uploads/charity/images/thumb380x237'
                                ),
                                array(
                                    'width' => 250,
                                    'height' => 156,
                                    'dir' => '/uploads/charity/images/thumb250x156'
                                    ),
                                array(
                                    'width' => 120,
                                    'height' => 67,
                                    'dir' => '/uploads/charity/images/thumb120x67'
                                )
                        )

                    ));
                }
            }
        }
        $product = Doctrine_Query::create()
                    ->select('c.id, c.name, cm.*')
                    ->from('Charity c')
                    ->leftJoin('c.CharityMedia cm')
                    ->addWhere('c.id = ?', $id)
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
}
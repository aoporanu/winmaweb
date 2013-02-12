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
    /*
     * 
     */

    public function init()
    {
        if (!$this->user->isAuthenticated()) {
            $this->redirect('/');
        }
        
        if($this->user->hasRole('ADMIN')) {
            $this->redirect('/admin');
        }
        
        if (!$this->user->hasRole('SHOP') && !$this->user->hasRole('AGENT')) {
            return $this->forbiddenAction();
        }
        
        //print_r($this->user->getUser()->get('id'));
    }
    
    public function showAction()
    {
        $this->setTemplate('myaccount/products/show.twig');
        
        $page = $this->getParam('page');
        if($page < 1) {
            $page = 1;
        }
        $action = $this->getParam('ac');
        switch($action)
        {
            case 'delete':
                $prod_id = $this->getParam('id');
                $check_q = Doctrine_Query::create()
                            ->from('Product p')
                            ->addWhere('p.id = ?', $prod_id)
                            ->addWhere('p.user_id = ?', $this->user->getUser()->get('id'))
                            ->count();
                if(!$check_q) {
                    $this->forbiddenAction('You dont have acces to this product');
                }
                $del_pics_q = Doctrine_Query::create()
                                ->from('ProductMedia pm')
                                ->addWhere('pm.product_id = ?', $prod_id)
                                ->execute(array(), Doctrine::HYDRATE_ARRAY);
                foreach($del_pics_q as $dpic) {
                    @unlink(ROOT_PATH . '/uploads/products/images/product_'.$dpic['id'].'.jpg');
                    @unlink(ROOT_PATH . '/uploads/products/images/thumb120x67/product_'.$dpic['id'].'.jpg');
                    @unlink(ROOT_PATH . '/uploads/products/images/thumb208x130/product_'.$dpic['id'].'.jpg');
                }
                
                Doctrine_Query::create()
                        ->delete('Product p')
                        ->addWhere('p.id = ?', $prod_id)
                        ->execute();
                
            break;
            
            case 'prices':
                $prod_id = $this->getParam('pid');
                $pr = Doctrine_Query::create()
                            ->from('Product p')
                            ->leftJoin('p.ProductPrice pp')
                            ->addWhere('p.id = ?', $prod_id)
                            ->addWhere('p.user_id = ?', $this->user->getUser()->get('id'))
                            ->fetchOne(array(), Doctrine::HYDRATE_ARRAY);
                if(!$pr['id']) {
                    $this->forbiddenAction('You dont have acces to this product');
                }
                $this->setTemplate('myaccount/products/prices.twig');
                
                return array(
                    'product' => $pr
                );
           break;
           
           case 'questions':
                return $this->questions();
           break;
        }
        
        $options = $this->getParam('options');
        $pagerLayout = new PagerLayoutWithArrows(
                new Doctrine_Pager(
                    Doctrine_Query::create()
                        ->select('p.id, p.name, p.status, p.sold, p.factor, p.starttime, p.endtime, p.slug, p.merchant_user_id, pm.*, pp.*, sop.*')
                        ->from('Product p')
                        ->leftJoin('p.ProductMedia pm WITH pm.main = 1')
                        ->leftJoin('p.ProductPrice pp')
                        ->leftJoin('p.ShowOnProfile sop ON sop.product_id = p.id')
												->leftJoin('p.User u')
												->addSelect('u.username')
                        ->where('p.user_id = ?', $this->user->getUser()->get('id'))
                        ,
                    $page, 25),
                      new Doctrine_Pager_Range_Sliding(array(
                            'chunk' => 5
                      )),
                '/my-account/my-offers?page={%page_number}'
            );
        $pagerLayout->setTemplate('<li><a href="{%url}">{%page}</a></li>');
        $pagerLayout->setSelectedTemplate('<li class="selected">{%page}</li>');
        
        // Fetching users
        $products = $pagerLayout->execute(array(), Doctrine::HYDRATE_ARRAY);
		$c_file = '';
        if(file_exists(ROOT_PATH . '/uploads/contracts/contract.pdf')) {
//            $c_file = '/uploads/contracts/contract.pdf';
						$c_file = '/my-account/contract/download';
        }
        $date = date('Y-m-d H:i:s');
        return array(
						'cFile' => $c_file,
            'products' => $products,
            'pagination' => $pagerLayout->display(array(), true),
            'date' => $date
        );
    }

	function showOnProfileAction() {
		$this->setTemplate('myaccount/products/showOnProfile.twig');
		$id = $this->getParam('id');
		$user_id = $this->user->getUser()->id;
		if($id) {
			$show = Doctrine_Query::create()
				->select('s.id')
				->from('ShowOnProfile s')
				->where('s.product_id = ?', $id)
				->andWhere('s.user_id = ?', $user_id)
				->execute();
			if(count($show) >= 1) {
				$show1 = Doctrine_Query::create()
					->delete('ShowOnProfile s')
					->where('s.product_id = ?', $id)
					->andWhere('s.user_id = ?', $user_id)
					->execute();
				return array('message'=>'This product will no longer show up on your profile page'); 
			} else {
				$sop = new ShowOnProfile();
				$sop->product_id = $id;
				$sop->user_id = $user_id;
				$sop->save();
				return array('message'=>'This product will show up on your profile page.');
			}
		}
	}
    
    protected function questions()
    {
        $m = $this->getParam('m');
        
        $prod_id = $this->getParam('id');
        $page = $this->getParam('page');
        
        $pr = Doctrine_Query::create()
                    ->from('Product p')
                    ->leftJoin('p.ProductPrice pp')
                    ->addWhere('p.id = ?', $prod_id)
                    ->addWhere('p.user_id = ?', $this->user->getUser()->get('id'))
                    ->fetchOne(array(), Doctrine::HYDRATE_ARRAY);
        if(!$pr['id']) {
            $this->forbiddenAction('You dont have acces to this product');
        }
        
        if($m == 'a') {
            return $this->addAnswer();
        }
        
        $query = Doctrine::getTable('Question')
            ->createQuery()
            ->from('Question q')
            ->leftJoin('q.User uq')
            ->leftJoin('q.Answer a')
            ->leftJoin('a.User ua')
            ->addWhere('q.product_id = ?', $pr['id'])
            ->orderBy('q.id DESC')
            ->orderBy('a.id DESC');

        $pagerLayout = new PagerLayoutWithArrows(
            new Doctrine_Pager(
                $query,
                $page, 10),
                  new Doctrine_Pager_Range_Sliding(array(
                        'chunk' => 5
                  )),
            '/my-account/my-offers?ac=questions&id='.$prod_id.'&page={%page_number}'.$l
        );
        $pagerLayout->setTemplate('<li><a href="{%url}">{%page}</a></li>');
        $pagerLayout->setSelectedTemplate('<li class="selected">{%page}</li>');

        // Fetching users
        $questions = $pagerLayout->execute(array(), Doctrine::HYDRATE_ARRAY);
        $pg = $pagerLayout->display(array(), true);
        $this->setTemplate('myaccount/products/questions.twig');
        
        return array('questions' => $questions, 'pagination' => $pg, 'pid' => $pr['id'], 'page' => $page);
    }
    
    protected function addAnswer()
    {
        $this->setTemplate('myaccount/products/addAnswer.twig');
        
        $qid = $this->getParam('qid');
        $prod_id = $this->getParam('id');
        
        $qD = Doctrine::getTable('Question')->createQuery()
                ->addWhere('id = ?', $qid)
                ->addWhere('product_id = ?', $prod_id)
                ->fetchOne(array(), Doctrine::HYDRATE_ARRAY);
        if(!$qD['id']) {
            $this->forbiddenAction('You dont have acces');
        }
        
        
        $form = new Zend_Form();
        $q = $form->createElement('textarea', 'answer');
        $q->addValidator('stringLength', false, array(10, 550))
            ->setRequired(true);
        $form->addElement($q);

        if( $this->request->getPost() ) {
            if ($form->isValid($this->request->getPost())) {
                if($this->user->hasRole('user')) {
                    $qu = $form->getValue('answer');
                    $qt = new Answer();
                    $qt->user_id = $this->user->getUser()->get('id');
                    $qt->question_id = $qD['id'];
                    $qt->answer = $qu;
                    $qt->save();
                    $form->reset();
                    $success = true;
               }
            }
        }

        $this->setTemplate('/myaccount/products/addAnswer.twig');
        $page = $this->getParam('page');
        return array(
            'form' => array(
                    'values' => $form->getValues(),
                    'errors' => $form->getMessages(),
                    'success' => (isset($success) ? $success : false)
                ),
            'pid' => $prod_id,
            'qid' => $qD['id'],
            'page' => $page
            );
    }
    
    public function addAction()
    {
        $is_ajax = $this->request->getParam('isajaxrequest');
        
        if(!$is_ajax) {
            $is_ajax = $this->request->isXmlHttpRequest();
        }
        
//        if(!$is_ajax) {
//            return $this->notFoundAction();
//        }
        
        $this->setTemplate('myaccount/products/add.twig');
        
				$user = $this->user->getUser();
        $form = new Zend_Form();
				
				//ddd
				$contract = new Zend_Form_Element_File('contract');
//				$fileName = $contract->getFileName(null, false);
        $contract->addValidator('Extension', false, 'pdf')
                ->setRequired()
                ->setValueDisabled(true)
                ->addFilter('Rename',
                   array('target' => ROOT_PATH . '/uploads/contracts/contract_'. md5($user->id.'+ceva!') .'.pdf',
                         'overwrite' => true));
				//end ddd
        
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
        
        $tags = $form->createElement('text', 'tags');
        $tags->setRequired();
        
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
//                if($this->request->getParam('category') == $node['id']) {
//                    $subcategory->addMultiOption($child['id'], $child['name']);
//                } 
//            }
//        }
        
//        $category->addValidator('InArray', false, array(array_keys($category->getMultiOptions()), 'messages' =>'This category it is not in the original select values'));
//        $subcategory->addValidator('InArray', false, array(array_keys($to_check), 'messages' =>'This subcategory it is not in the original select values'));
        
        $start_time = $form->createElement('text', 'start_time');
//        $start_time->addValidator('Date', true, array('yyyy-MM-DD H:m'))
				$start_time->addValidator('Date', true, array('yyyy-MM-DD'))
                   ->setRequired();
        $end_time = $form->createElement('text', 'end_time');
        $end_time->addPrefixPath('Validate', ROOT_PATH . '/validators', 'validate');
        $end_time->addValidator('pEndTime', true, array())
                   //->addValidator('date', true, array('format' => 'yyyy-MM-DD H:m'))
								->addValidator('date', true, array('format' => 'yyyy-MM-DD'))
                   ->setRequired();
        
        //$photo = new Zend_Form_Element_File('photo');
        //$photo->addValidator('Extension', false, 'jpg,png,gif');
        //$form->addElement($photo, 'photo');
        
        //dynamic price
        $priceForm = new Zend_Form;
        
        $no = count($_POST['price']);
        if($no == 0) {
            $no = 1;
        }
        for($x = 1; $x<=$no; $x++) {
            $price_name[$x] = $priceForm->createElement('text', 'offer_price_name_'.$x);
            $price_name[$x]->setRequired(true);
        
            $producer_price[$x] = $priceForm->createElement('text', 'producer_price_'.$x);
            $producer_price[$x]->addValidator('Float', true, array('locale' => 'en_US'))
                       ->addValidator('GreaterThan', true, array('min' => 0, 'messages' => 'Price must be higher than 0'))
                       ->setRequired(true);

            $discount[$x] = $priceForm->createElement('text', 'discount_'.$x);
//            $discount[$x]->addValidator('Int', true)
						$discount[$x]->addValidator('Float', true, array('locale' => 'en_US'))
                       ->addValidator('GreaterThan', true, array('min' => 0, 'messages' => 'Discount must be higher than 0'))
                       ->addValidator('Between', true, array('min' => 1, 'max' => 99))
                       ->setRequired(true);

            $stock[$x] = $priceForm->createElement('text', 'stock_'.$x);
            $stock[$x]->addValidator('Int', true)
                       ->addValidator('GreaterThan', true, array('min' => 0, 'messages' => 'Stock must be higher than 0'))
                       ->setRequired(true);
            
            $expire[$x] = $priceForm->createElement('text', 'expire_'.$x);
            $expire[$x]->addValidator('Date', true, array('yyyy-MM-DD'))
                   ->setRequired();
            
            $priceForm->addElement($producer_price[$x])
                ->addElement($stock[$x])
                ->addElement($discount[$x])
                ->addElement($price_name[$x])
                ->addElement($expire[$x]);
        }
        //company
//        $companies = Doctrine_Query::create()
//                        ->from('Company')
//                        ->select('id, name')
//                        ->addOrderBy('name ASC')
//                        ->addWhere('user_id = ?', $this->user->getUser()->get('id'))
//                        ->execute(array(), DOCTRINE::HYDRATE_ARRAY);
//
//        $company = $form->createElement('select', 'company');
//        $company->setRequired(true);
//        foreach($companies AS $c){
//            $company->addMultiOption($c['id'], $c['name']);
//        }
//        $company->addValidator('InArray', false, array(array_keys($company->getMultiOptions()), 'messages' =>'This company it is not in the original select values'));
        
//				$merchant_user_id = $form->createElement('select', 'merchant_user_id');
//				$m2a_users = Doctrine_Query::create()
//									->select('u.*, c.*, ca.*')
//									->from('User u')
//                                                                        ->leftJoin('u.Company c')
//                                                                        ->leftJoin('c.CompanyAddress ca')
//									->innerJoin('u.MerchantToAgent m2a ON m2a.merchant_user_id = u.id')
//									->where('u.is_active = 1')
//                                                                        ->where('c.company_type = 1')
//									->addWhere('m2a.agent_user_id = ?', $this->user->getUser()->get('id'))
//									->fetchArray();
//                                if (count($m2a_users) == 0 && $user->is_do == 0) {
//                                    return array('err' => 1212, 'imgajax' => $is_ajax);
//                                }
//                                if($user->is_do == 1) {
//                                    $merchant_user_id->addMultiOption('0', '-- Myself --');
//                                }
//                                
//				foreach ($m2a_users AS $u)	{
//                                    $forMASA[$u['id']] = $u['Company'][0];
//                                    //print_r($u['Company'][0]);
//					$option_name = '';
//					if ($u['first_name'] != '' || $u['last_name'] != '') {
//						$option_name .= '(';
//						if ($u['first_name'] != '') {
//							$option_name .= $u['first_name'];
//						}
//						if ($u['last_name'] != '') {
//							if ($u['first_name'] != '') $option_name .= ' ';
//							$option_name .= $u['last_name'];
//						}
//						$option_name .= ')';
//					}
//					$merchant_user_id->addMultiOption($u['id'], $u['username'] . $option_name);
//				}
//				$merchant_user_id->addValidator('InArray', false, array(array_keys($merchant_user_id->getMultiOptions()), 'messages' =>'This user it is not in the original select values'));
        //
				$merchant_ref_id = $form->createElement('text', 'merchant_ref_id');
				$merchant_ref_id->setRequired(true);
				
				$usr = Doctrine_Query::create()
										->select('u.ref_id')
										->from('User u')
										->innerJoin('u.UserRole ur')
										->innerJoin('ur.Role r')
										->addWhere("u.is_active = 1 and r.name = 'SHOP'")
										->fetchArray();
				$users = array();
				foreach ($usr as $temp_user) {
					$users[] = $temp_user['ref_id'];
				}
				$merchant_ref_id->addValidator('InArray', false, array($users, 'messages' =>'Invalid referral ID.'));
				
				$form->addElement($merchant_ref_id);
				
				$terms_checkbox = $form->createElement('checkbox', 'terms_checkbox')
							->setRequired(true)
							->addValidator('InArray', false, array(array('1'), 'messages' => 'You must agree TERMS AND CONDITIONS'));
			$form->addElement($terms_checkbox);
				
        //address masii
        $address = $form->createElement('text', 'address');
        $address->setRequired(true);

        $city = $form->createElement('text', 'city');
        $city->setRequired(true);

        $county = $form->createElement('text', 'county');
        $county->setRequired(true);

        $postcode = $form->createElement('text', 'postcode');
        $postcode->setRequired(true);

        $countries = Doctrine_Query::create()
                        ->from('Country')
                        ->select('id, name')
												->addWhere('active=?', '1')
                        ->addOrderBy('name ASC')
                        ->execute(array(), DOCTRINE::HYDRATE_ARRAY);

        $country = $form->createElement('select', 'country');
        $country->setRequired(true);
        foreach($countries AS $c){
            $country->addMultiOption($c['id'], $c['name']);
        }
        $country->addValidator('InArray', false, array(array_keys($country->getMultiOptions()), 'messages' =>'This country it is not in the original select values'));
//        $country->setValue(77);
        $g_lat = $form->createElement('hidden', 'g_lat');
        $g_lat->setValue(0)->setRequired(true);
        $g_lng = $form->createElement('hidden', 'g_lng');
        $g_lng->setValue(0)->setRequired(true);
        
        $phone = $form->createElement('text', 'phone');
        $phone->setRequired(true);
        //$wmw_section = $form->createElement('text', 'wmw_section');
        //$wmw_section->setRequired(true);
        
        if($user->is_do == 1) {
            if($user->Company[0]->company_type == 1) {
                $address->setValue($user->Company[0]->CompanyAddress->address);
                $city->setValue($user->Company[0]->CompanyAddress->city);
                $county->setValue($user->Company[0]->CompanyAddress->county);
                $postcode->setValue($user->Company[0]->CompanyAddress->postcode);
                $country->setValue($user->Company[0]->CompanyAddress->country_id);
                $g_lat->setValue($user->Company[0]->CompanyAddress->latitude);
                $g_lng->setValue($user->Company[0]->CompanyAddress->longitude);

                $phone->setValue($user->Company[0]->phone);
                $forMASA[0] = $user->Company[0]->toArray();
                //$forMASA[0]['latitude'] = $user->Company[0]->CompanyAddress->latitude;
                //$forMASA[0]['longitude'] = $user->Company[0]->CompanyAddress->longitude;
            }
            if($user->Company[1]->company_type == 1) {
                $address->setValue($user->Company[1]->CompanyAddress->address);
                $city->setValue($user->Company[1]->CompanyAddress->city);
                $county->setValue($user->Company[1]->CompanyAddress->county);
                $postcode->setValue($user->Company[1]->CompanyAddress->postcode);
                $country->setValue($user->Company[1]->CompanyAddress->country_id);
                $g_lat->setValue($user->Company[1]->CompanyAddress->latitude);
                $g_lng->setValue($user->Company[1]->CompanyAddress->longitude);

                $phone->setValue($user->Company[1]->phone);
                $forMASA[0] = $user->Company[1]->toArray();
                //$forMASA[0]['latitude'] = $user->Company[1]->CompanyAddress->latitude;
                //$forMASA[0]['longitude'] = $user->Company[1]->CompanyAddress->longitude;
            }
        } else {
					$phone->setValue($user->phone);
					$address->setValue($user->UserAddress->address);
					$city->setValue($user->UserAddress->city);
					$county->setValue($user->UserAddress->county);
					$postcode->setValue($user->UserAddress->postcode);
					$country->setValue($user->UserAddress->country_id);
				}
        
        
        
        $form->addElement($address)
            ->addElement($city)
            ->addElement($county)
            ->addElement($postcode)
            ->addElement($country)
                 ->addElement($g_lat)
                 ->addElement($g_lng)
                ->addElement($phone);
                //->addElement($wmw_section);
                                
                                
                                
                                
        $min_sold = $form->createElement('text', 'min_sold');
        $min_sold->addValidator('Int', true)
                   ->addValidator('GreaterThan', true, array('min' => 0, 'messages' => 'Minimum sold deals need to be at least 1'))
                   ->setRequired(true);
        $max_sold = $form->createElement('text', 'max_sold');
        $max_sold->addValidator('Int', true)
                   ->addValidator('GreaterThan', true, array('min' => 0, 'messages' => 'Maximum amount of deals per user need to be at least 1'))
                   ->setRequired(true);
        
        $photo = new Zend_Form_Element_File('photo123');
        $photo->addValidator('Extension', false, 'jpg,png,gif');
        
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
                ->addElement($min_sold)
                ->addElement($max_sold);
//                ->addElement($company);
        
        if( $this->request->getPost() ) {
            if ($form->isValid($this->request->getPost())) {
							//if ($form->contract->receive()) {
//								if ($fileName == 'contract-'.$user->id.'.pdf') {
                if($photo->isValid()) {
                    $product = new Product();
                    $product->name = $form->getValue('name');
                    $product->short_description = $form->getValue('short_description');
                    $product->description = $form->getValue('description');
                    $product->terms = $form->getValue('terms');
                    //$product->suplier_price = $form->getValue('producer_price');
                    //$product->discount = $form->getValue('discount');
                    //$product->stock = $form->getValue('stock');
										$product->status = '2';
                    $product->starttime = $form->getValue('start_time');
                    $product->endtime = $form->getValue('end_time');
                    $product->user_id = $this->user->getUser()->get('id');
//                    $product->category_id = $form->getValue('subcategory');

                    $product->min_sold = $form->getValue('min_sold');
                    $product->max_buy = $form->getValue('max_sold');

                    //$product->money_save = ($form->getValue('producer_price')*$form->getValue('discount')/100);
                    //$product->price = $form->getValue('producer_price') - ($form->getValue('producer_price')*$form->getValue('discount')/100);
//                    $cid = Doctrine_Query::create()
//                                            ->select('u.*, c.*')
//                                            ->from('User u')
//                                            ->leftJoin('u.Company c')
//                                            ->addWhere('u.id = ?', $form->getValue('merchant_user_id'))
//                                            ->addWhere('c.company_type = 1')
//                                            ->fetchOne(array(), Doctrine::HYDRATE_ARRAY);
//                    if($form->getValue('merchant_user_id') == 0) {
//                        if($user->Company[0]->company_type == 1) {
//                            $product->company_id = $user->Company[0]->id;
//                        }
//                        if($user->Company[1]->company_type == 1) {
//                            $product->company_id = $user->Company[1]->id;
//                        }
//                    } else {
//                        $product->company_id = $cid['Company'][0]['id'];
//                    }
                    
										
                    $product->phone = $form->getValue('phone');
                    //$product->wmw_section = $form->getValue('wmw_section');
                    $product->ProductAddress->address = $form->getValue('address');
                    $product->ProductAddress->city = $form->getValue('city');
                    $product->ProductAddress->county = $form->getValue('county');
                    $product->ProductAddress->postcode = $form->getValue('postcode');
                    $product->ProductAddress->country_id = $form->getValue('country');
                    $product->ProductAddress->latitude = $form->getValue('g_lat');
                    $product->ProductAddress->longitude = $form->getValue('g_lng');
										$usr = Doctrine_Query::create()
										->select('u.*')
										->from('User u')
										->innerJoin('u.UserRole ur')
										->innerJoin('ur.Role r')
										->addWhere("u.is_active = 1 and r.name = 'SHOP' AND u.ref_id = '".$form->getValue('merchant_ref_id')."'")
										->fetchOne();
                    
                    $product->merchant_user_id = $usr->id;
                    $link = "winmaweb.com/my-account/get-my-deals";
                    $contactMessage = 'A new offer was added by one of your agents. To view and confirm the offer please follow this link:<br /><br /><a href="http://'.
                        $link.'">Confirm</a>';
                    /*require_once 'Swift/swift_required.php';
                    $transport = Swift_SendmailTransport::newInstance('/usr/sbin/sendmail -bs');
                    $mailer = Swift_Mailer::newInstance($transport);
                    //Create a message
                    /*$message = Swift_Message::newInstance('A new offer was added by one of your agents.')
                      ->setFrom(array('office@winmaweb.com' => 'winmaweb'))
                      ->setBody($contactMessage, 'text/html');
                        $message->setTo($usr->email);
                        $mailer->send($message);*/
                    $product->save();
										
                    if($product->id) {
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

                        $collection = new Doctrine_Collection('ProductTags');
                        $tags = explode(',', $form->getValue('tags'));

                        foreach( $tags AS $tag) {
                            $t = new Tag();
                            $t->name = $tag;
                            $t->link('Products', array($product->id));
                            $collection->add($t);
                        }

                        $collection->save();

                        //try {
                    require_once(ROOT_PATH . '/lib/wi/WideImage.php');
                    require_once(ROOT_PATH . '/lib/Cms/Image.php');
                    
                    if($_FILES['photo123']['tmp_name']) {
                        $image = new Cms_Image($_FILES['photo123']['tmp_name'], '/uploads/products/images', $product, 'product');
                        $image->setWidth(800);
                        $image->setHeight(800);
                        $image->createImage(array(
                            'fileName' => 'product',
                            'thumbs' => array(
                                array(
                                    'width' => 610,
                                    'height' => 290,
                                    'dir' => '/uploads/products/images/thumb610x290'
                                ),
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
                                    'width' => 600,
                                    'height' => 600,
                                    'dir' => '/uploads/products/images/thumbcrop'
                                )
                            )

                        ));
                    }
                        //} catch (Exception $e) {
                        //   $form->addError('There was a problem uploading the image, please add it again direcly on product.' . $e->getMessage());
                        //    echo $e->getMessage();
                        // echo $e->getCode();
                            //echo $e->getTraceAsString();
                        //}
                    }
                
                $form->reset();
                //$form->addElement($category)
                //    ->addElement($subcategory);
                $success = true;
                } else {
                    $form->addError('Invalid image');
                    $success = false;
                    $err_img = 'Invalid image type.';
                }
//								} else {
//									$contract->addError('Please upload the contract with the same name of the file you downloaded');
//								}
						/*} else {
							$contract->addError('Something went wrong uploading the file, please try again!');
            }*/
					}
        }
        //print_r($form->getErrors());
        
        return array(
                'form' => array(
                        'values' => $form->getValues(),
                        'errors' => $form->getMessages(),
//                        'categories' => $form->category,
//                        'subcategories' => $form->subcategory,
                    'countries' => $form->country,
//                        'companies' => $form->company,
												'merchant_user_id' => $form->merchant_user_id,
                        'success' => (isset($success) ? $success : false)
                    ),
                'price_form' => $priceForm,
                'no' => ($no),
                'imgajax' => $is_ajax,
                'err_img' => $err_img,
            'for_masa' => json_encode($forMASA)
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
                    ->addWhere('p.id = ?', $id)
                    ->addWhere('p.user_id = ?', $this->user->getUser()->get('id'))
                    ->fetchOne();
        if(!$product->id) {
            $this->forbiddenAction('You dont have acces to this product');
        }
        
        $this->setTemplate('myaccount/products/edit.twig');
        
        $form = new Zend_Form();

        $name = $form->createElement('text', 'name');
        $name->addPrefixPath('Validate', ROOT_PATH . '/validators', 'validate');
        $name->addValidator('pNameUnq', false, array('exclude_id' => $product->id, 'user_id' => $this->user->getUser()->get('id')))
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
        
        $producer_price = $form->createElement('text', 'producer_price');
        $producer_price->addValidator('Float', true)
                   ->addValidator('GreaterThan', true, array('min' => 0, 'messages' => 'Price must be higher than 0'))
                   ->setRequired(true)
                 ->setValue($product->suplier_price);
        
        $discount = $form->createElement('text', 'discount');
//        $discount->addValidator('Int', true)
				$discount->addValidator('Float', true)
                   ->addValidator('GreaterThan', true, array('min' => 0, 'messages' => 'Discount must be higher than 0'))
                   ->addValidator('Between', true, array('min' => 1, 'max' => 99))
                   ->setRequired(true)
                 ->setValue($product->discount);
        
        $stock = $form->createElement('text', 'stock');
        $stock->addValidator('Int', true)
                   ->addValidator('GreaterThan', true, array('min' => 0, 'messages' => 'Stock must be higher than 0'))
                   ->setRequired(true)
                 ->setValue($product->stock);
        
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
        
        $form->addElement($name)
                ->addElement($tags)
                ->addElement($description)
                ->addElement($terms)
                ->addElement($short_description)
                ->addElement($producer_price)
                ->addElement($stock)
                ->addElement($discount)
//                ->addElement($category)
//                ->addElement($subcategory)
                ->addElement($start_time)
                ->addElement($end_time);
        
        if( $this->request->getPost() ) {
            if ($form->isValid($this->request->getPost())) {
                
                $product->name = $form->getValue('name');
                $product->short_description = $form->getValue('short_description');
                $product->description = $form->getValue('description');
                $product->terms = $form->getValue('terms');
                $product->suplier_price = $form->getValue('producer_price');
                $product->discount = $form->getValue('discount');
                $product->stock = $form->getValue('stock');
                $product->starttime = $form->getValue('start_time');
                $product->endtime = $form->getValue('end_time');
                $product->user_id = $this->user->getUser()->get('id');
//                $product->category_id = $form->getValue('subcategory');
                
                $product->money_save = ($form->getValue('producer_price')*$form->getValue('discount')/100);
                $product->price = $form->getValue('producer_price') - ($form->getValue('producer_price')*$form->getValue('discount')/100);
                
                $product->save();
                
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
                        'success' => (isset($success) ? $success : false)
                    ),
                'imgajax' => $is_ajax,
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
                    ->addWhere('p.user_id = ?', $this->user->getUser()->get('id'))
                    ->fetchOne();
        if(!$product->id) {
            $this->forbiddenAction('You dont have acces to this product');
        }
        
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
        
        $this->setTemplate('myaccount/products/gallery.twig');
        
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
                                    'width' => 610,
                                    'height' => 290,
                                    'dir' => '/uploads/products/images/thumb610x290'
                                ),
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
                    ->addWhere('p.user_id = ?', $this->user->getUser()->get('id'))
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
        $this->setTemplate('myaccount/products/crop.twig');
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
                                    'width' => 610,
                                    'height' => 290,
                                    'dir' => '/uploads/products/images/thumb610x290'
                                ),
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
    
    public function getSubcategoryAction()
    {
        $id = $this->getParam('id');
        
        $treeObject = Doctrine_Core::getTable('Category')->find($id);
        $tree = array();
        if($treeObject) {
            $tree = $treeObject->getNode()->getChildren()->toArray();
        }
        $this->setTemplate('myaccount/products/subcategories.twig');
        
        return array(
                'subcategories' => $tree
            );
    }
    
    public function getMerchantDealsAction() {
        $this->setTemplate('myaccount/products/getmerchantdeals.twig');
        $id = $this->getParam('id');
        $page = $this->getParam('page');
        $user_id = $this->user->getUser()->id;
        $pagerLayout = new PagerLayoutWithArrows(
                new Doctrine_Pager(
                    Doctrine_Query::create()
                        ->select('p.*, pm.*, pp.*')
                        ->from('Product p')
                        ->leftJoin('p.ProductMedia pm WITH pm.main = 1')
                        ->leftJoin('p.ProductPrice pp')
                        ->leftJoin('p.User u')
                        ->addSelect('u.username')
                        ->where('p.user_id = ?', $this->user->getUser()->get('id'))
                        ->where('p.merchant_user_id = ?', $user_id)
                        ->andWhere('p.status = 2')
                        ,
                    $page, 25),
                      new Doctrine_Pager_Range_Sliding(array(
                            'chunk' => 5
                      )),
                '/my-account/my-offers?page={%page_number}'
            );
        $pagerLayout->setTemplate('<li><a href="{%url}">{%page}</a></li>');
        $pagerLayout->setSelectedTemplate('<li class="selected">{%page}</li>');
        // Fetching users
        $products = $pagerLayout->execute(array(), Doctrine::HYDRATE_ARRAY);
        return array('products'=>$products, 'pagination' => $pagerLayout->display(array(), true),);
          
    }
    
//    public function confirmDealAction() {
//        $this->setTemplate('myaccount/products/confirmdeal.twig');
//        $id = $this->getParam('id');
//        $confirm = Doctrine_Query::create()
//                ->select('p.status')
//                ->from('Product p')
//                ->where('p.id = ?', $id)
//                ->execute(array(), Doctrine::HYDRATE_ARRAY);
//        if($confirm[0]['status'] == 0) {
//            return array('message' => 'The deal is already confirmed.');
//        }
//        $rows = Doctrine_Query::create()
//                ->update('Product')
//                ->where('id = ?', $id)
//                ->set('status', '0')
//                ->execute();
//        if($rows == 1) {
//            $this->redirect('/my-account/get-my-deals');
//        } else {
//            return array('message'=>'Couldn\'t update the deal with the id '.$id);
//        }
//    }
}
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

class defaultController extends Cms_Controller
{
    /*
     * 
     */

    public function init() {
        
    }
    
    public function indexAction()
    {
	    //template name locatio in "app/site/templates"
        $this->setTemplate('index.twig');
        
        $product = Doctrine_Core::getTable('Product')->getLastProduct()->fetchOne(array(), Doctrine::HYDRATE_ARRAY);

				$products = Doctrine_Core::getTable('Product')->getOtherProducts()->execute(array(), Doctrine::HYDRATE_ARRAY);
				
				$indexProducts = Doctrine_Core::getTable('Product')->getIndexProducts()->execute(array(), Doctrine::HYDRATE_ARRAY);
        require_once(ROOT_PATH . '/lib/bbcode/parser.php');
        $this->twig->addGlobal('bbcode', new Parser());
        
        $charity = Doctrine_Query::create()
                            ->select('c.id, c.name, c.short_description, c.sold, c.starttime, c.status, p.endtime, c.amount, c.is_first, c.slug, cm.*')
                            ->from('Charity c')
                            ->addWhere('c.is_first = 1')
                            ->addWhere('c.starttime <= ?', date('Y-m-d H:i:s'))
                            ->addWhere('c.endtime >= ?', date('Y-m-d H:i:s'))
                            ->leftJoin('c.CharityMedia cm WITH cm.main = 1')
                            ->fetchOne();
        
				//gold
				$children = array();
				$users = Doctrine_Query::create()
								->select('id, parent_id')
								->from('User u')
								->addWhere('created_at > ADDDATE(CURDATE(), INTERVAL -120 DAY)')
								->addWhere('parent_id != 0')
								->fetchArray();
				foreach ($users as $user) {
					$children[$user['parent_id']][] = $user['id'];
				}
				foreach ($children as $child_id => $child) {
					$add = false;
					if (count($child) >= 1) {
						$add = true;
						foreach ($child as $c) {
							if (count($children[$c]) < 1) {
								$add = false;
								break;
							}
						}
					}
					if ($add) {
						$gold[] = $child_id;
					}
				}
				$goldusers = array();
				if (count($gold) > 0) {
					$goldusers = Doctrine_Query::create()
								->select('username')
								->from('User')
								->whereIn('id', $gold)
								->fetchArray();
				}
				
				//silver
				$children = array();
				$users = Doctrine_Query::create()
								->select('id, parent_id,')
								->from('User u')
								->addWhere('created_at > ADDDATE(CURDATE(), INTERVAL -150 DAY)')
								->addWhere('parent_id != 0')
								->fetchArray();
				
				foreach ($users as $user) {
					$children[$user['parent_id']][] = $user['id'];
				}
				foreach ($children as $child_id => $child) {
					$add = false;
					if (count($child) >= 1) {
						$add = true;
						foreach ($child as $c) {
							if (count($children[$c]) < 1) {
								$add = false;
								break;
							}
						}
					}
					if (count($gold) > 0) {
						if (in_array($child_id, $gold)) {
							$add = false;
						}
					}
					if ($add) {
						$silver[] = $child_id;
					}
				}
				$silverusers = array();
				if (count($silver) > 0) {
					$silverusers = Doctrine_Query::create()
									->select('username')
									->from('User')
									->whereIn('id', $silver)
									->fetchArray();
				}
				//bronze
				$children = array();
				$users = Doctrine_Query::create()
								->select('id, parent_id,')
								->from('User u')
								->addWhere('created_at > ADDDATE(CURDATE(), INTERVAL -210 DAY)')
								->addWhere('parent_id != 0')
								->fetchArray();
				foreach ($users as $user) {
					$children[$user['parent_id']][] = $user['id'];
				}
				foreach ($children as $child_id => $child) {
					$add = false;
					if (count($child) >= 1) {
						$add = true;
						foreach ($child as $c) {
							if (count($children[$c]) < 1) {
								$add = false;
								break;
							}
						}
					}
					if (count($gold) > 0) {
						if (in_array($child_id, $gold)) {
							$add = false;
						}
					}
					if (count($silver) > 0) {
						if (in_array($child_id, $silver)) {
							$add = false;
						}
					}
					if ($add) {
						$bronze[] = $child_id;
					}
				}
				$bronzeusers = array();
				if (count($bronze) > 0) {
					$bronzeusers = Doctrine_Query::create()
									->select('username')
									->from('User')
									->whereIn('id', $bronze)
									->fetchArray();
				}
				
        return array('product' => $product, 'other' => $products, 'index_products' => $indexProducts, 'charity' => $charity, 'goldusers' => $goldusers, 'silverusers' => $silverusers, 'bronzeusers' => $bronzeusers);
    }
    
    public function productpageAction()
    {
        $this->setTemplate('product.twig');
        $userSlug = $this->getParam('user_slug');
        $productSlug = $this->getParam('product_slug');
        $tab = $this->getParam('tab');
        $page = $this->getParam('page');
        
        /*
         * Get product
         */
        $product = Doctrine_Query::create()
                ->select('p.*, pp.*, pa.*, pm.*, u.*, pt.*, t.*')
                ->from('Product p')
                ->leftJoin('p.ProductAddress pa')
                ->leftJoin('p.ProductMedia pm')
                ->leftJoin('p.ProductPrice pp')
                ->leftJoin('p.User u')
                ->leftJoin('p.ProductTags pt')
                ->addWhere('p.slug = ?', $productSlug)
                ->addWhere('u.username = ?', $userSlug)
                ->addOrderBy('pm.main DESC, pp.price ASC')
								->fetchOne(array(), Doctrine::HYDRATE_ARRAY);
				if (
								$product['status'] == 1 || 
								$product['user_id'] == $this->user->getUser()->id || 
								$product['merchant_user_id'] == $this->user->getUser()->id
								) {
				} else {
					$this->redirect('/');
				}
				
				if ($this->request->getPost()) {
					$post = $this->request->getPost();
					if ($post['confirm_product'] == 1) {
						$product2 = Doctrine_Query::create()
                    ->from('Product p')
                    ->addWhere('p.id = ?', $product['id'])
                    ->fetchOne();
						$product2->status = '0';
						$product2->save();
						$this->redirect('/' . $userSlug . '/' . $productSlug . '.html');
					}
				}
        $questions = '';
        $pg = '';
        /*if($tab == 'questions') {
            $query = Doctrine::getTable('Question')
                    ->createQuery()
                    ->from('Question q')
                    ->leftJoin('q.User uq')
                    ->leftJoin('q.Answer a')
                    ->leftJoin('a.User ua')
                    ->addWhere('q.product_id = ?', $product['id'])
                    ->orderBy('q.id DESC')
                    ->orderBy('a.id DESC');
            
            $pagerLayout = new PagerLayoutWithArrows(
                new Doctrine_Pager(
                    $query,
                    $page, 25),
                      new Doctrine_Pager_Range_Sliding(array(
                            'chunk' => 5
                      )),
                '/'.$userSlug.'/'.$productSlug.'.html?tab=questions&page={%page_number}'.$l
            );
            $pagerLayout->setTemplate('<li><a href="{%url}">{%page}</a></li>');
            $pagerLayout->setSelectedTemplate('<li class="selected">{%page}</li>');

            // Fetching users
            $questions = $pagerLayout->execute(array(), Doctrine::HYDRATE_ARRAY);
            $pg = $pagerLayout->display(array(), true);
        }*/
        if($tab == 'add') {
            $form = new Zend_Form();
            $q = $form->createElement('textarea', 'question');
            $q->addValidator('stringLength', false, array(10, 550))
                ->setRequired(true);
            $form->addElement($q);
            
            if( $this->request->getPost() ) {
                if ($form->isValid($this->request->getPost())) {
                    if($this->user->hasRole('user')) {
                        $qu = $form->getValue('question');
                        $qt = new Question();
                        $qt->user_id = $this->user->getUser()->get('id');
                        $qt->product_id = $product['id'];
                        $qt->question = $qu;
                        $qt->save();
                        $form->reset();
                        $success = true;
                   }
                }
            }
            
            $this->setTemplate('productAddQ.twig');
            
            return array(
                'product' => $product,
                'form' => array(
                        'values' => $form->getValues(),
                        'errors' => $form->getMessages(),
                        'success' => (isset($success) ? $success : false)
                    )
                );
        }
        
        $_tags = array();
        foreach($product['ProductTags'] AS $tag) {
            $_tags[] = $tag['tag_id'];
        }
        
        $op = $this->getParam('options');
        if($op == 'true') {
            $options = ProductPriceTable::getInstance()->getProductPrices(array('product_id' => $product['id']))->execute(array(), Doctrine::HYDRATE_ARRAY);

						$this->setTemplate('productOptions.twig');
            $friend = $this->getParam('friend');
            return array('options' => $options, 'friend' => $friend);
        }
        
        require_once(ROOT_PATH . '/lib/bbcode/parser.php');
        $this->twig->addGlobal('bbcode', new Parser());
        
        $similar = ProductTable::getInstance()
                    ->getProductsByTags(
                                array(
                                    'tags' => $_tags,
                                    'exclude' => array($product['id'])
                                    ))->execute(array(), Doctrine::HYDRATE_ARRAY);
        
        //echo '<pre>';
        //print_r($product);
        return array('product' => $product, 'other' => $similar, 'tab' => $tab, 'questions' => $questions, 'pagination' => $pg);
    }
//    
//    public function confirmProductAction() {
//        $this->setTemplate('/myaccount/products/confirmproduct.twig');
//        $id = $this->getParam('id');
//        $confirmed_id = Doctrine_Query::create()
//                ->select('p.stat')
//                ->from('Product p')
//                ->where('p.id = ?', $id)
//                ->execute(array(), Doctrine::HYDRATE_ARRAY);
//        //if($confirmed_id[0]->is_active == 1) 
//    }
    
		public function searchAction() {
			$this->setTemplate('search.twig');
			
			$term = $this->getParam('term');
			
			$products = ProductTable::getInstance()
										->getSearchProducts(
												array('term' => $term)
												)->execute(array(), Doctrine::HYDRATE_ARRAY);
			
			$product = Doctrine_Core::getTable('Product')->getOtherProducts()->execute(array(), Doctrine::HYDRATE_ARRAY);
			
			$tags = TagTable::getInstance()->getTags()->execute(array(), Doctrine::HYDRATE_ARRAY);
			
			return array('products' => $products, 'other' => $product, 'term' => $term, 'tags' => $tags);
		}
		
		public function tagAction() {
			$this->setTemplate('tag.twig');
			
			$term = $this->getParam('term');
			
			$products = ProductTable::getInstance()
							->getProductsByTag(
											array('term' => $term)
											)->execute(array(), Doctrine::HYDRATE_ARRAY);
			
			$product = Doctrine_Core::getTable('Product')->getOtherProducts()->execute(array(), Doctrine::HYDRATE_ARRAY);
			
			$tags = TagTable::getInstance()->getTags()->execute(array(), Doctrine::HYDRATE_ARRAY);
			
			return array('products' => $products, 'other' => $product, 'term' => $term, 'tags' => $tags);
		}
		
    public function alldealsAction()
    {
        $this->setTemplate('alldeals.twig');
        
        $products = ProductTable::getInstance()->getActiveProducts()->execute(array(), Doctrine::HYDRATE_ARRAY);
        
//        $product = Doctrine_Core::getTable('Product')->getRandomProduct()->execute(array(), Doctrine::HYDRATE_ARRAY);
				$product = Doctrine_Core::getTable('Product')->getOtherProducts()->execute(array(), Doctrine::HYDRATE_ARRAY);
        
				$tags = TagTable::getInstance()->getTags()->execute(array(), Doctrine::HYDRATE_ARRAY);
				
        return array('products' => $products, 'other' => $product, 'tags' => $tags);
    }
    
    public function recentdealsAction()
    {
        $this->setTemplate('recentdeals.twig');
        
        $products = ProductTable::getInstance()->getActiveProducts()->execute(array(), Doctrine::HYDRATE_ARRAY);

//        $product = Doctrine_Core::getTable('Product')->getRandomProduct()->execute(array(), Doctrine::HYDRATE_ARRAY);
				$product = Doctrine_Core::getTable('Product')->getOtherProducts()->execute(array(), Doctrine::HYDRATE_ARRAY);
        
        return array('products' => $products, 'other' => $product);
    }
    
    public function requestMembershipAction()
    {
        if($this->user->hasRole('user')) {
            $this->redirect('/my-account');
        }
        $this->setTemplate('requestmembership.twig');
        
        $ref_id = $this->getParam('referral_id');
        
        $form = new Zend_Form();
        $username = $form->createElement('text', 'reg_username');
        $username->addPrefixPath('Validate', ROOT_PATH . '/validators', 'validate');
        $username->addValidator('chkUsername', false, array())
                ->addFilter('StringToLower');
                
        $username->setRequired(true)
                 ->addFilter('StringToLower');
        $password = $form->createElement('password', 'reg_password');
        $password->addValidator('StringLength', false, array(6))
                 ->setRequired(true);
        $form->addElement($username)
            ->addElement($password);
        
        $referral = $form->createElement('text', 'referral');
        $referral->setValue($ref_id)
                ->setRequired(true);
        
        $first_name = $form->createElement('text', 'first_name');
        $first_name->addValidator('stringLength', false, array(2, 50))
                 ->setRequired(true);
        $last_name = $form->createElement('text', 'last_name');
        $last_name->addValidator('stringLength', false, array(2, 50))
                 ->setRequired(true);

//        $phone = $form->createElement('text', 'phone');
//        $phone->addValidator('stringLength', false, array(2, 50))
//                 ->setRequired(true);

        $email = $form->createElement('text', 'email');
        $email->addPrefixPath('Validate', ROOT_PATH . '/validators', 'validate');
        $email->addValidator('emailAddress', false)
                ->addValidator('dbEmail', true, array('exclude_id' => 0))
                 ->setRequired(true)
                 ->addFilter('StringToLower');
        
//        $address = $form->createElement('text', 'address');
//        $address->setRequired(true);
//
//        $city = $form->createElement('text', 'city');
//        $city->setRequired(true);

//        $county = $form->createElement('text', 'county');
//        $county->setRequired(true);

        //$postcode = $form->createElement('text', 'postcode');
        //$postcode->setRequired(true);

        $countries = CountryTable::getInstance()->getCountries()->execute(array(), DOCTRINE::HYDRATE_ARRAY);

        $country = $form->createElement('select', 'country');
        $country->setRequired(true);
        foreach($countries AS $c){
            $country->addMultiOption($c['id'], $c['name']);
        }
        $country->addValidator('InArray', false, array(array_keys($country->getMultiOptions()), 'messages' =>'This country it is not in the original select values'));
        $country->setValue(198);

        $form
								->addElement($first_name)
                ->addElement($last_name)
//                ->addElement($phone)
                ->addElement($email)
//                ->addElement($address)
//							->addElement($city)
//                ->addElement($county)
//                ->addElement($postcode)
                ->addElement($country)
                ->addElement($referral);
				$terms = $form->createElement('checkbox', 'terms')
								->setRequired(true)
								->addValidator('InArray', false, array(array('1'), 'messages' => 'You must agree TERMS AND CONDITIONS'));
				$form->addElement($terms);
        $sendEmail = 0;
        if( $this->request->getPost() ) {
            if ($form->isValid($this->request->getPost())) {
                $user = new User();
                $user->username = $form->getValue('reg_username');
                $user->password = $form->getValue('reg_password');
                
                $user->first_name = $form->getValue('first_name');
                $user->last_name = $form->getValue('last_name');
//                $user->phone = $form->getValue('phone');
                $user->email = $form->getValue('email');
                
//                $user->UserAddress->address = $form->getValue('address');
//                $user->UserAddress->city = $form->getValue('city');
//                $user->UserAddress->county = $form->getValue('county');
//                $user->UserAddress->postcode = $form->getValue('postcode');
                $user->UserAddress->country_id = $form->getValue('country');
                
                $r = $form->getValue('referral');
                $parent = UserTable::getInstance()->getParentByRef(array('ref_id' => $r))->fetchOne(array(), Doctrine::HYDRATE_ARRAY);
                if(!$parent['id']) {
                    $form->addErrorMessage('No user found whit that referral id.');
                    //$form->getElement('referral')->addErrorMessage('No user found whit that referral id.');
                    $form->getElement('referral')->addError('No user found whit this referral id.');
                } else {
                    /*if(empty($r)) {
                        $parent = UserTable::getInstance()->getRandomParent()->fetchOne(array(), Doctrine::HYDRATE_ARRAY);
                        if($parent['id']) {
                            $user->parent_id = $parent['id'];
                        }
                    } else {
                        $parent = UserTable::getInstance()->getParentByRef(array('ref_id' => $r))->fetchOne(array(), Doctrine::HYDRATE_ARRAY);
                        if($parent['id']) {
                            $user->parent_id = $parent['id'];
                        } else {
                            $parent = UserTable::getInstance()->getRandomParent()->fetchOne(array(), Doctrine::HYDRATE_ARRAY);
                            if($parent['id']) {
                                $user->parent_id = $parent['id'];
                            }
                        }
                    }*/
                    $user->parent_id = $parent['id'];
                    
                    $conn = Doctrine_manager::getInstance()->getCurrentConnection();
                    $conn->beginTransaction();
                    $user->save();
                    if($user->ref_id) {
                        $role_user = RoleTable::getInstance()->findOneByName('USER');
                        $userRole = new UserRole();
                        $userRole->user_id = $user->id;
                        $userRole->role_id = $role_user->id;
                        try {
                            $userRole->save();
                            $conn->commit();
                            $success = true;
                            $form->clearElements();
                            $form->addElement($country);
                            $sendEmail = 1;
                        }catch(Doctrine_Exception $e) {
                            $conn->rollback();
                        }
                    } else {
                        $form->addErrorMessage('There was a global error, please try again.');
                        $conn->rollback();
                    }
                }
            }
        }
        if($sendEmail) {
            $msg = 'Hi '.$user->first_name.' '.$user->last_name.',<br><br>
                    Thank you for registering, to activate your account please click on the link bellow:<br><br>
                    <a href="https://www.winmaweb.com/user/activate/'.$user->ref_id.'">https://www.winmaweb.com/user/activate/'.$user->ref_id.'</a><br><br>
                    Thank you';
                    
            require_once 'Swift/swift_required.php';
            $transport = Swift_SendmailTransport::newInstance('/usr/sbin/sendmail -bs');
            $mailer = Swift_Mailer::newInstance($transport);
            //Create a message
            $message = Swift_Message::newInstance('User activation')
              ->setFrom(array('office@winmaweb.com' => 'winmaweb'))
              ->setBody($msg, 'text/html');
            $message->setTo(array($user->email));
            $mailer->send($message);
        }
        
//				$product = Doctrine_Core::getTable('Product')->getRandomProduct()->fetchOne(array(), Doctrine::HYDRATE_ARRAY);
				$product = Doctrine_Core::getTable('Product')->getLastProduct()->fetchOne(array(), Doctrine::HYDRATE_ARRAY);

				$products = Doctrine_Core::getTable('Product')->getOtherProducts()->execute(array(), Doctrine::HYDRATE_ARRAY);
				
				$indexProducts = Doctrine_Core::getTable('Product')->getIndexProducts()->execute(array(), Doctrine::HYDRATE_ARRAY);
        require_once(ROOT_PATH . '/lib/bbcode/parser.php');
        $this->twig->addGlobal('bbcode', new Parser());
        				
				$step = 0;
//				echo '<pre>';
//				print_r($form->getMessages());
//				echo '</pre>';
				$errors = $form->getMessages();
				if (isset($errors['email']) || isset($errors['referral'])) {
					$step = 1;
				}
        return array(
                'form' => array(
                        'values' => $form->getValues(),
                        'errors' => $form->getMessages(),
                        'globalErrors' => $form->getErrorMessages(),
                        'countries' => $form->country,
                        'success' => (isset($success) ? $success : false)
                    ),
                'refid' => $user->ref_id,
						'product' => $product, 'other' => $products, 'index_products' => $indexProducts, 'step' => $step
            );
    }
    
    public function userActivateAction()
    {
        if($this->user->hasRole('user')) {
            $this->redirect('/my-account');
        }
        $code = $this->getParam('code');
        if(empty($code))
        {
            return $this->notFoundAction();
        }
        $getUser = UserTable::getInstance()->activation(array('code' => $code))->select('u.id')->fetchOne(array());
        
        if(!$getUser->id) {
            return $this->notFoundAction();
        }
        
        $getUser->is_active = true;
        $getUser->activated_at = date('Y-m-d H:i:s', time());
        $getUser->save();
        
        $userSession = new Zend_Session_Namespace('userSession');
        $userSession->userId = $getUser->id;
        $this->redirect('/my-account');
        
        return array();
    }
    
    public function loginAction()
    {
        if($this->user->hasRole('user')) {
            $this->redirect('/my-account');
        }
        $this->setTemplate('login.twig');
        
        $form = new Zend_Form();
        
        $username = $form->createElement('text', 'login_username');
        
        $username->setRequired(true)
                 ->addFilter('StringToLower');
        $password = $form->createElement('password', 'login_password');
        $password->addValidator('StringLength', false, array(6))
                 ->setRequired(true);
        $form->addElement($username)
            ->addElement($password);
        
        if( $this->request->getPost() ) {
            if ($form->isValid($this->request->getPost())) {
                $dbUser = UserTable::getInstance()->getLoginUser(
                                                array(
                                                    'username' => $form->getValue('login_username'),
                                                    'password' => md5($form->getValue('login_password'))
                                                    )
                                                )->fetchOne(array());
                
                if($dbUser->id) {
                    if($dbUser->is_active)
                    {
                        if(!$dbUser->is_banned){
                            $uid = $dbUser->id;
                            $dbUser->last_login = date('Y-m-d H:i:s', time());
                            $dbUser->save();

                            $userSession = new Zend_Session_Namespace('userSession');
                            $userSession->userId = $uid;

                            $this->redirect('/my-account');
                        } else {
                            $username->addError('Your username is banned.');
                        }
                    } else {
                        $username->addError('Your username is not activated, please check your email for the activation code.');
                    }
                } else {
                    $password->addError('The Username or Password you entered was incorrect.');
                }
                
                $success = false;
            }
        }
        
        return array(
                'form' => array(
                        'values' => $form->getValues(),
                        'errors' => $form->getMessages(),
                        'success' => (isset($success) ? $success : false)
                    )
            );
    }
    
    public function logoutAction()
    {
        $this->user->destroy();
        $this->redirect('/');
    }
    
    public function getTagsAction()
    {
        $term = $this->getParam('term');
        
        $result = TagTable::getInstance()
                    ->getTagByName(array('term' => $term))
                    ->limit(10)
                    ->execute(array(), Doctrine::HYDRATE_ARRAY);
        
        echo json_encode($result);
        die();
    }
		
		public function profileAction() {
			$username = $this->getParam('slug');
			
			$this->setTemplate('profile.twig');
			
			$logged = true;
			$returnArray = array();
			if (!$this->user->isAuthenticated()) {
				$logged = false;
				$returnArray['other'] = Doctrine_Core::getTable('Product')->getOtherProducts()->execute(array(), Doctrine::HYDRATE_ARRAY);
				$returnArray['tags'] = TagTable::getInstance()->getTags()->execute(array(), Doctrine::HYDRATE_ARRAY);
			}
			$returnArray['logged'] = $logged;
			
			$returnArray['user'] = Doctrine_Query::create()
							->select('u.*')
							->from('User u')
							->addWhere('username = ?', $username)
							->fetchOne();
			$returnArray['user']['created_at'] = date("l, d F Y H:i", strtotime($returnArray['user']['created_at']));
			if ($returnArray['user']['last_login'] != '') {
				$last_login = strtotime(date("l, d F Y H:i", strtotime($returnArray['user']['last_login'])));
				$now = strtotime(date("d F Y H:i"));
				$diff = $now - $last_login;
				if ($diff/60 < 60) {
					$returnArray['user']['last_login'] = round($diff/60)." minutes ago";
				} elseif ($diff/(60*60) < 24) {
					$returnArray['user']['last_login'] = round($diff/(60*60))." hours ago";
				} elseif ($diff/(60*60*24) < 365) {
					$returnArray['user']['last_login'] = round($diff/(60*60*24))." days ago";
				} else {
					$returnArray['user']['last_login'] = round($diff/(60*60*24*365))." years ago";
				}
			}
			$returnArray['addr'] = Doctrine_Query::create()
							->select('ua.*')
							->from('UserAddress ua')
							->addWhere('user_id = ?', $returnArray['user']->id)
							->fetchOne();
			if($returnArray['user']['is_private'] == 1) {
				unset($returnArray['addr']);
			}
			$country = Doctrine_Query::create()
							->from('Country')
							->select('name')
							->addWhere('active=?', '1')
							->addWhere('id=?', $returnArray['addr']->country_id)
							->fetchOne(array(), DOCTRINE::HYDRATE_ARRAY);
			$returnArray['country'] = $country['name'];
			$returnArray['image'] = Doctrine_Query::create()
							->select('um.*')
							->from('UserMedia um')
							->addWhere('user_id = ?', $returnArray['user']->id)
							->fetchOne(array(), DOCTRINE::HYDRATE_ARRAY);
			$returnArray['group'] = UserTable::getInstance()->getUserGroup($returnArray['user']['id']);
            $address = str_replace(' ', '+', $returnArray['addr']['address']);
            $city = str_replace(' ', '+', $returnArray['addr']['city']);
            $url = "http://maps.googleapis.com/maps/api/geocode/xml?address=".$address.",+".$city."&sensor=false";
            $result = simplexml_load_file($url);

            if($result->status == "OK") {
                $lat = $result->result->geometry->location->lat;
                $lng = $result->result->geometry->location->lng;
            }
            $returnArray['lat'] = $lat;
            $returnArray['lng'] = $lng;
			return $returnArray;
		}
    
    public function pageAction()
    {
        $this->setTemplate('pages/show.twig');
        
        $slug = $this->getParam('slug');
        
        if(empty($slug)) {
            return $this->notFoundAction();
        }
        $page = Doctrine::getTable('Tree')->findOneBy('slug', $slug);
        if(!$page->id) {
            return $this->notFoundAction();
        }
        $query_tags = Doctrine_Query::create()
                    ->select('pt.tree_id, t.name AS tag')
                    ->from('PageTags pt')
                    ->leftJoin('pt.Tag t')
                    ->where('pt.tree_id = ?', $page->id)
                    ->execute(array(), Doctrine::HYDRATE_ARRAY);
        $_tag = array();
        if($query_tags) {
            
            foreach($query_tags AS $_tags) {
                $_tag[] = $_tags['tag'];
            }
        }
        
        require_once(ROOT_PATH . '/lib/bbcode/parser.php');
        $this->twig->addGlobal('bbcode', new Parser());
        
        $products = Doctrine_Core::getTable('Product')->getOtherProducts()->execute(array(), Doctrine::HYDRATE_ARRAY);
        
        return array(
            'name' => $page->name,
            'title' => $page->meta_title,
            'meta_desc' => $page->meta_content,
            'content'    => $page->content,
            'tags' => implode(',', $_tag),
            'other' => $products
        );
    }
    
    public function fpassAction()
    {
        if($this->user->hasRole('user')) {
            $this->redirect('/my-account');
        }
        $this->setTemplate('fpass.twig');
        
        $form = new Zend_Form();
        
        $email = $form->createElement('text', 'email');
        $email->addPrefixPath('Validate', ROOT_PATH . '/validators', 'validate');
        $email->addValidator('emailAddress', false)
                 ->setRequired(true)
                 ->addFilter('StringToLower');
        
        $form->addElement($email);
        $sendEmail = 0;
        if( $this->request->getPost() ) {
            if ($form->isValid($this->request->getPost())) {
                $em = $form->getValue('email');
                $u = UserTable::getInstance()->findOneBy('email', $em);
                if($u->id) {
                    if(!$u->is_banned) {
                        $code = md5($form->getValue('email').'-'.microtime());
                        $u->code = $code;
                        $u->pass_req_at = date('Y-m-d H:i:s', time());
                        $u->save();

                           $msg = 'Hi '.$u->first_name.' '.$u->last_name.',<br><br>
                            You just made a request to reset your password:<br><br>
                            Your username is:'.$u->username.'<br><br>
                            Please click on the link below to reset your password
                            <a href="https://www.winmaweb.com/ch-pass/'.$code.'">https://www.winmaweb.com/ch-pass/'.$code.'</a><br><br>
                            Thank you';

                            require_once 'Swift/swift_required.php';
                            $transport = Swift_SendmailTransport::newInstance('/usr/sbin/sendmail -bs');
                            $mailer = Swift_Mailer::newInstance($transport);
                            //Create a message
                            $message = Swift_Message::newInstance('User activation')
                              ->setFrom(array('office@winmaweb.com' => 'winmaweb'))
                              ->setBody($msg, 'text/html');
                            $message->setTo(array($u->email));
                            $mailer->send($message);
                            $success = true;
                            $form->reset();
                    } else {
                        $form->addErrorMessage('Your username is banned.');
                    }
                } else {
                    $form->addErrorMessage('No such email.');
                }
            }
        }
        
        return array(
                'form' => array(
                        'values' => $form->getValues(),
                        'errors' => $form->getMessages(),
                        'globalErrors' => $form->getErrorMessages(),
                        'success' => (isset($success) ? $success : false)
                    ),
            );
    }
    
    public function chpassAction()
    {
        if($this->user->hasRole('user')) {
            $this->redirect('/my-account');
        }
        $this->setTemplate('chpass.twig');
        $code = $this->getParam('code');
        if(empty($code))
        {
            return $this->notFoundAction();
        }
        $u = UserTable::getInstance()->findOneBy('code', $code);
        if(!$u->id) {
            return $this->notFoundAction();
        }
        
        $form = new Zend_Form();
        
        $password = $form->createElement('password', 'password');
        $password->addValidator('StringLength', false, array(6))
                 ->setRequired(true);
        $form->addElement($password);
        
        if( $this->request->getPost() ) {
            if ($form->isValid($this->request->getPost())) {
                $password = $form->getValue('password');
                $u->code = null;
                $u->is_active = 1;
                $u->password = $password;
                $u->save();
                $userSession = new Zend_Session_Namespace('userSession');
                $userSession->userId = $u->id;

                $this->redirect('/my-account');
            }
        }
        
        return array(
                'form' => array(
                        'values' => $form->getValues(),
                        'errors' => $form->getMessages(),
                        'globalErrors' => $form->getErrorMessages(),
                        'success' => (isset($success) ? $success : false)
                    ),
            'code' => $code
            );
    }
    
    public function charitypageAction()
    {
        $this->setTemplate('charity.twig');
        $charitySlug = $this->getParam('charity_slug');
        
        /*
         * Get charity
         */
        $charity = Doctrine_Query::create()
                            ->select('c.*, cm.*, ca.*')
                            ->from('Charity c')
                            ->leftJoin('c.CharityMedia cm')
                            ->leftJoin('c.CharityAddress ca')
                            ->addWhere('c.slug = ?', $charitySlug)
                            ->addWhere('c.starttime <= ?', date('Y-m-d H:i:s'))
                            ->addWhere('c.endtime >= ?', date('Y-m-d H:i:s'))
                            ->fetchOne();
        
        if(!$charity->id) {
            return $this->notFoundAction();
        }
        $donate = $this->getParam('donate');
        if($donate) {
            $this->setTemplate('charity_donate.twig');
            $form = new Zend_Form();
            $donation = $form->createElement('text', 'donation');
            $donation->addValidator('Float', true, array('locale' => 'en_US'))
                       ->addValidator('GreaterThan', true, array('min' => 0, 'messages' => 'Donation must be higher than 0'))
                       ->setRequired(true);
            
            $form->addElement($donation);
            
            if( $this->request->getPost() ) {
                if ($form->isValid($this->request->getPost())) {
                    $conn = Doctrine_manager::getInstance()->getCurrentConnection();
                    $conn->beginTransaction();

                    $type = TransactionTable::$type;
                    $status = TransactionTable::$status;
                    try {
                        if($this->user->getUser()->get('wallet') < $form->getValue('donation')) {
                            throw new Exception('You do not have anought money in your wallet');
                        }
                        $tran = new Transaction();
                        $tran->parent_id = 0;
                        $tran->transaction_type = $type['donation'];
                        $tran->status = $status['ok'];
                        $tran->sender_id = $this->user->getUser()->get('id');
    //                    $tran->receiver_id = $product['user_id'];
                        $tran->receiver_id = 2;

                        $tran->product_name = $charity->name;
                        $tran->quantity = 1;
                        $tran->full_payment = -$form->getValue('donation');
                        $tran->save();
                        
                        /*$res = $this->base_encode($tran->id, $alphabet);
                        for ($i = 0; $i < 10; $i++) {
                            $res .= $chars[mt_rand(0, strlen($chars)-1)];
                        }
                        $mt = explode(' ', microtime());
                        $res2 = $this->base_encode($mt[1], $alphabet);
                        for ($i = 0; $i < 10; $i++) {
                            $res2 .= $chars[mt_rand(0, strlen($chars)-1)];
                        }*/

                        $coupon = new Coupon();
                        $coupon->transaction_id = $tran->id;
                        $coupon->owner_id = $this->user->getUser()->get('id');
                        $coupon->name = $charity->name;
                        $coupon->quantity = 1;
                        $coupon->price = $form->getValue('donation');
                        //we create the unq code with microtime and main transaction id
                        //$coupon->code = $res;
                        //$coupon->code2 = $res2;
                        $coupon->status = CouponTable::$status['donation'];
                        $coupon->save();
                        
                        $query = 'UPDATE user SET wallet = wallet - :price WHERE id = :user_id';
                        $result = $conn->execute($query, array('user_id' => $this->user->getUser()->get('id'), 'price' => $form->getValue('donation')));
                        
                        $query = 'UPDATE user SET wallet = wallet + :price WHERE id = :user_id';
                        $result = $conn->execute($query, array('user_id' => 2, 'price' => $form->getValue('donation')));
                        
                        $query = 'UPDATE charity SET sold = sold + :qty, amount = amount + :amount WHERE id = :charity_id';
                        $result = $conn->execute($query, array('charity_id' => $charity->id, 'qty' => 1, 'amount' => $form->getValue('donation')));
                        
                        $success = true;
                        $conn->commit();
                    } catch (Exception $e) {
                        $form->addError($e->getMessage());
                        $conn->rollback();
                    }
                    
                }
            }
            
            return array('charity' => $charity, 
                'form' => array(
                        'values' => $form->getValues(),
                        'errors' => $form->getMessages(),
                        'success' => (isset($success) ? $success : false)
                    ),);
        }
        $charity = $charity->toArray();
        
        require_once(ROOT_PATH . '/lib/bbcode/parser.php');
        $this->twig->addGlobal('bbcode', new Parser());
        
        return array('charity' => $charity);
    }
    
    
    public function charitiesAction()
    {
        $this->setTemplate('allcharities.twig');
        
        $products = Doctrine_Query::create()
                            ->select('c.*, cm.*')
                            ->from('Charity c')
                            ->addWhere('c.starttime <= ?', date('Y-m-d H:i:s'))
                            ->addWhere('c.endtime >= ?', date('Y-m-d H:i:s'))
                            ->leftJoin('c.CharityMedia cm WITH cm.main = 1')
                            ->fetchArray();
				
        return array('products' => $products);
    }
    
    public function contactAction()
    {
        $this->setTemplate('pages/contact.twig');
        
        //$slug = $this->getParam('slug');
        
        if(empty($slug)) {
           //return $this->notFoundAction();
        }
        $page = Doctrine::getTable('Tree')->findOneBy('slug', 'contact-us');
        if(!$page->id) {
            return $this->notFoundAction();
        }
        $query_tags = Doctrine_Query::create()
                    ->select('pt.tree_id, t.name AS tag')
                    ->from('PageTags pt')
                    ->leftJoin('pt.Tag t')
                    ->where('pt.tree_id = ?', $page->id)
                    ->execute(array(), Doctrine::HYDRATE_ARRAY);
        $_tag = array();
        if($query_tags) {
            
            foreach($query_tags AS $_tags) {
                $_tag[] = $_tags['tag'];
            }
        }
        
        $form = new Zend_Form();
        /*$email = $form->createElement('text', 'email');
        $email->addValidator('emailAddress', false)
                 ->setRequired(true)
                 ->addFilter('StringToLower');*/
        
        $subject = $form->createElement('text', 'subject');
        $subject->setRequired(true);
        
        $code = $form->createElement('text', 'code');
        $code->setRequired(false);
        
        $msg = $form->createElement('textarea', 'msg');
        $msg->setRequired(true);
        
        $form->addElement($subject)
                ->addElement($code)
                ->addElement($msg);
        
        if( $this->request->getPost() ) {
            if ($form->isValid($this->request->getPost())) {
                $msg = 'Hi ,<br><br>
                    Contact form:<br><br>
                    Subject: '.$form->getValue('subject').'<br><br>
                    First Name: '.$this->user->getUser()->get('first_name').'<br><br>
                    Last Name: '.$this->user->getUser()->get('last_name').'<br><br>
                    Email: '.$this->user->getUser()->get('email').'<br><br>
                    Voucher Number: '.$form->getValue('code').'<br><br>
                    Message: '.nl2br($form->getValue('msg')).'<br><br>
                    ';

                    require_once 'Swift/swift_required.php';
                    $transport = Swift_SendmailTransport::newInstance('/usr/sbin/sendmail -bs');
                    $mailer = Swift_Mailer::newInstance($transport);
                    //Create a message
                    $message = Swift_Message::newInstance('Contact page')
                        ->setFrom(array('office@winmaweb.com' => 'winmaweb'))
                        ->setBody($msg, 'text/html');
                    $message->setTo(array('info@winmaweb.com'));
                    $mailer->send($message);
                $success = true;
                $form->reset();
            }
        }
        
        require_once(ROOT_PATH . '/lib/bbcode/parser.php');
        $this->twig->addGlobal('bbcode', new Parser());
        
        $products = Doctrine_Core::getTable('Product')->getOtherProducts()->execute(array(), Doctrine::HYDRATE_ARRAY);
        
        return array(
            'name' => $page->name,
            'title' => $page->meta_title,
            'meta_desc' => $page->meta_content,
            'content'    => $page->content,
            'tags' => implode(',', $_tag),
            'other' => $products,
            'form' => array(
                        'values' => $form->getValues(),
                        'errors' => $form->getMessages(),
                        'globalErrors' => $form->getErrorMessages(),
                        'success' => (isset($success) ? $success : false)
                    ),
        );
    }

	function requestFriendshipAction() {
		$this->setTemplate('myaccount/requestFriendship.twig');
		$id = $this->getParam('id');
		$user_id = $this->user->getUser()->id;
		
		if($id) {
			/*if(!$this->user->isAuthenticated()) {
				return array('message'=>'Please <a href="/login">login</a> or reguest a membership');
			}*/
			$query = Doctrine_Query::create()
				->select('u.username')
				->from('User u')
				->where('u.id = ?', $id)
				->execute();
			$username = $query[0]->username;
			$query1 = Doctrine_Query::create()
				->select('f.user_id, f.friends_id')
				->from('Friend f')
				->where('f.user_id = ?', $user_id)
				->addWhere('f.friends_id = ?', $id)
				->execute(array(), Doctrine::HYDRATE_ARRAY);
			/*
			 * If we have more than one friendship request to the same user return with the following message.
			 */
			if(count($query1) == 1) {
				return array('message'=>'You already sent a friendship request to this user.');
				echo 'Am iesit';
			}
			$friend = new Friend();
			$friend->user_id = $user_id;
			$friend->pending = 1;
			$friend->friends_id = $id;
			$friend->created_at = date('Y-m-d H:i:s');
			$friend->save();
			return array('message'=>'Your friend request to '.$username.' was submitted for approval.');
		} else {
			return array('message'=>'Your friend request to '.$username.' can\'t be submitted.');
		}
	}
    
    // use encodeURIComponent to pass the email to this method
    public function isUsedEmailAction() {
        $this->setTemplate('isusedemail.twig');
        $email = strtolower($this->getParam('email'));
        $query = Doctrine_Query::create()
                ->select('u.email')
                ->from('User u')
                ->where('email = ?', $email)
                ->execute(array(), Doctrine::HYDRATE_ARRAY);
        if(count($query) == 1) {
            return array('message'=>'The email address is already in use. Please choose a different address');
        } else {
            return array();
        }
    }
}
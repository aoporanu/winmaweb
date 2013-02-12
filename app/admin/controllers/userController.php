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

class userController extends Cms_Controller
{
    public function init()
    {
        if (!$this->user->hasRole('ADMIN')) {
            $this->redirect('/');
        }
    }
    
    public function showAction()
    {
        $this->setTemplate('user/show.twig');
        
        $page = $this->getParam('page');
        if($page < 1) {
            $page = 1;
        }
        
        $show = $this->getParam('show');
        $userTable = UserTable::getInstance();
        $ac = $this->getParam('ac');
        if($ac === 'ban') {
            $uid = $this->getParam('uid');
            $userB = $userTable->find($uid);
            if($userB->id && $userB->is_super_admin == 0) {
                if($userB->is_banned == 0) {
                    $userB->is_banned = 1;
                    
                } else {
                    $userB->is_banned = 0;
                }
                $userB->save();
            }
        }
        if($ac === 'do') {
            $uid = $this->getParam('uid');
            $userB = $userTable->find($uid);
            if($userB->id) {
                if($userB->is_do == 0) {
                    $userB->is_do = 1;
                    
                } else {
                    $userB->is_do = 0;
                }
                $userB->save();
            }
        }
				if ($ac === 'agent') {
					$uid = $this->getParam('uid');
					$userB = $userTable->find($uid);
					if ($userB->id) {
						$dbRoles = UserTable::getInstance()->getRoles(array('user_id' => $userB->id))->fetchArray();
						$userRoles = array();
						foreach($dbRoles as $role) {
							$userRoles[$role['id']] = strtolower($role['name']);
						}
						if (in_array('agent', $userRoles)) {//is agent
							$userB->agent_request_step = 0;
							$userB->save();
							$role_shop = RoleTable::getInstance()->findOneByName('AGENT');
							UserRoleTable::getInstance()->createQuery()->delete()->addWhere('user_id = ?', $userB->id)->addWhere('role_id = ?', $role_shop->id)->execute();
						} else {//become agent
							$userB->agent_request_step = 100;
							$userB->save();
							$role_shop = RoleTable::getInstance()->findOneByName('AGENT');
							$userRole = new UserRole();
							$userRole->user_id = $userB->id;
							$userRole->role_id = $role_shop->id;
							$userRole->save();
						}
					}
				}
				if ($ac === 'merchant') {
					$uid = $this->getParam('uid');
					$userB = $userTable->find($uid);
					if ($userB->id) {
						$dbRoles = UserTable::getInstance()->getRoles(array('user_id' => $userB->id))->fetchArray();
						$userRoles = array();
						foreach($dbRoles as $role) {
							$userRoles[$role['id']] = strtolower($role['name']);
						}
						if (in_array('shop', $userRoles)) {//is merchant
							$userB->request_step = 0;
							$userB->save();
							$role_shop = RoleTable::getInstance()->findOneByName('SHOP');
							UserRoleTable::getInstance()->createQuery()->delete()->addWhere('user_id = ?', $userB->id)->addWhere('role_id = ?', $role_shop->id)->execute();
						} else {//become merchant
							$userB->request_step = 100;
							$userB->save();
							$role_shop = RoleTable::getInstance()->findOneByName('SHOP');
							$userRole = new UserRole();
							$userRole->user_id = $userB->id;
							$userRole->role_id = $role_shop->id;
							$userRole->save();
						}
					}
				}
        
        switch($show)
        {
            case 'email_list':
                $fisier = ROOT_PATH . '/mda.csv';
                $date = $userTable->getUsers(array(), array('email', 'first_name', 'last_name'))
                        ->orderBy('id DESC')->execute(array(), Doctrine::HYDRATE_ARRAY);
                if($fp = fopen($fisier, 'w')) {
                    foreach($date as $valori) {
                        //fputcsv($fp, $valori['email'], ',', '"');
                        fputs($fp, $valori['email'].($valori['first_name'] != '' ? ",".$valori['first_name'] : '').($valori['last_name'] != '' ? " ".$valori['last_name'] : '')."\n");
                    }
                    
                    fclose($fp);
                }
                header("Content-type: application/octet-stream");
                header("Content-Disposition: attachment; filename=\"email_list.csv\"");

                // citire fisier in string si afisare
                echo file_get_contents($fisier);
                
                die;
            break;
        
            case 'normal':
                $query = $userTable->getUsersByRole(array('roleIn' => array('user', 'shop')));
            break;
        
            case 'merchant':
//                $query = $userTable->getUsersByRole(array('roleIn' => array('shop')));
							$query = $userTable->getUsersByRole(array('roleIn' => array('shop', 'agent')));
            break;
        
            case 'do':
                $query = $userTable->createQuery()->addWhere('is_do = ', 1);
            break;
        
            case 'admin':
                $query = $userTable->getUsersByRole(array('roleIn' => array('admin')));
            break;
        
            case 'notactivated':
                $query = $userTable->getUsersNotActivated();
            break;
        
            default:
                $query = $userTable->getUsers(array(), array('id', 'username', 'email', 'is_banned', 'is_do', 'agent_request_step'))->orderBy('created_at DESC');
            break;
        }
        $searchP = '';
        $search = $this->getParam('search');
        if($search === '1') {
            $sq = $this->getParam('squery');
            if(!empty($sq)) {
                $query = $userTable->getUsers(array(), array('id', 'username', 'email', 'is_banned','is_do'))
                        ->addWhere('username LIKE ?', '%'.$sq.'%')
                        ->orderBy('id DESC');
                $searchP = '&search=1&squery='.$sq;
            }
        }
        
        
        $pagerLayout = new PagerLayoutWithArrows(
                new Doctrine_Pager(
                    $query,
                    $page, 25),
                      new Doctrine_Pager_Range_Sliding(array(
                            'chunk' => 5
                      )),
                '/admin/users?page={%page_number}&show='.$show.$searchP
            );
        $pagerLayout->setTemplate('<li><a href="{%url}">{%page}</a></li>');
        $pagerLayout->setSelectedTemplate('<li class="selected">{%page}</li>');
        
        // Fetching users
        $users = $pagerLayout->execute(array(), Doctrine::HYDRATE_ARRAY);
        
        return array(
            'users' => $users,
            'pagination' => $pagerLayout->display(array(), true),
            'activeMenu' => $show,
            'sq' => $sq
        );
    }
    
    public function actionsAction()
    {
        $id = $this->getParam('id');
        if($id == 2) {
            return $this->forbiddenAction('You cannot access this user from here');
        }
        $user = UserTable::getInstance()->findOneById($id/*, Doctrine::HYDRATE_ARRAY*/);
        if(!$user) {
            return $this->notFoundAction();
        }
        
        $tab = $this->getParam('tab');
        switch($tab)
        {
            case 'edit':
                return $this->actionsTabEdit($user);
            break;
        
            case 'products':
                return $this->actionsTabProducts($user);
            break;
        
            case 'request':
                return $this->actionsTabRequest($user);
            break;
					
						case 'agent_request':
                return $this->actionsTabAgentRequest($user);
            break;
        
            case 'transactions':
                return $this->actionsTransactionsRequest($user);
            break;
        
            case 'statistics':
                return $this->actionsStatisticsRequest($user);
            break;
        
            case 'company':
                return $this->actionsCompanyRequest($user);
            break;
        }
        
        $ac = $this->getParam('ac');
        switch($ac)
        {
            case 'activate':
                $user->is_active = true;
                $user->activated_at = date('Y-m-d H:i:s', time());
                $user->save();
            break;
        
            case 'app_req':
                $user->request_step = 3;
                $user->mrequest_approved_at = date('Y-m-d H:i:s', time());
                $user->save();
            break;
        
            case 'dapp_req':
                $user->request_step = 0;
                $user->mrequest_approved_at = date('Y-m-d H:i:s', time());
                $user->save();
            break;
        
            case 'cr_req':
                $user->request_step = 100;
                $user->UserRole->delete();
                $role_user = RoleTable::getInstance()->findOneByName('USER');
                $role_shop = RoleTable::getInstance()->findOneByName('SHOP');
                $userRole = new UserRole();
                $userRole->user_id = $user->id;
                $userRole->role_id = $role_user->id;
                $userRole->save();
                $userRole = new UserRole();
                $userRole->user_id = $user->id;
                $userRole->role_id = $role_shop->id;
                $userRole->save();
                $user->save();
            break;
					case 'a_req':
						$user->agent_request_step = 100;
						$user->UserRole->delete();
						$role_user = RoleTable::getInstance()->findOneByName('USER');
						$role_shop = RoleTable::getInstance()->findOneByName('AGENT');
						$userRole = new UserRole();
						$userRole->user_id = $user->id;
						$userRole->role_id = $role_user->id;
						$userRole->save();
						$userRole = new UserRole();
						$userRole->user_id = $user->id;
						$userRole->role_id = $role_shop->id;
						$userRole->save();
						$user->save();
						break;
					case 'aapp_req':
						$user->agent_request_step = 3;
						$user->arequest_approved_at = date('Y-m-d H:i:s', time());
						$user->save();
						break;
					case 'adapp_req':
						$user->agent_request_step = 0;
						$user->arequest_approved_at = date('Y-m-d H:i:s', time());
						break;
        }
        
        $this->setTemplate('user/actions.twig');
        
        $dbRoles = UserTable::getInstance()->getRoles(array('user_id' => $user->id))->fetchArray();
        $userRoles = array();
        foreach($dbRoles as $role) {
            $userRoles[$role['id']] = strtolower($role['name']);
        }
        
        $role = 'user';
        
        if(in_array('admin', $userRoles)) {
            $role = 'admin';
        }
        if(in_array('shop', $userRoles)) {
            $role = 'merchant';
        }
        $ref = null;
        if($user->parent_id > 0) {
            $ref = UserTable::getInstance()->findOneById($user->parent_id, Doctrine::HYDRATE_ARRAY);
        }
//        $contractPdf = '/uploads/contracts/contract_'.md5($user->id.'+ceva!').'.pdf';
        //$company = $user->Company->toArray();
        
//        return array('userId' => $user->id, 'user' => $user->toArray(), 'role' => $role, 'ref' => $ref, 'pdf' => $contractPdf);
				return array('userId' => $user->id, 'user' => $user->toArray(), 'role' => $role, 'ref' => $ref);
    }
    
    protected function actionsCompanyRequest($user)
    {
        $this->setTemplate('user/actionsCompany.twig');
        
        $addr = $user->Company[0]->CompanyAddress->toArray();
        $country = CountryTable::getInstance()->find($addr['country_id'], Doctrine::HYDRATE_ARRAY);
        
        $dbRoles = UserTable::getInstance()->getRoles(array('user_id' => $user->id))->fetchArray();
        $userRoles = array();
        foreach($dbRoles as $role) {
            $userRoles[$role['id']] = strtolower($role['name']);
        }
        
        $role = 'user';
        
        if(in_array('admin', $userRoles)) {
            $role = 'admin';
        }
        if(in_array('shop', $userRoles)) {
            $role = 'merchant';
        }
        //return array('role' => $role, 'userId' => $user->id, 'company' => $user->Company[0]->toArray(), 'addr' => $addr, 'country' => $country['name']);
        $is_ajax = $this->request->getParam('isajaxrequest');
        
        if(!$is_ajax) {
            $is_ajax = $this->request->isXmlHttpRequest();
        }

        $companyObj = Doctrine_Query::create()
                    ->select('c.*, ca.*')
                    ->from('Company c')
                    ->leftJoin('c.CompanyAddress ca')
                    ->addWhere('c.user_id = ?', $user->id)
                    ->addWhere('c.company_type = 1')
                    ->fetchOne(array());
        $company = $companyObj->toArray();
        
        $form = new Zend_Form();
        // Create and configure username element:
        $company_name = $form->createElement('text', 'company_name');
        $company_name->addValidator('stringLength', false, array(2, 50))
                 ->setRequired(true)->setValue($company['name']);
        $vat_number = $form->createElement('text', 'vat_number');
        $vat_number->addValidator('stringLength', false, array(2, 50))
                 ->setRequired(true)->setValue($company['vat']);
        
        $phone = $form->createElement('text', 'phone');
        $phone->addValidator('stringLength', false, array(2, 50))
                 ->setRequired(true)->setValue($company['phone']);
        
        /*
				$contract = new Zend_Form_Element_File('contract');
				$fileName = $contract->getFileName(null, false);
        $contract->addValidator('Extension', false, 'pdf')
                ->setRequired()
                ->setValueDisabled(true)
                ->addFilter('Rename',
                   array('target' => ROOT_PATH . '/uploads/contracts/contract_'. md5($user->id.'+ceva!') .'.pdf',
                         'overwrite' => true));
        */
        $form->addElement($company_name)
                ->addElement($vat_number)
//                ->addElement($contract)
                ->addElement($phone);
				 
 
        $address = $form->createElement('text', 'address');
        $address->setRequired(true)->setValue($company['CompanyAddress']['address']);

        $city = $form->createElement('text', 'city');
        $city->setRequired(true)->setValue($company['CompanyAddress']['city']);

        $county = $form->createElement('text', 'county');
        $county->setRequired(true)->setValue($company['CompanyAddress']['county']);

        $postcode = $form->createElement('text', 'postcode');
        $postcode->setRequired(true)->setValue($company['CompanyAddress']['postcode']);

        $g_lat = $form->createElement('hidden', 'g_lat');
        $g_lat->setValue(0)->setRequired(true)->setValue($company['CompanyAddress']['latitude']);
        $g_lng = $form->createElement('hidden', 'g_lng');
        $g_lng->setValue(0)->setRequired(true)->setValue($company['CompanyAddress']['longitude']);
        
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

        $form->addElement($address)
                ->addElement($city)
                ->addElement($county)
                ->addElement($postcode)
                ->addElement($country)
                 ->addElement($g_lat)
                 ->addElement($g_lng);
        
        if( $this->request->getPost() ) {
            if ($form->isValid($this->request->getPost())) {
//                if ($form->contract->receive()) {
//									if ($fileName == 'contract-'.$user->id.'.pdf') {
                    $user->company_name = $form->getValue('company_name');
                    $user->vat_number = $form->getValue('vat_number');
//                    $user->request_step = 2;
										$user->request_step = 3;
                    $user->mrequest_at = date('Y-m-d H:i:s', time());
                    $user->save();

                    $company = $companyObj;
                    $company->name = $form->getValue('company_name');
                    $company->vat = $form->getValue('vat_number');
                    $company->phone = $form->getValue('phone');
                    $company->user_id = $user->id;
                    $company->company_type = 1;
                            
                    $company->CompanyAddress->address = $form->getValue('address');
                    $company->CompanyAddress->city = $form->getValue('city');
                    $company->CompanyAddress->county = $form->getValue('county');
                    $company->CompanyAddress->postcode = $form->getValue('postcode');
                    $company->CompanyAddress->country_id = $form->getValue('country');
                    
                    $company->CompanyAddress->latitude = $form->getValue('g_lat');
                    $company->CompanyAddress->longitude = $form->getValue('g_lng');
                    $company->save();
//                    $this->setTemplate('myaccount/contract/step2.twig');
                    $success = true;
//									} else {
//										$contract->addError('Please upload the contract with the same name of the file you downloaded');
//									}
//                } else {
//                    $contract->addError('Something went wrong uploading the file, please try again!');
//                }
            }
        }
        
        return array(
            'form' => array(
                        'values' => $form->getValues(),
                        'errors' => $form->getMessages(),
                        'countries' => $form->country,
                        'success' => (isset($success) ? $success : false)
                    ),
//            'cFile' => $c_file,
            'activated' => 'on',
            'imgajax' => $is_ajax,
            'role' => $role, 'userId' => $user->id,
            );
    }
    
    protected function actionsTabEdit($user)
    {
        $this->setTemplate('user/actionsEdit.twig');
        
        $form = new Zend_Form();
        // Create and configure username element:
        $first_name = $form->createElement('text', 'first_name');
        $first_name->addValidator('stringLength', false, array(2, 50))
                 ->setRequired(true);
        $last_name = $form->createElement('text', 'last_name');
        $last_name->addValidator('stringLength', false, array(2, 50))
                 ->setRequired(true);

        $phone = $form->createElement('text', 'phone');
        $phone->addValidator('stringLength', false, array(2, 50))
                 ->setRequired(true);

        $email = $form->createElement('text', 'email');
        $email->addPrefixPath('Validate', ROOT_PATH . '/validators', 'validate');
        $email->addValidator('emailAddress', false)
                ->addValidator('dbEmail', true, array('exclude_id' => $user->id))
                 ->setRequired(true)
                 ->addFilter('StringToLower');
        
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
                        ->addOrderBy('name ASC')
                        ->execute(array(), DOCTRINE::HYDRATE_ARRAY);

        $country = $form->createElement('select', 'country');
        $country->setRequired(true);
        foreach($countries AS $c){
            $country->addMultiOption($c['id'], $c['name']);
        }
        $country->addValidator('InArray', false, array(array_keys($country->getMultiOptions()), 'messages' =>'This country it is not in the original select values'));
        $country->setValue(77);
        $beneficiary_name = $form->createElement('text', 'beneficiary_name')->setRequired();
        $bank_code = $form->createElement('text', 'bank_code')->setRequired();
        $bank_branch_code = $form->createElement('text', 'bank_branch_code')->setRequired();
        $bank_account_number = $form->createElement('text', 'bank_account_number')->setRequired();
        $bank_name = $form->createElement('select', 'bank_name');
        $bank_name->addMultiOption('OCBC', 'OCBC');
        $bank_name->addMultiOption('UOB', 'UOB');
        $bank_name->addMultiOption('DBS', 'DBS');
        $bank_name->addMultiOption('StandardChartered', 'StandardChartered');
        $bank_name->addMultiOption('CitiBank', 'CitiBank');
        $bank_name->addMultiOption('HSBC ', 'HSBC');
        $bank_name->setRequired();
        $bank_name->addValidator('InArray', false, array(array_keys($bank_name->getMultiOptions()), 'messages' =>'This option it is not in the original select values'));
        $bank_address = $form->createElement('text', 'bank_address')->setRequired();
        $form->addElement($first_name)
                ->addElement($last_name)
                ->addElement($phone)
                ->addElement($email)
                ->addElement($address)
                ->addElement($city)
                ->addElement($county)
                ->addElement($postcode)
                ->addElement($country)
                ->addElement($beneficiary_name)
                ->addElement($bank_code)
                ->addElement($bank_branch_code)
                ->addElement($bank_account_number)
                ->addElement($bank_name);
        $form->setDefaults($user->toArray());
        
        $addr = $user->UserAddress->toArray();
        
        $form->setDefaults($addr);
        $form->setDefault('country', $addr['country_id']);
        if( $this->request->getPost() ) {
            if ($form->isValid($this->request->getPost())) {
                $user->first_name = $form->getValue('first_name');
                $user->last_name = $form->getValue('last_name');
                $user->phone = $form->getValue('phone');
                $user->email = $form->getValue('email');
                $user->beneficiary_name = $form->getValue('beneficiary_name');
                $user->bank_code = $form->getValue('bank_code');
                $user->bank_branch_code = $form->getValue('bank_branch_code');
                $user->bank_account_number = $form->getValue('bank_account_number');
                $user->bank_name = $form->getValue('bank_name');
                
                $user->UserAddress->address = $form->getValue('address');
                $user->UserAddress->city = $form->getValue('city');
                $user->UserAddress->county = $form->getValue('county');
                $user->UserAddress->postcode = $form->getValue('postcode');
                $user->UserAddress->country_id = $form->getValue('country');
                
                $user->save();
                $success = true;
            }
        }
        
        $dbRoles = UserTable::getInstance()->getRoles(array('user_id' => $user->id))->fetchArray();
        $userRoles = array();
        foreach($dbRoles as $role) {
            $userRoles[$role['id']] = strtolower($role['name']);
        }
        
        $role = 'user';
        
        if(in_array('admin', $userRoles)) {
            $role = 'admin';
        }
        if(in_array('shop', $userRoles)) {
            $role = 'merchant';
        }
        return array('role' => $role, 
                'form' => array(
                        'values'    => $form->getValues(),
                        'errors'    => $form->getMessages(),
                        'countries' => $form->country,
                        'kkt'       => $form->bank_name,
                        'success'   => (isset($success) ? $success : false)
                    ),
                'userId' => $user->id,
                'user' => $user->toArray()
            );
    }
    
    protected function actionsTabProducts($user)
    {
        $this->setTemplate('user/actionsProducts.twig');
        
        $page = $this->getParam('page');
        if($page < 1) {
            $page = 1;
        }
        
        $action = $this->getParam('ac');
        switch($action)
        {
            case 'delete':
                $prod_id = $this->getParam('prod_id');
                $check_q = Doctrine_Query::create()
                            ->from('Product p')
                            ->addWhere('p.id = ?', $prod_id)
                            ->addWhere('p.user_id = ?', $user->id)
                            ->count();
                if(!$check_q) {
                    $this->notFoundAction('This product do not exist');
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
            
            case 'gallery':
                return $this->productGallery();
            break;
        
            case 'edit':
                return $this->productEdit();
            break;
        
            case 'add':
                return $this->productAdd();
            break;
        }
        
        $pagerLayout = new PagerLayoutWithArrows(
                new Doctrine_Pager(
                    Doctrine_Query::create()
                        ->select('p.id, p.name, p.short_description, p.suplier_price, p.discount, p.money_save, pm.*')
                        ->from('Product p')
                        ->leftJoin('p.ProductMedia pm WITH pm.main = 1')
                        ->orderBy('p.created_at DESC')
                        ->where('p.user_id = ?', $user->id)
                        ,
                    $page, 25),
                      new Doctrine_Pager_Range_Sliding(array(
                            'chunk' => 5
                      )),
                '/admin/users/actions/'.$user->id.'?tab=products&page={%page_number}'
            );
        $pagerLayout->setTemplate('<li><a href="{%url}">{%page}</a></li>');
        $pagerLayout->setSelectedTemplate('<li class="selected">{%page}</li>');
        
        // Fetching users
        $products = $pagerLayout->execute(array(), Doctrine::HYDRATE_ARRAY);
        
        return array(
            'products' => $products,
            'pagination' => $pagerLayout->display(array(), true),
            'userId' => $user->id,
            'page' => $page,
            'user' => $user->toArray()
        );
    }
    
    protected function productGallery()
    {
        $page = $this->getParam('page');
        if($page < 1) {
            $page = 1;
        }
        
        $is_ajax = $this->request->getParam('isajaxrequest');
        $prod_id = $this->getParam('prod_id');
        
        if(!$is_ajax) {
            $is_ajax = $this->request->isXmlHttpRequest();
        }
        
        if(!$is_ajax) {
            return $this->notFoundAction();
        }
        
        $user_id = $this->getParam('id');
        
        $product = Doctrine_Query::create()
                    ->select('p.id, p.name')
                    ->from('Product p')
                    ->addWhere('p.id = ?', $prod_id)
                    ->fetchOne();
        if(!$product->id) {
            $this->forbiddenAction('This product do not exist');
        }
        
        $action = $this->getParam('subac');
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
        }
        
        $this->setTemplate('user/product/gallery.twig');
        
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
                    ->addWhere('p.id = ?', $prod_id)
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
                'product' => $product,
                'userId' => $user_id,
                'page'  => $page
        );
    }
    
    protected function productEdit()
    {
        if(!$this->request->isXmlHttpRequest()) {
            return $this->notFoundAction();
        }
        $page = $this->getParam('page');
        if($page < 1) {
            $page = 1;
        }
        
        $user_id = $this->getParam('id');
        
        $prod_id = $this->getParam('prod_id');
        
        $product = Doctrine_Query::create()
                    ->from('Product p')
                    ->addWhere('p.id = ?', $prod_id)
                    ->fetchOne();
        if(!$product->id) {
            $this->forbiddenAction('This product do not exist');
        }
        
        $this->setTemplate('user/product/edit.twig');
        
        $form = new Zend_Form();

        $name = $form->createElement('text', 'name');
        $name->addPrefixPath('Validate', ROOT_PATH . '/validators', 'validate');
        $name->addValidator('pNameUnq', false, array('exclude_id' => $product->id, 'user_id' => $user_id))
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
        $discount->addValidator('Int', true)
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
        
        $treeObject = Doctrine_Core::getTable('Category')->find(1);
        $tree = $treeObject->getNode()->getChildren();
        $category = $form->createElement('select', 'category');
        $subcategory = $form->createElement('select', 'subcategory');

        $to_check = array();
        $category->setRequired();
        $subcategory->setRequired();
        $category->addMultiOption('', '');
        $subcategory->addMultiOption('', 'Please selected a category first');
        $p = 0;
        foreach ($tree as $node) {
            $category->addMultiOption($node['id'], $node['name']);
            $children = $node->getNode()->getChildren();
            foreach($children as $child) {
                $to_check[$child['id']] = '';
                $subc[$node['id']][$child['id']] = $child['name'];
                if($product->category_id == $child['id']) {
                    $par = $child->getNode()->getParent()->toArray();
                    $category->setValue($par['id']);
                    $p = $par['id'];
                    //$subcategory->setValue($child['id']);
                    //$subcategory->addMultiOption($child['id'], $child['name']);
                } else {
                    //$subcategory->addMultiOption($child['id'], $child['name']);
                }
                /*if($this->request->getParam('category') == $node['id']) {
                    $subcategory->addMultiOption($child['id'], $child['name']);
                } */
            }
        }
        
        $treeObject = Doctrine_Core::getTable('Category')->find($p);
        $tree = $treeObject->getNode()->getChildren();
        foreach($tree as $child) {
            $subcategory->setValue($product->category_id);
            $subcategory->addMultiOption($child['id'], $child['name']);
        }
        
        $category->addValidator('InArray', false, array(array_keys($category->getMultiOptions()), 'messages' =>'This category it is not in the original select values'));
        $subcategory->addValidator('InArray', false, array(array_keys($to_check), 'messages' =>'This subcategory it is not in the original select values'));
        
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
                ->addElement($category)
                ->addElement($subcategory)
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
                $product->user_id = $user_id;
                $product->category_id = $form->getValue('subcategory');
                
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
                        'categories' => $form->category,
                        'subcategories' => $form->subcategory,
                        'success' => (isset($success) ? $success : false)
                    ),
                'imgajax' => $is_ajax,
                'product_id' => $prod_id,
                'userId' => $user_id,
                'page'  => $page
            );
    }
    
    protected function productAdd()
    {
        $is_ajax = $this->request->getParam('isajaxrequest');
        
        if(!$is_ajax) {
            $is_ajax = $this->request->isXmlHttpRequest();
        }
        
        $user_id = $this->getParam('id');
        
        if(!$is_ajax) {
            return $this->notFoundAction();
        }
        
        $this->setTemplate('user/product/add.twig');
        
        $form = new Zend_Form();
        
        $name = $form->createElement('text', 'name');
        $name->addPrefixPath('Validate', ROOT_PATH . '/validators', 'validate');
        $name->addValidator('pNameUnq', false, array('exclude_id' => 0, 'user_id' => $user_id))
                ->addValidator('stringLength', false, array(2, 200))
                 ->setRequired(true);
                 //->addFilter('StringToLower');
        
        $short_description = $form->createElement('textarea', 'short_description');
        $short_description->addValidator('stringLength', false, array(2, 200))
                        ->setRequired(true);
        
        $description = $form->createElement('textarea', 'description');
        $description->setRequired(true);
        
        $terms = $form->createElement('textarea', 'terms');
        
        $producer_price = $form->createElement('text', 'producer_price');
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
                   ->setRequired(true);
        
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
        
        if( $this->request->getPost() ) {
            if ($form->isValid($this->request->getPost())) {
                $product = new Product();
                $product->name = $form->getValue('name');
                $product->short_description = $form->getValue('short_description');
                $product->description = $form->getValue('description');
                $product->terms = $form->getValue('terms');
                $product->suplier_price = $form->getValue('producer_price');
                $product->discount = $form->getValue('discount');
                $product->stock = $form->getValue('stock');
                $product->starttime = $form->getValue('start_time');
                $product->endtime = $form->getValue('end_time');
                $product->user_id = $user_id;
                $product->category_id = $form->getValue('subcategory');
                
                $product->money_save = ($form->getValue('producer_price')*$form->getValue('discount')/100);
                $product->price = $form->getValue('producer_price') - ($form->getValue('producer_price')*$form->getValue('discount')/100);
                
                $product->save();
                if($product->id) {
                    $collection = new Doctrine_Collection('ProductTags');
                    $tags = explode(',', $form->getValue('tags'));

                    foreach( $tags AS $tag) {
                        $t = new Tag();
                        $t->name = $tag;
                        $t->link('Products', array($product->id));
                        $collection->add($t);
                    }

                    $collection->save();
                    
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
                                    )
                            )

                        ));
                    }
                }
                $form->clearElements();
                $form->addElement($category)
                    ->addElement($subcategory);
                $success = true;
            }
                
        }
        
        return array(
                'form' => array(
                        'values' => $form->getValues(),
                        'errors' => $form->getMessages(),
                        'categories' => $form->category,
                        'subcategories' => $form->subcategory,
                        'success' => (isset($success) ? $success : false)
                    ),
                'imgajax' => $is_ajax,
                'userId' => $user_id,
            );
    }
    
    protected function actionsTabRequest($user)
    {
        $this->setTemplate('user/actionsRequest.twig');
        
        $ref = null;
        if($user->parent_id > 0) {
            $ref = UserTable::getInstance()->findOneById($user->parent_id, Doctrine::HYDRATE_ARRAY);
        }
        
        $contractPdf = '/uploads/contracts/contract_'.md5($user->id.'+ceva!').'.pdf';
        $dbRoles = UserTable::getInstance()->getRoles(array('user_id' => $user->id))->fetchArray();
        $userRoles = array();
        foreach($dbRoles as $role) {
            $userRoles[$role['id']] = strtolower($role['name']);
        }
        
        $role = 'user';
        
        if(in_array('admin', $userRoles)) {
            $role = 'admin';
        }
        if(in_array('shop', $userRoles)) {
            $role = 'merchant';
        }
        return array('role' => $role, 'userId' => $user->id, 'user' => $user->toArray(), 'ref' => $ref, 'pdf' => $contractPdf);
    }
		
		protected function actionsTabAgentRequest($user) {
			$this->setTemplate('user/actionsAgentRequest.twig');
			
			$ref = null;
        if($user->parent_id > 0) {
            $ref = UserTable::getInstance()->findOneById($user->parent_id, Doctrine::HYDRATE_ARRAY);
        }
			
			return array('userId' => $user->id, 'user' => $user->toArray(), 'ref' => $ref);
		}
    
    protected function actionsTransactionsRequest($user)
    {
        $this->setTemplate('user/actionsTransactions.twig');
        
        
        $page = $this->getParam('page');
        
        $view = $this->getParam('view');
        $spendFee = 0;
        $transfer = 0;
        $spentT = 0;
        switch($view) {
            case 'coupons':
                $l = '&view=coupons';
                $query = CouponTable::getInstance()->getUserCoupons(array('owner_id' => $user->id));
            break;
        
            case 'received':
                $l = '&view=received';
                $query = TransactionTable::getInstance()->getReceivedTransactions(array('receiver_id' => $user->id));
            break;
        
            case 'network':
                $l = '&view=network';
                $query = TransactionTable::getInstance()->getNetworkTransactions(array('receiver_id' => $user->id));
            break;
        
            case 'wallet':
                $l = '&view=wallet';
                $query = TransactionTable::getInstance()->getWalletTransactions(array('receiver_id' => $user->id));
            break;
        
            default:
                $l = '';
                $query = TransactionTable::getInstance()->getSentTransactions(array('sender_id' => $user->id));
            break;
        }
        
        $pagerLayout = new PagerLayoutWithArrows(
                new Doctrine_Pager(
                    $query,
                    $page, 25),
                      new Doctrine_Pager_Range_Sliding(array(
                            'chunk' => 5
                      )),
                '/admin/users/actions/'.$user->id.'?tab=transactions&page={%page_number}'.$l
            );
        $pagerLayout->setTemplate('<li><a href="{%url}">{%page}</a></li>');
        $pagerLayout->setSelectedTemplate('<li class="selected">{%page}</li>');
        
        // Fetching users
        $transactions = $pagerLayout->execute(array(), Doctrine::HYDRATE_ARRAY);
        $transactionType = array_flip(TransactionTable::$type);
        
        $dbRoles = UserTable::getInstance()->getRoles(array('user_id' => $user->id))->fetchArray();
        $userRoles = array();
        foreach($dbRoles as $role) {
            $userRoles[$role['id']] = strtolower($role['name']);
        }
        
        $role = 'user';
        
        if(in_array('admin', $userRoles)) {
            $role = 'admin';
        }
        if(in_array('shop', $userRoles)) {
            $role = 'merchant';
        }
        return array('role' => $role, 
            'transactions'  => $transactions,
            'pagination' => $pagerLayout->display(array(), true),
            'transactionType' => $transactionType,
            'view'  => $view,
            'spendFee' => $spendFee,
            'transfer'  => $transfer,
            'spent' => $spentT,
            'userId' => $user->id,
            'user' => $user->toArray(),
        );
    }
    
    public function transactionDetailAction()
    {
        $this->setTemplate('user/transactionDetail.twig');
        
        $user_id = $this->getParam('id');
        
        $id = $this->getParam('trans_id');
        if(!$id || !$user_id) {
            return $this->notFoundAction();
        }
        
        $transaction = TransactionTable::getInstance()->getUserTransactionDetails(array(
            'id' => $id,
            'user_id' => $user_id
                ))->fetchOne(array(), Doctrine::HYDRATE_ARRAY);
        
        if(!$transaction['id']) {
            return $this->notFoundAction();
        }
        $transactionType = array_flip(TransactionTable::$type);
        return array(
            'transaction'  => $transaction,
            'transactionType' => $transactionType
        );
    }
    
    protected function actionsStatisticsRequest($user)
    {
        $this->setTemplate('user/actionsStatistics.twig');
        
        
        $page = $this->getParam('page');
        $view = $this->getParam('view');

        $type = $this->getParam('type', 'bDaily');
        $for = $this->getParam('for', 'product');
        $dbRoles = UserTable::getInstance()->getRoles(array('user_id' => $user->id))->fetchArray();
        $userRoles = array();
        foreach($dbRoles as $role) {
            $userRoles[$role['id']] = strtolower($role['name']);
        }
        
        $role = 'user';
        
        if(in_array('admin', $userRoles)) {
            $role = 'admin';
        }
        if(in_array('shop', $userRoles)) {
            $role = 'merchant';
        }
        
        switch($type) {
            case 'bMonthly':
                
                $year = date('Y') + $page;
                for($x = 1; $x <= 12; $x++) {
                    $perMonth['transactions'][$x] = 0;
                    $perMonth['quantity'][$x] = 0;
                    $perMonth['money'][$x] = 0;
                }

                $stats = TransactionTable::getInstance()->getBuyTransactionsStatistic(array('year' => $year, 'user_id' => $user->id), 'monthly');
                
                foreach($stats AS $s) {
                    if (array_key_exists($s['m'], $perMonth['transactions'])) {
                        $perMonth['transactions'][$s['m']] = $s['total'];
                        $perMonth['quantity'][$s['m']] = $s['qty'];
                        $perMonth['money'][$s['m']] = -$s['payment'];
                    }
                }
                return array('role' => $role, 
                    'per_month' => $perMonth,
                    'year' =>  $year,
                    'page' => $page,
                    'type'  => $type,
                    'for'    => $for,
                    'userId' => $user->id
                );
            break;
        
            case 'bDaily':
                
                $month = mktime(0, 0, 0, date('m') + $page  , 1, date("Y"));
                $days = date('t', $month);
                $perDay = array();
                for($x = 1; $x <= $days; $x++) {
                    $perDay['transactions'][$x] = 0;
                    $perDay['quantity'][$x] = 0;
                    $perDay['money'][$x] = 0;
                }

                $stats = TransactionTable::getInstance()->getBuyTransactionsStatistic(array('month' => date('m', $month), 'year' => date('Y', $month), 'user_id' => $user->id));
                
                foreach($stats AS $s) {
                    if (array_key_exists($s['d'], $perDay['transactions'])) {
                        $perDay['transactions'][$s['d']] = $s['total'];
                        $perDay['quantity'][$s['d']] = $s['qty'];
                        $perDay['money'][$s['d']] = -$s['payment'];
                    }
                }
                
                return array('role' => $role, 
                    'per_day' => $perDay,
                    'month' =>  $month,
                    'page' => $page,
                    'type'  => $type,
                    'for'    => $for,
                    'userId' => $user->id
                );
            break;
            
            case 'sMonthly':
                
                $year = date('Y') + $page;
                for($x = 1; $x <= 12; $x++) {
                    $perMonth['transactions'][$x] = 0;
                    $perMonth['quantity'][$x] = 0;
                    $perMonth['money'][$x] = 0;
                }

                $stats = TransactionTable::getInstance()->getSoldTransactionsStatistic(array('year' => $year, 'user_id' => $user->id), 'monthly');
                
                foreach($stats AS $s) {
                    if (array_key_exists($s['m'], $perMonth['transactions'])) {
                        $perMonth['transactions'][$s['m']] = $s['total'];
                        $perMonth['quantity'][$s['m']] = $s['qty'];
                        $perMonth['money'][$s['m']] = $s['payment'];
                    }
                }
                return array('role' => $role, 
                    'per_month' => $perMonth,
                    'year' =>  $year,
                    'page' => $page,
                    'type'  => $type,
                    'for'    => $for,
                    'userId' => $user->id
                );
            break;
        
            case 'sDaily':
                
                $month = mktime(0, 0, 0, date('m') + $page  , 1, date("Y"));
                $days = date('t', $month);
                $perDay = array();
                for($x = 1; $x <= $days; $x++) {
                    $perDay['transactions'][$x] = 0;
                    $perDay['quantity'][$x] = 0;
                    $perDay['money'][$x] = 0;
                }

                $stats = TransactionTable::getInstance()->getSoldTransactionsStatistic(array('month' => date('m', $month), 'year' => date('Y', $month), 'user_id' => $user->id));
                
                foreach($stats AS $s) {
                    if (array_key_exists($s['d'], $perDay['transactions'])) {
                        $perDay['transactions'][$s['d']] = $s['total'];
                        $perDay['quantity'][$s['d']] = $s['qty'];
                        $perDay['money'][$s['d']] = $s['payment'];
                    }
                }
                
                return array('role' => $role, 
                    'per_day' => $perDay,
                    'month' =>  $month,
                    'page' => $page,
                    'type'  => $type,
                    'for'    => $for,
                    'userId' => $user->id
                );
            break;
        }
    }
}
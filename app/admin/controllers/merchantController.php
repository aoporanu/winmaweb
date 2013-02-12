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

class merchantController extends Cms_Controller
{
    public function init()
    {
        if (!$this->user->hasRole('ADMIN')) {
            $this->redirect('/');
        }
    }
    
    public function indexAction()
    {
        $this->setTemplate('merchant/show.twig');
        
        $page = $this->getParam('page');
        if($page < 1) {
            $page = 1;
        }
        
        $ac = $this->getParam('ac');
        $activation = SiteConfigTable::getInstance()->findOneBy('config_name', 'merchant_request'/*, Doctrine::HYDRATE_ARRAY*/);
				$agent_activation = SiteConfigTable::getInstance()->findOneBy('config_name', 'agent_request'/*, Doctrine::HYDRATE_ARRAY*/);
        switch($ac) {
            case 'activation':
                if($activation->config_value == 'on') {
                    $activation->config_value = 'off';
                } else {
                    $activation->config_value = 'on';
                }
                $activation->save();
						case 'agent_activation':
                if($agent_activation->config_value == 'on') {
                    $agent_activation->config_value = 'off';
                } else {
                    $agent_activation->config_value = 'on';
                }
                $agent_activation->save();
            break;
        }
        
        $show = $this->getParam('show');
        
        $userTable = UserTable::getInstance();
        
        switch($show)
        {
            case 'request':
                $query = $userTable->getUsersByMRequest();
            break;
						case 'agents';
							$query = $userTable->getUsersByRole(array('roleIn' => array('agent')));
							break;
            default:
                $query = $userTable->getUsersByRole(array('roleIn' => array('shop')));
            break;
        }
        $pagerLayout = new PagerLayoutWithArrows(
                new Doctrine_Pager(
                    $query,
                    $page, 25),
                      new Doctrine_Pager_Range_Sliding(array(
                            'chunk' => 5
                      )),
                '/admin/users?page={%page_number}&show='.$show
            );
        $pagerLayout->setTemplate('<li><a href="{%url}">{%page}</a></li>');
        $pagerLayout->setSelectedTemplate('<li class="selected">{%page}</li>');
        
        // Fetching users
        $users = $pagerLayout->execute(array(), Doctrine::HYDRATE_ARRAY);
        
        $c_file = '';
        
        if(file_exists(ROOT_PATH . '/uploads/contracts/contract.pdf')) {
            $c_file = '/uploads/contracts/contract.pdf';
        }
        
        return array(
            'users' => $users,
            'pagination' => $pagerLayout->display(array(), true),
            'activeMenu' => $show,
            'activation' => $activation->config_value,
						'agent_activation' => $agent_activation->config_value,
            'cfile' => $c_file
        );
    }
    
    public function contractAction()
    {
        $is_ajax = $this->request->getParam('isajaxrequest');
        
        if(!$is_ajax) {
            $is_ajax = $this->request->isXmlHttpRequest();
        }
        
        if(!$is_ajax) {
            return $this->notFoundAction();
        }
        
        $c_file = '';
        
        if(file_exists(ROOT_PATH . '/uploads/contracts/contract.pdf')) {
            $c_file = '/uploads/contracts/contract.pdf';
        }
        
        $this->setTemplate('merchant/contract.twig');
        
        $form = new Zend_Form();
        
        $contract = new Zend_Form_Element_File('contract');
        $contract->addValidator('Extension', false, 'pdf')
                ->setRequired()
                ->addFilter('Rename',
                   array('target' => ROOT_PATH . '/uploads/contracts/contract.pdf',
                         'overwrite' => true));
        $form->addElement($contract, 'contract');
        
        if( $this->request->getPost() ) {
            if ($form->isValid($this->request->getPost())) {
                $success = true;
            }
        }
 
        return array(
                'form' => array(
                        'values' => $form->getValues(),
                        'errors' => $form->getMessages(),
                        'success' => (isset($success) ? $success : false)
                    ),
                'imgajax' => $is_ajax,
                'cfile' => $c_file
        );
    }
    
    public function commissionAction()
    {
        $this->setTemplate('commission/commission.twig');
        
        $ac = $this->getParam('ac');
        
        switch($ac) {
            case 'add_level':
                return $this->addLevelCommission();
            break;
        
            case 'edit_level':
                return $this->editLevelCommission();
            break;
        
            case 'del_level':
                $id = $this->getParam('id');
                $treeObject = Doctrine_Core::getTable('Level')->find($id);
                if($treeObject->id) {
                    $treeObject->getNode()->delete();
                }
            break;
            
            case 'edit_sc':
                return $this->editSiteCommission();
            break;
        }
        
        $treeObject = Doctrine_Core::getTable('Level')->find(1);
        $tree = $treeObject->getNode()->getChildren();
        
        $tax = SiteConfigTable::getInstance()->getSiteFee();
        $tax = $tax['config_value'];
        
        $spend = SiteConfigTable::getInstance()->getSpendFee();
        $spend = $spend['config_value'];
        
        $merchant = SiteConfigTable::getInstance()->getMerchantFee();
        $merchant = $merchant['config_value'];
        
        $oc = SiteConfigTable::getInstance()->getOfferCommission();
        $oc = $oc['config_value'];
        
        $pf = SiteConfigTable::getInstance()->getPaypalFee();
        $pf = $pf['config_value'];
        
        $d = SiteConfigTable::getInstance()->getPayoutDelay();
        $d = $d['config_value'];
        
        return array('tree' => $tree, 'tax' => $tax, 'spend' => $spend, 'merchant' => $merchant, 'oc' => $oc, 'pf' => $pf, 'd' => $d);
    }
    
    protected function addLevelCommission()
    {
        $this->setTemplate('commission/addLevel.twig');
        
        $form = new Zend_Form();
        $commission = $form->createElement('text', 'commission');
        $commission->addValidator('Int', true)
                          ->addValidator('Between', true, array('min' => 0, 'max' => 50, 'messages' => 'You an select a procent betwen 0 ad 50'))
                          ->setRequired(true);
        
        $form->addElement($commission);
                
       if( $this->request->getPost() ) {
            if ($form->isValid($this->request->getPost())) {
                $c = new Level();
                $c->commission = $form->getValue('commission');
                $treeObject = Doctrine_Core::getTable('Level')->find(1);
                //$tree = $treeObject->getNode();
                $c->getNode()->insertAsLastChildOf($treeObject);
                $form->clearElements();
                $success = true;
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
    
    protected function editLevelCommission()
    {
        $this->setTemplate('commission/editLevel.twig');
        
        $id = $this->getParam('id');
        if(!$id) {
            return $this->notFoundAction();
        }
        $c = Doctrine_Core::getTable('Level')->find($id);
        if(!$c->id) {
            return $this->notFoundAction();
        }
        
        
        $form = new Zend_Form();
        $commission = $form->createElement('text', 'commission');
        $commission->addValidator('Int', true)
                          ->addValidator('Between', true, array('min' => 0, 'max' => 50, 'messages' => 'You an select a procent betwen 0 ad 50'))
                          ->setRequired(true)
                          ->setValue($c->commission);
        
        $form->addElement($commission);
                
       if( $this->request->getPost() ) {
            if ($form->isValid($this->request->getPost())) {
                $c->commission = $form->getValue('commission');
                $c->save();
                $success = true;
            }
        }
        
        return array(
                'form' => array(
                        'values' => $form->getValues(),
                        'errors' => $form->getMessages(),
                        'success' => (isset($success) ? $success : false)
                    ),
            'levelId' => $c->id
        );
    }
    
    protected function editSiteCommission()
    {
        $this->setTemplate('commission/editSC.twig');
        
        $m = $this->getParam('m');
        
        
        
        $form = new Zend_Form();
        $commission = $form->createElement('text', 'commission');
        $commission->addValidator('Int', true)
                          ->setRequired(true);
        
        if($m == 'oc') {
            $oc = SiteConfigTable::getInstance()->getOfferCommission();
            $oc = $oc['config_value'];
            $commission->addValidator('Between', true, array('min' => 0, 'max' => 50, 'messages' => 'You an select a procent betwen 0 and 90'))
                ->setValue($oc);
        }
        
        if($m == 'd') {
            $d = SiteConfigTable::getInstance()->getPayoutDelay();
            $d = $d['config_value'];
            $commission->addValidator('Between', true, array('min' => -1, 'max' => 50, 'messages' => 'You an select a betwen 0 and 50'))
                ->setValue($d);
        }
        
        if($m == 'pf') {
            $pf = SiteConfigTable::getInstance()->getPaypalFee();
            $pf = $pf['config_value'];
            $commission->addValidator('Between', true, array('min' => 0, 'max' => 50, 'messages' => 'You an select a procent betwen 0 and 90'))
                ->setValue($pf);
        }
        
        if($m == 'tax') {
            $tax = SiteConfigTable::getInstance()->getSiteFee();
            $tax = $tax['config_value'];
            $commission->addValidator('Between', true, array('min' => 0, 'max' => 50, 'messages' => 'You an select a procent betwen 0 and 50'))
                ->setValue($tax);
        }
        
        if($m == 'sfee') {
            $spend = SiteConfigTable::getInstance()->getSpendFee();
            $spend = $spend['config_value'];
            $commission->addValidator('Between', true, array('min' => 0, 'max' => 90, 'messages' => 'You an select a procent betwen 0 and 90'))
                ->setValue($spend);
        }
        
        if($m == 'mfee') {
            $merchant = SiteConfigTable::getInstance()->getMerchantFee();
            $merchant = $merchant['config_value'];
            $commission->addValidator('GreaterThan', true, array('min' => -1, 'messages' => 'Minimum value is 0'))
                ->setValue($merchant);
        }
        
        $form->addElement($commission);
                
       if( $this->request->getPost() ) {
            if ($form->isValid($this->request->getPost())) {
                if($m == 'tax') {
                    $tax = SiteConfigTable::getInstance()->getSiteFee(array(), Doctrine::HYDRATE_RECORD);
                    $tax->config_value = $form->getValue('commission');
                    $tax->save();
                    $success = true;
                }
                
                if($m == 'sfee') {
                    $spend = SiteConfigTable::getInstance()->getSpendFee(array(), Doctrine::HYDRATE_RECORD);
                    $spend->config_value = $form->getValue('commission');
                    $spend->save();
                    $success = true;
                }
                
                if($m == 'mfee') {
                    $merchant = SiteConfigTable::getInstance()->getMerchantFee(array(), Doctrine::HYDRATE_RECORD);
                    $merchant->config_value = $form->getValue('commission');
                    $merchant->save();
                    $success = true;
                }
                
                if($m == 'oc') {
                    $merchant = SiteConfigTable::getInstance()->getOfferCommission(array(), Doctrine::HYDRATE_RECORD);
                    $merchant->config_value = $form->getValue('commission');
                    $merchant->save();
                    $success = true;
                }
                
                if($m == 'd') {
                    $merchant = SiteConfigTable::getInstance()->getPayoutDelay(array(), Doctrine::HYDRATE_RECORD);
                    $merchant->config_value = $form->getValue('commission');
                    $merchant->save();
                    $success = true;
                }
                
                if($m == 'pf') {
                    $merchant = SiteConfigTable::getInstance()->getPaypalFee(array(), Doctrine::HYDRATE_RECORD);
                    $merchant->config_value = $form->getValue('commission');
                    $merchant->save();
                    $success = true;
                }
                
            }
        }
        
        return array(
                'form' => array(
                        'values' => $form->getValues(),
                        'errors' => $form->getMessages(),
                        'success' => (isset($success) ? $success : false)
                    ),
            'm' => $m
        );
    }
    
}
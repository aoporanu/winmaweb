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
    public function init()
    {
        if (!$this->user->hasRole('ADMIN')) {
            $this->redirect('/');
        }
    }
    public function indexAction()
    {
        $this->setTemplate('index.twig');
        
        $acl = new Zend_Acl();
        $acl->addRole(new Zend_Acl_Role('admin'));
        $acl->add(new Zend_Acl_Resource('pageModule'));
        $acl->allow('admin', 'pageModule');
        //print_r($acl->hasRole('admin'));
        return array('asd' => 1);
    }
    
    public function getSubcategoryAction()
    {
        $id = $this->getParam('id');
        
        $treeObject = Doctrine_Core::getTable('Category')->find($id);
        $tree = array();
        if($treeObject) {
            $tree = $treeObject->getNode()->getChildren()->toArray();
        }
        $this->setTemplate('default/subcategories.twig');
        
        return array(
                'subcategories' => $tree
            );
    }
		
		public function my_networkAction() {
			$this->setTemplate('default/my_network.twig');
			
			$page = $this->getParam('page');
			if ($page < 1) {
				$page = 1;
			}
			
			$action = $this->getParam('ac');
            
			switch($action) {
//					case 'edit':
//									$this->_editMedia();
//							break;
					case 'delete':
									$this->_deleteMedia();
							break;
					case 'add':
						$this->_addMedia();
						break;
			}
			
			$myNetworkTable = MyNetworkTable::getInstance();
			$query = $myNetworkTable->createQuery()
							->select('*')
							->from('MyNetwork');
			 $pagerLayout = new PagerLayoutWithArrows(
                new Doctrine_Pager(
                    $query,
                    $page, 25),
                      new Doctrine_Pager_Range_Sliding(array(
                            'chunk' => 5
                      )),
                '/admin/my-network?page={%page_number}&show='.$show.$searchP
            );
        $pagerLayout->setTemplate('<li><a href="{%url}">{%page}</a></li>');
        $pagerLayout->setSelectedTemplate('<li class="selected">{%page}</li>');
				
				$links = $pagerLayout->execute(array(), Doctrine::HYDRATE_ARRAY);
				return array(
            'links' => $links,
            'pagination' => $pagerLayout->display(array(), true)
        );
		}
        
        private function _deleteMedia() {
//            if(!$this->request->isXmlHttpRequest()) {
//                return $this->notFoundAction();
//            }
            
            $id = $this->getParam('id');
            $network = Doctrine_Query::create()
                    ->delete()
                    ->from('MyNetwork')
                    ->where('id = ?', $id)
										->execute();
						$this->redirect('/admin/my-network');
        }
        
        private function _editMedia() {
            if(!$this->request->isXmlHttpRequest()) {
                return $this->notFoundAction();
            }

            $id = $this->getParam('id');
            $product = Doctrine_Query::create()
                        ->from('MyNetwork p')
                        ->addWhere('p.id = ?', $id)
                        ->fetchOne();
            if(!$product->id) {
                $this->forbiddenAction('You dont have acces to this media file');
            }
            
            $this->setTemplate('default/edit.twig');
        
            $form = new Zend_Form();
            $form->setAttrib('enctype', 'multipart/form-data');
            $title = $form->createElement('text', 'name');
            $title->setRequired();
            $file_name = $form->createElement('text', 'file_name');
            $form->addElement($name)
                    ->addElement($file_name);
            $photo = new Zend_Form_Element_File('photo123');
            $photo->addValidator('Extension', false, 'ppt,pptx,pptm,ppsx,ppsm,sldx,sldm,avi,mpeg,wmv,mp4');
            $form->addElement($photo);
            $uploadDir = '/uploads/mynetwork';
            if( $this->request->getPost() ) {
                if ($form->isValid($this->request->getPost())) {
                    if(!$photo->isReceived()) {
                        $product->title = $form->getValue('title');
                        $product->file_name = $form->getValue('file_name');
                        $product->save();
                    } else {
                        if($photo->isValid()) {
                            if($_FILES['photo123']['tmp_name']) {
                                $tmp_name = $_FILES['photo123']['tmp_name'];
                                $name = $form->getValue('file_name');
                                move_uploaded_file($tmp_name, $uploadDir);
                            }
                            $product->title = $form->getValue('title');
                            $product->file_name = $form->getValue('file_name');
                            $product->save();
                        }
                    }
                    $form->reset();
                    $success = true;
                } else {
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
        
        private function _addMedia() {
            $this->setTemplate('default/add.twig');
//            if(!$this->request->isXmlHttpRequest()) {
//                return $this->notFoundAction();
//            }
            
            $is_ajax = $this->request->getParam('isajaxrequest');

            if(!$is_ajax) {
                $is_ajax = $this->request->isXmlHttpRequest();
            }
            
            $form = new Zend_Form();
            $form->setAttrib('enctype', 'multipart/form-data');
            $title = $form->createElement('text', 'title');
						$form->addElement($title, 'title');
            $title->setRequired();
            $file = new Zend_Form_Element_File('file');
						$fileName = $file->getFileName(null, false);
						$uploadDir = '/uploads/mynetwork';
            $file->addValidator('Extension', false, 'pdf,ppt,pptx,pptm,ppsx,ppsm,sldx,sldm,avi,mpeg,wmv,mp4')
										->setRequired()
										->addFilter('Rename',
														array('target' => ROOT_PATH . $uploadDir . '/' . $fileName)
														);
						$form->addElement($file, 'file');
            
            if($this->request->getPost()) {
                if($form->isValid($this->request->getPost())) {
//                    if($file->isValid()) {
										if ($form->file->receive()) {
                        $network = new MyNetwork();
                        $network->title = $form->getValue('title');
                        $network->filename = $fileName;
                        $network->save();
                        $success = true;
//                        if($_FILES['file']['tmp_name']) {
//                            $tmp_name = $_FILES['file']['tmp_name'];
//                            $name =$network->filename;
//                            move_uploaded_file($tmp_name, $uploadDir);
														$this->redirect('/admin/my-network');
//                        }
                    }
                    $form->reset();
                    $success = true;
                } else {
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
}
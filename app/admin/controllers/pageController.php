<?php

class pageController extends Cms_Controller
{
    public function init()
    {
        if (!$this->user->hasRole('ADMIN')) {
            $this->redirect('/');
        }
    }
    
    public function showAction()
    {
        $this->setTemplate('pages/show.twig');
        
        $treeTable = Doctrine_Core::getTable('Tree');
        $pages = $treeTable->find(2);
        $f_roots = $pages->getNode()->getChildren();
        $f_array = array();
        
        foreach($f_roots AS $f_root) {
            $f_array[$f_root['id']]['name'] = $f_root['name'];
        }
        
        return array('pages' => $f_array);
    }
    
    public function editAction()
    {
        $this->setTemplate('pages/edit.twig');
        
        $page_id = $this->getParam('id');
        $c_page = Doctrine::getTable('Tree')->find($page_id);
        if(!$c_page->id) {
            return $this->notFoundAction();
        }
        
        $parent = $c_page->getNode()->getParent();
        
        $form = new Zend_Form();
        
        $tags = $form->createElement('text', 'tags');
        $tags->setRequired();
        
        $meta_title = $form->createElement('text', 'meta_title');
        
        $meta_content = $form->createElement('textarea', 'meta_content');
        $meta_content->setRequired();
        
        $content = $form->createElement('textarea', 'content');
        
        $form->addElement($tags)
                ->addElement($content)
                ->addElement($meta_content)
                ->addElement($meta_title);
        
        $query_tags = Doctrine_Query::create()
                    ->select('pt.tree_id, t.name AS tag')
                    ->from('PageTags pt')
                    ->leftJoin('pt.Tag t')
                    ->where('pt.tree_id = ?', $c_page->id)
                    ->execute(array(), Doctrine::HYDRATE_ARRAY);
        $_tag = array();
        if($query_tags) {
            
            foreach($query_tags AS $_tags) {
                $_tag[] = $_tags['tag'];
            }
        }
        $form->populate(array('fname' => $c_page->name,
                        'tags' => implode(',', $_tag),
                        'meta_content' => $c_page->meta_content,
                        'meta_title' => $c_page->meta_title,
                        'content' => $c_page->content
            ));
       
        $newpost = $_POST;
        //$newpost['db_content'] = $newpost['content'];
        //print_r($newpost['content']);
        $newpost['content'] = str_replace('\"', '"', $newpost['content']);
        $newpost['content'] = str_replace('../', '/', $newpost['content']);
        $newpost['content'] = str_replace("\'", "&#39;", $newpost['content']);
        $newpost['meta_content'] = str_replace("\'", "&#39;", $newpost['meta_content']);
        
        if( $this->request->getPost() ) {
            if ($form->isValid($newpost)) {
               $c_page->meta_content = $form->getValue('meta_content');
               $c_page->meta_title = $form->getValue('meta_title');
               $c_page->content = $form->getValue('content');
               $c_page->save();
                Doctrine_Query::create()
                    ->delete('PageTags')
                    ->addWhere('tree_id = ?', $c_page->id)
                    ->execute();
               $collection = new Doctrine_Collection('PageTags');
               $tags = explode(',', $form->getValue('tags'));
               $col = array();
               foreach( $tags AS $tag) {
                    $t = new Tag();
                    $t->name = $tag;
                    $t->link('Pages', array($c_page->id));
                    $col[$t->id] = $t;
                }
                
               $collection->setData($col);
               $collection->save();
               $success = true;
               
            }
        }
        
        return array(
            'form' => array(
                            'values' => $form->getValues(),
                            'errors' => $form->getMessages(),
                            'status' => $form->status,
                            'success' => (isset($success) ? $success : false)
                            ),
            'page_id' => $page_id,
        );
    }
    
    public function newsletterAction()
    {
        $this->setTemplate('pages/newsletter.twig');
        
        $form = new Zend_Form();
        
        $subject = $form->createElement('text', 'subject')->setRequired();
        $content = $form->createElement('textarea', 'content')->setRequired();
        
        
        
        $form->addElement($subject)
                ->addElement($content);
        
        $newpost = $_POST;
        
        if( $this->request->getPost() ) {
            if ($form->isValid($newpost)) {
                require_once(ROOT_PATH . '/lib/bbcode/parser.php');
                $p = new Parser();
                $c = $p->p($form->getValue('content'), 1);
                $s = $form->getValue('subject');
                $dbEmails = UserTable::getInstance()->getNewsletter();
                $emails = array();
                
                require_once 'Swift/swift_required.php';
                $transport = Swift_SendmailTransport::newInstance('/usr/sbin/sendmail -bs');
                $mailer = Swift_Mailer::newInstance($transport);
                //Create a message
                $message = Swift_Message::newInstance($s)
                  ->setFrom(array('newsletter@winmaweb.com' => 'winmaweb'))
                  ->setBody($c, 'text/html');
                //$message->setTo($emails);
                //$mailer->send($message);
                foreach($dbEmails as $email) {
                    //$emails[] = $email['email'];
                    $message->setTo(array($email['email']));
                    $mailer->send($message);
                    $success = true;
                    $form->reset();
                }
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
    
    public function helpAction()
    {
        $this->setTemplate('pages/help.twig');
        
        $treeTable = Doctrine_Core::getTable('HelpPages');
        $pages = $treeTable->findAll();
                
        return array('pages' => $pages);
    }
    
    public function helpEditAction()
    {
        $this->setTemplate('pages/edit_help.twig');
        
        $page_id = $this->getParam('id');
        $c_page = Doctrine::getTable('HelpPages')->find($page_id);
        if(!$c_page->id) {
            return $this->notFoundAction();
        }
        
        
        $form = new Zend_Form();
        
        $tags = $form->createElement('text', 'tags');
        $tags->setRequired();
        
        $meta_title = $form->createElement('text', 'meta_title');
        
        $meta_content = $form->createElement('textarea', 'meta_content');
        $meta_content->setRequired();
        
        $content = $form->createElement('textarea', 'content');
        
        $form->addElement($content)
             ;
        
        $form->populate(array(//'fname' => $c_page->name,
                        //'tags' => implode(',', $_tag),
                        //'meta_content' => $c_page->meta_content,
                        //'meta_title' => $c_page->meta_title,
                        'content' => $c_page->content
            ));
       
        $newpost = $_POST;
        //$newpost['db_content'] = $newpost['content'];
        //print_r($newpost['content']);
        $newpost['content'] = str_replace('\"', '"', $newpost['content']);
        $newpost['content'] = str_replace('../', '/', $newpost['content']);
        $newpost['content'] = str_replace("\'", "&#39;", $newpost['content']);
        $newpost['meta_content'] = str_replace("\'", "&#39;", $newpost['meta_content']);
        
        if( $this->request->getPost() ) {
            if ($form->isValid($newpost)) {
               //$c_page->meta_content = $form->getValue('meta_content');
               //$c_page->meta_title = $form->getValue('meta_title');
               $c_page->content = $form->getValue('content');
               $c_page->save();
               $success = true;
               
            }
        }
        
        return array(
            'form' => array(
                            'values' => $form->getValues(),
                            'errors' => $form->getMessages(),
                            'status' => $form->status,
                            'success' => (isset($success) ? $success : false)
                            ),
            'page_id' => $page_id,
        );
    }
}
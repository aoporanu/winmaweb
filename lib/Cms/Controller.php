<?php

abstract class Cms_Controller
{
    protected $twig;
    protected $request;
    protected $user;
    
    protected $params = array();
    
    protected $template = '';
    
    protected $redirectUrl = false;
    
    public $stop = false;
    
    public function __construct($twig, $request, $user, $params = array())
    {
        $this->twig = $twig;
        //$this->session = $session;
        $this->request = $request;
        $this->user = $user;
        $this->params = $params;
    }
    
    protected function getParam($name, $default = null)
    {
        if($this->params[$name]) {
            return $this->params[$name];
        }
        
        if($this->request->getParam($name)) {
            return $this->request->getParam($name);
        }
        
        if($default) {
            return $default;
        }
        
        return null;
    }
    
    public function getTemplate()
    {
        return $this->template;
    }
    
    public function setTemplate($template)
    {
        $this->template = $template;
    }
    
    public function notFoundAction()
    {
        $this->stop = true;
        $this->setTemplate('error404.twig');
        header("HTTP/1.0 404 Not Found");
        return array('title' => '404 Page not found', 'msg' => 'This page do not exist');
    }
    
    public function forbiddenAction($msg = 'You do not have access to this page')
    {
        $this->stop = true;
        $this->setTemplate('error403.twig');
        header('HTTP/1.1 403 Forbidden');
        return array('title' => '403 Access forbidden', 'msg' => $msg);
    }
    
    public function onlyAjax($ajax = false)
    {
        if(!$this->request->isXmlHttpRequest()) {
            return false;
        }
    }
    
    public function redirect($url)
    {
        $this->stop = true;
        if($this->request->isXmlHttpRequest()) {
            $this->redirectUrl = $url;
            return array('ajaxRedirect' => $url);
        }
        
        header('Location: ' . $url);
        die();
    }
    
    public function getRedirectUrl() {
        
        return $this->redirectUrl;
    }
    
    public function setTwigGlobalParam($index, $value)
    {
        $this->twigGlobalParams[$index] = $value;
    }
    
    public function init()
    {
        
    }
    
}
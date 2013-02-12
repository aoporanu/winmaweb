<?php

class Cms_Router
{
    protected $routing;
    
    protected $routerFile;
    protected $uri;
        
    public function __construct()
    {
        $sfpath = ROOT_PATH . '/lib/symfony/';
        require_once($sfpath.'routing/sfRoute.class.php');
        require_once($sfpath.'routing/sfRouting.class.php');
        require_once($sfpath.'routing/sfPatternRouting.class.php');
        require_once($sfpath.'event_dispatcher/sfEvent.php');
        require_once($sfpath.'event_dispatcher/sfEventDispatcher.php');
        
        $this->routing = new sfPatternRouting(new sfEventDispatcher());
    }
    
    public function setRouterFile($routerFile)
    {
        $this->routerFile = $routerFile;
        
        return $this;
    }
    
    public function setUri($uri)
    {
        $this->uri = $uri;
        
        return $this;
    }
    
    public function setRoutes()
    {
        $routes = new Zend_Config_Yaml($this->routerFile);
        $routes = $routes->toArray();

        foreach($routes as $key => $route) {
            if(!is_array($route['param']))
            {
                $route['param'] = array();
            }
            if(!is_array($route['requirements']))
            {
                $route['requirements'] = array();
            }
            $this->routing->connect($key, new sfRoute(
                    $route['url'], $route['param'], $route['requirements']
                    ));
        }
        
        return $this;
    }
    
    protected function parseUri()
    {
        return $this->routing->parse($this->uri);
    }
    
    public function run()
    {
        $ret = $this->parseUri();
        
        if(empty($ret)) {
            return array('class' => 'default', 'func' => 'notFound', 'params' => array());
        }

        foreach($ret as $key => $val)
        {
          if (!is_object($val))
          {
              if($key == 'module') {
                  $class = $val;
              } elseif($key == 'action') {
                  $func = $val;
              } else {
                  $params[$key] = $val;
              }
          }
        }

        return array('class' => $class, 'func' => $func, 'params' => $params);
    }
    
    public function getRouting()
    {
        return $this->routing;
    }
}
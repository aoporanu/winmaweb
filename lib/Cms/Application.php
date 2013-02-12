<?php

class Cms_Application {
    
    protected $app = 'site';
    
    protected $twig = null;
    protected $user = null;
    protected $request = null;
    
    protected $routerObj = null;
    
    protected $request_uri;
    
    protected $doctrineProfiler = null;
    
    public function __construct()
    {
        $this->request_uri = explode('/', $_SERVER["REQUEST_URI"]);
        if($this->request_uri[1] == 'admin') {
            $this->app = 'admin';
            unset($this->request_uri[1]);
        }
        
        $this->request_uri = implode('/', $this->request_uri);
        
        return $this;
    }
    
    /*
     * Bootstrap all application
     */
    
    public function bootstrap()
    {
        require_once('Zend/Loader/Autoloader.php');

        Zend_Loader_Autoloader::getInstance();

        Zend_Session::setOptions(array('save_path' => ROOT_PATH . '/cache/session', 'remember_me_seconds' => 8600));
        Zend_Session::start();
        
        $this->request = new Zend_Controller_Request_Http();
        /**
         * Bootstrap Doctrine.php, register autoloader specify
         * configuration attributes and load models.
         */

        require_once('Doctrine/Doctrine.php');
        spl_autoload_register(array('Doctrine', 'autoload'));
        $manager = Doctrine_Manager::getInstance();
        //$conn = Doctrine_Manager::connection('mysql://root:12345@localhost/winmaweb2');
//        $conn = Doctrine_Manager::connection('mysql://db_user:Yj7CWLC567KtL2o@localhost/city');
				$conn = Doctrine_Manager::connection('mysql://root:123dddxyz11@localhost/wmw');
        $this->doctrineProfiler = new Doctrine_Connection_Profiler();
        $conn->setListener($this->doctrineProfiler);

        $conn->setCharset('utf8');

        $manager->setAttribute(Doctrine_Core::ATTR_AUTO_ACCESSOR_OVERRIDE, true);
        
        Doctrine_Core::loadModels(ROOT_PATH . '/models/generated');
        Doctrine_Core::loadModels(ROOT_PATH . '/models');
        Doctrine_Core::loadModels(ROOT_PATH . '/DQ');

        require_once('Cms/Session.php');
        require_once('Cms/User.php');
        $this->user = new Cms_User();
        
        require_once 'Twig/Autoloader.php';
        Twig_Autoloader::register();

        $loader = new Twig_Loader_Filesystem(ROOT_PATH . '/app/'. $this->app .'/templates');
        $this->twig = new Twig_Environment($loader, array(
            'cache' => ROOT_PATH . '/cache/twig',
            'debug' => true
        ));

        require_once ROOT_PATH . '/Twig/Extensions/Extension/Text.php';
        require_once ROOT_PATH . '/Twig/MyExtensions/General.php';
        $this->twig->addExtension(new Twig_Extensions_Extension_Text());
        $this->twig->addExtension(new Twig_MyExtensions_General());
        require_once('Cms/Helper/help.php');
        $this->twig->addGlobal('helpObj', new HelpObj());
        
        return $this;
    }
    
    /*
     * Run the application
     */
    
    public function run()
    {
        $imp = $this->router();
        
        $className = $imp['class'] . 'Controller';
        $functionName = $imp['func'] . 'Action';
        $params = $imp['params'];
        
        if($params) {
            $params = array_merge($imp['params'], array('action' => $imp['func'], 'module' => $imp['class']));
        } else {
            $params = array('action' => $imp['func'], 'module' => $imp['class']);
        }

        require_once(ROOT_PATH . '/lib/Cms/Controller.php');
        require_once(ROOT_PATH . '/app/'. $this->app .'/controllers/' . $className . '.php');
        
        $obj = new $className($this->twig, $this->request, $this->user, $params);
        
        $obj->init();
        $twig_params = array();
        if(!$obj->stop){
            $twig_params = $obj->$functionName();
        }
        if($obj->getRedirectUrl()) {
            header('Content-type: application/json');
            echo json_encode(array('ajaxRedir' => $obj->getRedirectUrl()));
            die;
        }
        //echo '<pre>';
        //print_r($this->dbProfile());//die;
        require_once(ROOT_PATH . '/lib/Cms/Helper/UrlHelper.php');
        $this->twig->addGlobal('router', new UrlHelper($this->routerObj->getRouting(), $this->app));
        $this->twig->addGlobal('userObj',$this->user);
				$this->twig->addGlobal('userGroup', $this->user->getUserGroup());
        
        //$this->twig->addGlobal('currency',new Zend_Currency(null, 'en_US'));
        
        $cart = new Zend_Session_Namespace('shopCart');
        
        $twig_params = array_merge($twig_params, array('app' => array(
                    'ajax' => $this->request->isXmlHttpRequest(),
                    'user' => $this->user->getUser(),
                    'ajaxRedirectUrl' => $obj->getRedirectUrl(),
                    'app_name' => $this->app,
                    'shopCart' => $cart
                )));
        $twig_params = array_merge($twig_params, array('global' => $obj->twigGlobalParams));
        
        $template = $this->twig->loadTemplate($obj->getTemplate());
        echo $template->render($twig_params);
        die;
    }
    
    /*
     * Set the router
     */
    
    protected function router()
    {
        require_once('Cms/Router.php');
        $this->routerObj = new Cms_Router();
        $imp = $this->routerObj->setRouterFile(ROOT_PATH . '/app/'. $this->app .'/config/routing.yml')
                        ->setUri($this->request_uri)
                        ->setRoutes()
                        ->run();
        
        return $imp;
    }
    
    /*
     * Doctrine profiler
     */
    
    protected function dbProfile()
    {
        $i = 0;
        $time = 0;
        $ret = array();
        foreach ($this->doctrineProfiler as $event) {
            $time += $event->getElapsedSecs();
            if (in_array($event->getCode(), array(Doctrine_Event::CONN_QUERY, Doctrine_Event::CONN_EXEC, Doctrine_Event::STMT_EXECUTE))) {
                $params = $event->getParams();
                $query = preg_replace('/\b(UPDATE|SET|SELECT|FROM|AS|LIMIT|ASC|COUNT|DESC|WHERE|LEFT JOIN|INNER JOIN|RIGHT JOIN|ORDER BY|GROUP BY|IN|LIKE|DISTINCT|DELETE|INSERT|INTO|VALUES)\b/', '<span style="color:red">\\1</span>', htmlspecialchars($event->getQuery(), ENT_QUOTES, 'UTF-8'));
                foreach ($params as $param)
                {
                    $param = htmlspecialchars($param, ENT_QUOTES, 'UTF-8');
                    $query = join(var_export(is_scalar($param) ? $param : (string) $param, true), explode('?', $query, 2));
                }
                $ret[$i]['query'] = $query;
                $ret[$i]['time'] = number_format($event->getElapsedSecs(), 2);
                $i++;
            }
        }
        return $ret;
    }
}


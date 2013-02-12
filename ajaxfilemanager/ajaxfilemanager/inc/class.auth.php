<?php 
/**
 * the purpose I added this class is to make the file system much flexible 
 * for customization.
 * Actually,  this is a kind of interface and you should modify it to fit your system
 * @author Logan Cai (cailongqun [at] yahoo [dot] com [dot] cn)
 * @link www.phpletter.com
 * @since 4/August/2007
 */
	class Auth
	{
		var $__loginIndexInSession = 'ajax_user';
		var $userSession;
		var $user_data;

		function __construct()
		{
			
		}
		
		function Auth()
		{
			$this->__construct();
		}
		/**
		 * check if the user has logged
		 *
		 * @return boolean
		 */
		function isLoggedIn()
		{
                    //session_start();
			ini_set('include_path', 'D:\mprojects\campsite\lib');
			/*require_once('Zend/Loader/Autoloader.php');

			Zend_Loader_Autoloader::getInstance();

			/*$loader = new Zend_Loader_PluginLoader(array(
				'validators'  => 'validators'    
			));*/

			/*Zend_Session::setOptions(array('save_path' => 'D:\mprojects\campsite\tmp', 'remember_me_seconds' => 8600));
			Zend_Session::start();
                        */
			/**
			 * Bootstrap Doctrine.php, register autoloader specify
			 * configuration attributes and load models.
			 */

			require_once('Doctrine/Doctrine.php');
			spl_autoload_register(array('Doctrine', 'autoload'));
			$manager = Doctrine_Manager::getInstance();
			$conn = Doctrine_Manager::connection('mysql://root:12345@localhost/campsite');

			$profiler = new Doctrine_Connection_Profiler();
			$conn->setListener($profiler);

			$conn->setCharset('utf8');



			$manager->setAttribute(Doctrine_Core::ATTR_AUTO_ACCESSOR_OVERRIDE, true);
			//$manager->setAttribute(Doctrine_Core::ATTR_VALIDATE, Doctrine_Core::VALIDATE_ALL);
			Doctrine_Core::loadModels('../../models/generated');
			Doctrine_Core::loadModels('../../models');

			//$this->userSession = new Zend_Session_Namespace('userSession');
			
                        if ($_SESSION['user/userId'] == 0) {
				$this->user_data['logged_in'] = false;
				$this->user_data['username'] = 'Anonymous';
			} else {
				//Not anonymous
				$user = Doctrine_Core::getTable('User')->find($_SESSION['user/userId']/*, DOCTRINE::HYDRATE_ARRAY*/);
				if($user) {
					$_SESSION['user/userId'] = $_SESSION['user/userId'];
					$this->user_data['user_id'] = $_SESSION['user/userId'];
					$this->user_data['logged_in'] = true;
					$this->user_data['user'] = $user;
				} else {
					$_SESSION['user/userId'] = 0;
					$this->user_data['user_id'] = 0;
					$this->user_data['logged_in'] = false;
					$this->user_data['username'] = 'Anonymous';
				}
			}
			if($this->user_data['logged_in']) {
				if($this->user_data['user']->role <> 'ROLE_ADMIN' ) {
					die('You do not have access here!');
				}
			} else {
				die('Please first login!');
			}
			return true;
			//return (!empty($_SESSION[$this->__loginIndexInSession])?true:false);
		}
		/**
		 * validate the username & password
		 * @return boolean
		 *
		 */
		function login()
		{
			require_once('../../../bootstrap.php');
			if($_POST['username'] == CONFIG_LOGIN_USERNAME && $_POST['password'] == CONFIG_LOGIN_PASSWORD)
			{
				$_SESSION[$this->__loginIndexInSession] = true;
				return true;
			}else 
			{
				return false;
			}
		}
	}
?>
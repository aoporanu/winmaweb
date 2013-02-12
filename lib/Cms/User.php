<?php

class Cms_User extends Cms_Session
{
    protected $userRoles = false;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function isAuthenticated()
    {
        if(is_null($this->user)) {
            return false;
        }
        
        return true;
    }
    
    public function getUser() {
        if(is_null($this->user)) {
            return false;
        }
        
        return $this->user;
    }
    
    protected function getUserRolesFromDb() {
        if(is_null($this->user)) {
            return false;
        }
        
        $dbRoles = UserTable::getInstance()->getRoles(array('user_id' => $this->user->get('id')))->fetchArray();

        foreach($dbRoles as $role) {
            $this->userRoles[$role['id']] = strtolower($role['name']);
        }
    }
		
		public function getUserGroup() {
			if (is_null($this->user)) {
				return '';
			}
			return UserTable::getInstance()->getUserGroup($this->user->get('id'));
		}
    
    public function hasRole($role) {
        if(is_null($this->user)) {
            return false;
        }
        
        if(!$this->userRoles) {
            $this->getUserRolesFromDb();
        }

        if(is_array($this->userRoles)) {
            $role = strtolower($role);
            return in_array($role, $this->userRoles);
        }
        
        return false;
    }
    
    public function getUserRoles() {
        return $this->userRoles;
    }
}
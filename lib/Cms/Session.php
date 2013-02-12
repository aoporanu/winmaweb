<?php

class Cms_Session
{
    public $user = null;

    public function  __construct() {
        $this->init();
    }
    
    public function init() {
        $this->userSession = new Zend_Session_Namespace('userSession');
        if (!isset($this->userSession->initialized)) {
            $this->userSession->userId = 0;
            $this->userSession->initialized = true;
        }

        $this->_create($this->userSession->userId);
        
    }

    protected function _create($id) {
        /*
         * Anonymous user
         */
        if ($this->userSession->userId == 0) {
            $this->user = null;
        } else {
            //Not anonymous
            $this->user = Doctrine_Core::getTable('User')->find($id/*, DOCTRINE::HYDRATE_ARRAY*/);
            if($this->user) {
                $this->userSession->userId = $id;
            } else {
                $this->userSession->userId = 0;
                $this->user = null;
            }
        }
    }

    public function destroy() {
        zend_session::destroy(true);
    }
}

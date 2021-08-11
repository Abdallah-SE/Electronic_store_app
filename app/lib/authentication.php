<?php
namespace PHPMVC\LIB;

class Authentication {
    private static $_instance;
    private  $_session;
    
    /// url already avaiable for all user
    private $_defaultRoutes = [
        '/index/default',
        '/authorizing/logout',
        '/users/default',
        '/users/changepasswords',
        '/language/default',
        '/accessdenied/default'
    ];
    private function __construct($session) {
        $this->_session = $session;
    }  
    private function __clone() {
    }
    public static function getInstance(SessionManager $session){
        if(self::$_instance === NULL){
            self::$_instance = new self($session);
        }
        return self::$_instance;
    }
    public function checkAuthorized(){
        return (isset($this->_session->user));
    }
    public function checkForAccess($controller, $action){
        $url = strtolower('/'. $controller .'/' .$action);
        if(in_array($url, $this->_defaultRoutes) || in_array($url, $this->_session->user->privileges)){
            return TRUE;
        }
    }
}

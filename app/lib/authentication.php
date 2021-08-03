<?php
namespace PHPMVC\LIB;

class Authentication {
    private static $_instance;
    private  $_session;
    
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
}

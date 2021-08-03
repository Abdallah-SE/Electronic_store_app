<?php
namespace PHPMVC\LIB;
class Messenger {
    const SUCCESSFUL_MESSEEGE = 1;
    const ERROR_MESSEEGE = 2;
    const WARRING_MESSEEGE = 3;
    const INFO_MESSEEGE = 4;
    private  $_messages = [];
    private static $_instance;
    private $_session;
    
    public function __construct($session) {
        $this->_session = $session;
    }
    public function __clone() {}
    public static function getInstance(SessionManager $session){
        if(self::$_instance === NULL){
            self::$_instance = new self($session);
        }
        return self::$_instance;
    }
    public function add($message, $type =  self::SUCCESSFUL_MESSEEGE){
        if(!$this->checkMessegesExists()){
            $this->_session->messages = [];
        }           
        $messages_ = $this->_session->messages;
        $messages_ [] = [$message, $type];
        $this->_session->messages = $messages_;
        
    }
    private function checkMessegesExists(){
        return isset($this->_session->messages);
    }
    public function getMessages(){
        if($this->checkMessegesExists()){
            $this->_messages = $this->_session->messages;
            unset($this->_session->messages);
            return $this->_messages;
        }
        return [];
    }
}

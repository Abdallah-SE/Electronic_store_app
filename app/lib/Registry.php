<?php
namespace PHPMVC\LIB;
class Registry {
    private static $_instance;
    public function __construct() {}
    public function __clone() {}
    public static function getInstance(){
        if(self::$_instance === NULL){
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    public function __set($name, $_object) {
        $this->$name = $_object;
    }
    public function __get($name) {
        return $this->$name;
    }
}

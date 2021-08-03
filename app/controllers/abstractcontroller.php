<?php
namespace PHPMVC\Controllers;
use PHPMVC\LIB\Validate;
class AbstractController {
    use Validate;
    protected $_controller;
    protected $_action;
    protected $_params;
    protected $_template;
    protected $_registry;
    protected $_data = [];
    public function notFoundAction(){
        $this->_view();
    }
    public function setController($controllerName){
       $this->_controller = $controllerName;
    }
    public function setAction($actionName){
       $this->_action = $actionName;
    }
    public function setParams($params){
       $this->_params = $params;
    }
    public function setTemplate($template){
        $this->_template = $template;
    }  
    public function setRegistry($registry){
        $this->_registry = $registry;
    }
    public function __get($name){
        return $this->_registry->$name;
    }

    protected function _view(){
   
            $view = VIEWS_PATH .DS.  $this->_controller . DS . $this->_action . '.view.php';
            if($this->_action == \PHPMVC\LIB\FrontController::NOT_FOUND_ACTION || !file_exists($view)){
                $view = VIEWS_PATH .DS. 'notfound' . DS . 'notfound.view.php';
            }
                $this->_data =  array_merge($this->_data, $this->language->getListsOfWords());
                $this->_template->setRegistry($this->_registry);
                $this->_template->setActionViewPath($view);
                $this->_template->setData($this->_data);
                $this->_template->renderApp();
           
        
    }
    
}

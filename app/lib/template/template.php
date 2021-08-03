<?php
namespace PHPMVC\LIB\Template;
class Template {
    private $_templateParts;
    private $_action_view;
    public $_data;
    public $_registry;
    
    use TemplateHelper;
    
    public function __get($name) {
        return $this->_registry->$name;
    }

    public function __construct(array $parts) {
        $this->_templateParts = $parts;
                if(!empty($this->_data) &&  isset($this->_data)){
                    extract($this->_data);
                }
        
    }
    public function exchangeTemplate($template){
        $this->_templateParts['template'] = $template; 
    }

    public function setActionViewPath($action_view_path){
        $this->_action_view = $action_view_path;
    }
    public function setData($data){
        $this->_data = $data;
    }    
    public function setRegistry($registry){
        $this->_registry = $registry;
    }
    private  function renderHeaderStart(){
        if(!empty($this->_data) &&  isset($this->_data)){
                    extract($this->_data);
                }
        require_once TEMPLATE_PATH . 'headerstart.php';
    }
    private  function renderHeaderEnd(){
        if(!empty($this->_data) &&  isset($this->_data)){
                    extract($this->_data);
                }
        require_once TEMPLATE_PATH . 'headerend.php';
    }
    private  function renderFooter(){
        if(!empty($this->_data) &&  isset($this->_data)){
                    extract($this->_data);
                }
        require_once  TEMPLATE_PATH . 'footer.php';
    }
    private function renderTemplateParts()
    {
        if(!array_key_exists('template', $this->_templateParts)){
            trigger_error('Error in template parts including???', E_USER_WARNING);
        }  else {
            $parts = $this->_templateParts['template'];
            if(!empty($parts)){
                if(!empty($this->_data) &&  isset($this->_data)){
                    extract($this->_data);
                }                foreach ($parts as $part =>$file) {
                    if($part == ':view'){
                        require_once $this->_action_view;
                    }  else {
                        require_once $file;
                    }
                }
            }
        }
    }
    
    private function renderHeaderResources(){
        $output = '';
        if(!array_key_exists('header_resources', $this->_templateParts)){
            trigger_error('Error in define resources in the header', E_USER_DEPRECATED);
        }  else {
            $resources = $this->_templateParts['header_resources'];
            // CSS files
            $CSS = $resources['css'];
            if(!empty($CSS)){
                foreach ($CSS as $key => $pathValue) {
                    $output .= '<link rel="stylesheet" type="text/css" href="'.$pathValue.'">';
                }
            }
            // JS files
            $JS = $resources['js'];
            if(!empty($JS)){
                foreach ($JS as $key => $pathValue) {
                    $output .='<script src = "'.$pathValue.'">'.'</script>';
                }          
            }
        }
        echo $output;
    }
    private function renderFooterResources(){
        $output = '';
        if(!array_key_exists('footer_resources', $this->_templateParts)){
            trigger_error('Error in define resources in the footer', E_USER_DEPRECATED);
        }  else {
            $footer_resources = $this->_templateParts['footer_resources'];
            if(!empty($footer_resources)){
                foreach ($footer_resources as $key => $pathValue) {
                    $output .='<script src = "'.$pathValue.'">'.'</script>';
                } 
            }
        }
        echo $output;
    }

    
    public function renderApp(){
        $this->renderHeaderStart();
        $this->renderHeaderEnd();
        $this->renderTemplateParts();
        $this->renderHeaderResources();
        $this->renderFooterResources();
        $this->renderFooter();
    }
}

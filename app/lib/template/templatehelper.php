<?php
namespace PHPMVC\LIB\Template;
trait TemplateHelper {
    public function matchUrl($url){
        return (parse_url($_SERVER['REQUEST_URI'],  PHP_URL_PATH) === $url);
    }
    public function displayValue($fieldName, $object = NULL){
        return (isset($_POST[$fieldName])? $_POST[$fieldName] : (is_null($object)? '' : $object->$fieldName));
    }   
    public function displaySelected($fieldName, $value, $object = NULL){
        return ((isset($_POST[$fieldName]) && $_POST[$fieldName] == $value)  || (!is_null($object) && $object->$fieldName == $value))? 'selected="selected"': '';
    }
}

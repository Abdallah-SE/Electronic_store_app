<?php
namespace PHPMVC\LIB;
trait InputFilter{
    public function filterInt($_input){
        return filter_var($_input, FILTER_SANITIZE_NUMBER_INT);
    }
    public function filterFloat($_input){
        return filter_var($_input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    } 
    public function filterStr($_input){
        return htmlentities(strip_tags($_input), ENT_QUOTES, 'UTF-8');
    }   
}
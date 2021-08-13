<?php
namespace PHPMVC\LIB;

trait Validate{
    
    private $_dataTypes = [
       'num'           => '/^[0-9]+(?:\.[0-9]+)?$/',
       'float'         => '/^[0-9]+\.[0-9]+$/',
       'int'           => '/^[0-9]+$/',
       'alpha'         => '/^[a-zA-Z\p{Arabic} ]+$/u',
       'alphanum'         => '/^[a-zA-Z\p{Arabic}0-9 ]+$/u',
       'vDate'         =>'^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[13-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$',
        'vURL'         => '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
        'vEmail'         => '/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'
       ];
    
    // check for non empty field
    public function req($var){
        return '' !=$var || !empty($var);
       }
       public function num($subject){
       return (bool) preg_match($this->_dataTypes['num'], $subject);
   } 
   public function float($subject){
       return (bool) preg_match($this->_dataTypes['float'], $subject);
   }   
   public function int($subject){
       return (bool) preg_match($this->_dataTypes['int'], $subject);
   }   
   public function alpha($subject){
       return (bool) preg_match($this->_dataTypes['alpha'], $subject);
   } 
   public function alphanum($subject){
       return (bool) preg_match($this->_dataTypes['alphanum'], $subject);
   }
   public function eq($var, $equalValue){
       return $var == $equalValue;
   }  
   public function equal_field($var, $sameValue){
       return $var == $sameValue;
   }
   public function lessThan($var, $equalValue){
       if(is_string($var)){
           return mb_strlen($var) < $equalValue;
       }elseif (is_numeric($var)) {
           return $var < $equalValue;
        }
   }
   public function greaterThan($var, $equalValue){
       if(is_string($var)){
           return mb_strlen($var) < $equalValue;
       }elseif (is_numeric($var)) {
            return $var < $equalValue;
        }
   }  
   public function min($var, $minOrEqual){
       if(is_string($var)){
           return mb_strlen($var) >= $minOrEqual;
       }elseif(is_numeric($var)){
           return $var >= $minOrEqual;
       }
   }  
   public function max($var, $maxOrEqual){
       if(is_string($var)){
           return mb_strlen($var) <= $maxOrEqual;
       }elseif (is_numeric($var)) {
            return $var <= $maxOrEqual;
        }
   }  
   public function between($var, $min, $max){  
       if(is_string($var)){
           return mb_strlen($var) <= $max && mb_strlen($var) >= $min;
       }elseif(is_numeric($var)){
           return $var <= $max && $var >= $min;
       }
   }
   public function floatMatch($float, $numBefore, $numAfter){
       if(!($this->float($float))){
           return FALSE;
       }
       $pattern = '/^[0-9]{'.$numBefore.'}\.[0-9]{'.$numAfter.'}$/';
       return (bool) preg_match($pattern, $float);
   }
    public function vDate($subject){
       return (bool) preg_match($this->_dataTypes['vDate'], $subject);
   }    
   public function vURL($subject){
       return (bool) preg_match($this->_dataTypes['vURL'], $subject);
   }  
   public function vEmail($subject){
       return (bool) preg_match($this->_dataTypes['vEmail'], $subject);
   }
   public function isValidInput($rules, $type){
       $errors = [];
       if(!empty($rules)){
           foreach ($rules as $key => $value) {
               $inputValue = $type[$key];
               $takeRules = explode('|', $value);
               foreach ($takeRules as $takeRule){
                   if(array_key_exists($key, $errors))
                           continue;
                   if(preg_match_all('/(min)\((\d+)\)/', $takeRule, $match)){
                       if($this->min($inputValue, $match[2][0]) === FALSE){
                           $this->messeger->add($this->language->prepareKey('text_error_'.$match[1][0] , [$this->language->get('text_label_'.$key), $match[2][0]]), 
                                   Messenger::ERROR_MESSEEGE);
                           $errors[$key] = TRUE;
                       }
                   } 
                   elseif(preg_match_all('/(max)\((\d+)\)/', $takeRule, $match)){
                       if($this->max($inputValue, $match[2][0]) === FALSE){
                           $this->messeger->add($this->language->prepareKey('text_error_'.$match[1][0] , [$this->language->get('text_label_'.$key), $match[2][0]]), 
                                   Messenger::ERROR_MESSEEGE);
                           $errors[$key] = TRUE;
                       }
                   }  
                   elseif(preg_match_all('/(lessThan)\((\d+)\)/', $takeRule, $match)){
                       if($this->lessThan($inputValue, $match[2][0]) === FALSE){
                           $this->messeger->add($this->language->prepareKey('text_error_'.$match[1][0] , [$this->language->get('text_label_'.$key), $match[2][0]]), 
                                   Messenger::ERROR_MESSEEGE);
                           $errors[$key] = TRUE;
                       }
                   }                  
                   elseif(preg_match_all('/(greaterThan)\((\d+)\)/', $takeRule, $match)){
                       if($this->greaterThan($inputValue, $match[2][0]) === FALSE){
                           $this->messeger->add($this->language->prepareKey('text_error_'.$match[1][0] , [$this->language->get('text_label_'.$key), $match[2][0]]), 
                                   Messenger::ERROR_MESSEEGE);
                           $errors[$key] = TRUE;
                       }
                   }    
                   elseif(preg_match_all('/(between)\((\d+),(\d+)\)/', $takeRule, $match)){
                      if($this->between($inputValue, $match[2][0], $match[3][0]) === FALSE){
                          $this->messeger->add($this->language->prepareKey('text_error_'.$match[1][0] , [$this->language->get('text_label_'.$key), $match[2][0], $match[3][0]]), 
                                Messenger::ERROR_MESSEEGE);
                          $errors[$key] = TRUE;
                       }
                   }elseif(preg_match_all('/(floatMatch)\((\d+),(\d+)\)/', $takeRule, $match)){
                      if($this->floatMatch($inputValue, $match[2][0], $match[3][0]) === FALSE){
                          $this->messeger->add($this->language->prepareKey('text_error_'.$match[1][0] , [$this->language->get('text_label_'.$key), $match[2][0], $match[3][0]]), 
                                Messenger::ERROR_MESSEEGE);
                          $errors[$key] = TRUE;
                       }
                   }elseif(preg_match_all('/(eq)\((\w+)\)/', $takeRule, $match)){
                       if($this->eq($inputValue, $match[2][0]) === FALSE){
                           $this->messeger->add($this->language->prepareKey('text_error_'.$match[1][0] , [$this->language->get('text_label_'.$key), $match[2][0]]), 
                                   Messenger::ERROR_MESSEEGE);
                           $errors[$key] = TRUE;
                       }
                   }elseif(preg_match_all('/(equal_field)\((\w+)\)/', $takeRule, $match)){
                       $valueCompare = $type[$match[2][0]];
                       if($this->equal_field($inputValue, $valueCompare) === FALSE){
                           $this->messeger->add($this->language->prepareKey('text_error_'.$match[1][0], [$this->language->get('text_label_'.$key), $this->language->get('text_label_'.$match[2][0])]),
                                   Messenger::ERROR_MESSEEGE);
                           $errors[$key] = TRUE;
                       }
                   }  
                   else {
                       if($this->$takeRule($inputValue) === FALSE){
                       $this->messeger->add($this->language->get('text_error_'.$takeRule , [$this->language->get('text_label_'.$key)]), 
                                Messenger::ERROR_MESSEEGE);
                       $errors[$key] = true;
                       }
                       }
               }
           }
       }
       return empty($errors)? TRUE: FALSE;
   }
   
}
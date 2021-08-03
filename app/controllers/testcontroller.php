<?php
namespace PHPMVC\Controllers;
use PHPMVC\LIB\Validate;
class UsersGroupsController extends AbstractController {
    use Validate;
    public function defaultAction(){
       echo  var_dump($this->num(2));
    }    
}

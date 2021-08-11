<?php
namespace PHPMVC\Controllers;

class AccessDeniedController extends AbstractController
{
    public function defaultAction(){
        $this->language->load('template.common');
        return $this->_view();
    }
}

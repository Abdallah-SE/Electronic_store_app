<?php
namespace PHPMVC\Controllers;
class IndexController extends AbstractController
{
    public function defaultAction(){
        $this->language->load('template.common');
        $this->_view();
    }
    public function addAction(){
        $this->_view();
    }
}

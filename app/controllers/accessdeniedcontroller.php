<?php
namespace PHPMVC\Controllers;

class NotFoundController extends AbstractController
{
    public function notFoundAction(){
        $this->language->load('template.common');
        return $this->_view();
    }
}

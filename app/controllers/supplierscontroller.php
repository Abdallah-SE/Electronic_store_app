<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\SupplierModel;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Helper;
use PHPMVC\lib\Messenger;
class SuppliersController extends AbstractController {
    private $_createRules = [
        'Name'           => 'req|alphanum|between(5,40)',
        'PhoneNumber'    => 'req|alphanum|max(15)',
        'Email'          => 'req|vEmail',
        'Address'        => 'req|alphanum|max(50)'
    ];  

    use InputFilter;
    use Helper;
    public function defaultAction(){
        $this->language->load('template.common');
        $this->language->load('suppliers.default');
       $this->_data['suppliers'] = SupplierModel::getAll();
       return $this->_view();
    }
    
    public function createAction(){
        $this->language->load('template.common');
        $this->language->load('suppliers.create');
        $this->language->load('suppliers.labels');
        $this->language->load('validation.errors');
        $this->language->load('suppliers.messages');
        
        if(isset($_POST['submit']) && $this->isValidInput($this->_createRules, $_POST)){
            $user_obj = new SupplierModel();
            $user_obj->Name = $this->filterStr($_POST['Name']);
            $user_obj->PhoneNumber = $this->filterStr($_POST['PhoneNumber']);
            $user_obj->Email = $this->filterStr($_POST['Email']);
            $user_obj->Address = $this->filterStr($_POST['Address']);
            
            if($user_obj->save()){
                $this->messeger->add($this->language->get('message_create_success'));
                $this->redirect('/suppliers');
            }  else {
                $this->messeger->add($this->language->get('message_create_failed'), Messenger::ERROR_MESSEEGE);
             }
        }
        return $this->_view();
    }  
    public function editAction(){
        $this->language->load('template.common');
        $this->language->load('suppliers.edit');
        $this->language->load('suppliers.labels');
        $this->language->load('validation.errors');
        $this->language->load('suppliers.messages');
        // get  the id of selected user to edit 
        $id = $this->filterInt($this->_params[0]);
        $user = SupplierModel::getByPK($id);
        // wrong supplier
        if($user === FALSE){
            $this->redirect('/suppliers');
        }
        // send supplier data that have been editing
        $this->_data['supplier'] = $user;
        
        if(isset($_POST['submit']) && $this->isValidInput($this->_createRules, $_POST)){
            $user->Name = $this->filterStr($_POST['Name']);
            $user->PhoneNumber = $this->filterStr($_POST['PhoneNumber']);
            $user->Email = $this->filterStr($_POST['Email']);
            $user->Address = $this->filterStr($_POST['Address']);
            // check if the editing be done
            if($user->save()){
                $this->messeger->add($this->language->get('message_create_success'));
                $this->redirect('/suppliers');
            }  else {
                $this->messeger->add($this->language->get('message_create_failed'), Messenger::ERROR_MESSEEGE);
             }
        }
        return $this->_view();
    }     
    public function deleteAction(){
        // get  the id of selected user to edit 
        $id = $this->filterInt($this->_params[0]);
        $supplier = SupplierModel::getByPK($id);
        
        if($supplier === FALSE){
        $this->redirect('/suppliers');
        }
        $this->language->load('suppliers.messages');
        if($supplier ->delete()){
            $this->messeger->add($this->language->get('message_delete_success'));
            $this->redirect('/suppliers');
        }else {
            $this->messeger->add($this->language->get('message_delete_failed'), Messenger::ERROR_MESSEEGE);
            $this->redirect('/suppliers');
        }
    }  
  
}

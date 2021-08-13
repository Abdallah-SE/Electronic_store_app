<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\ClientModel;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Helper;
use PHPMVC\lib\Messenger;
class ClientsController extends AbstractController {
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
        $this->language->load('clients.default');
       $this->_data['clients'] = ClientModel::getAll();
       return $this->_view();
    }
    
    public function createAction(){
        $this->language->load('template.common');
        $this->language->load('clients.create');
        $this->language->load('clients.labels');
        $this->language->load('validation.errors');
        $this->language->load('clients.messages');
        
        if(isset($_POST['submit']) && $this->isValidInput($this->_createRules, $_POST)){
            $client_obj = new ClientModel();
            $client_obj->Name = $this->filterStr($_POST['Name']);
            $client_obj->PhoneNumber = $this->filterStr($_POST['PhoneNumber']);
            $client_obj->Email = $this->filterStr($_POST['Email']);
            $client_obj->Address = $this->filterStr($_POST['Address']);
            
            if($client_obj->save()){
                $this->messeger->add($this->language->get('message_create_success'));
                $this->redirect('/clients');
            }  else {
                $this->messeger->add($this->language->get('message_create_failed'), Messenger::ERROR_MESSEEGE);
             }
        }
        return $this->_view();
    }  
    public function editAction(){
        $this->language->load('template.common');
        $this->language->load('clients.edit');
        $this->language->load('clients.labels');
        $this->language->load('validation.errors');
        $this->language->load('clients.messages');
        // get  the id of selected user to edit 
        $id = $this->filterInt($this->_params[0]);
        $client = ClientModel::getByPK($id);
        // wrong supplier
        if($client === FALSE){
            $this->redirect('/clients');
        }
        // send supplier data that have been editing
        $this->_data['client'] = $client;
        
        if(isset($_POST['submit']) && $this->isValidInput($this->_createRules, $_POST)){
            $client->Name = $this->filterStr($_POST['Name']);
            $client->PhoneNumber = $this->filterStr($_POST['PhoneNumber']);
            $client->Email = $this->filterStr($_POST['Email']);
            $client->Address = $this->filterStr($_POST['Address']);
            // check if the editing be done
            if($client->save()){
                $this->messeger->add($this->language->get('message_create_success'));
                $this->redirect('/clients');
            }  else {
                $this->messeger->add($this->language->get('message_create_failed'), Messenger::ERROR_MESSEEGE);
             }
        }
        return $this->_view();
    }     
    public function deleteAction(){
        // get  the id of selected user to edit 
        $id = $this->filterInt($this->_params[0]);
        $client = ClientModel::getByPK($id);
        
        if($client === FALSE){
        $this->redirect('/clients');
        }
        $this->language->load('clients.messages');
        if($client ->delete()){
            $this->messeger->add($this->language->get('message_delete_success'));
            $this->redirect('/clients');
        }else {
            $this->messeger->add($this->language->get('message_delete_failed'), Messenger::ERROR_MESSEEGE);
            $this->redirect('/clients');
        }
    }  
  
}

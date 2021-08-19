<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\UserModel;
use PHPMVC\Models\CategoryModel;
use PHPMVC\Models\ProductModel;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Helper;
use PHPMVC\lib\Messenger;
class ProductsController extends AbstractController {
    private $_createRules = [
        'CategoryID'       => 'req|num',
        'Name'             => 'req|alphanum|between(3,50)',
        'Quantity'         => 'req|num',
        'BuyPrice'         => 'req|num',
        'SellPrice'        => 'req|num',
        'Unit'             => 'req|num'
    ];  

    use InputFilter;
    use Helper;
    
    public function defaultAction(){
        $this->language->load('template.common');
        $this->language->load('products.default');
        $this->_data['products'] = ProductModel::getProducts();
        return $this->_view();
    }
    
    // create a new user
    public function createAction(){
        $this->language->load('template.common');
        $this->language->load('products.create');
        $this->language->load('products.labels');
        $this->language->load('products.units');
        $this->language->load('validation.errors');
        $this->language->load('products.messages');
        // send the
        $this->_data['categories'] = CategoryModel::getAll();
        
        if(isset($_POST['submit']) && $this->isValidInput($this->_createRules, $_POST)){
            
            $product = new ProductModel();
            $product->CategoryID = $this->filterInt($_POST['CategoryID']);
            $product->Name = $this->filterStr($_POST['Name']);
            $product->SellPrice = $this->filterStr($_POST['SellPrice']);
            $product->BuyPrice = $this->filterStr($_POST['BuyPrice']);
            $product->Quantity = $this->filterInt($_POST['Quantity']);
            $product->Unit = $this->filterInt($_POST['Unit']);
            if(!empty($_FILES['Image']['name'])){
                $upload_ob = new UploadHandler($_FILES['Image']);
                try {
                    $upload_ob->uploadFile();
                    $product->Image = $upload_ob->getFile();
                } catch (\Exception $exc) {
                    $this->messeger->add($exc->getMessage(), Messenger::ERROR_MESSEEGE);
                    $uploadError = TRUE;
                }
                 }
            if($uploadError === FALSE && $product->save()){
                $this->messeger->add($this->language->get('message_create_success'));
                $this->redirect('/products');
            }  else {
                $this->messeger->add($this->language->get('message_create_failed'), Messenger::ERROR_MESSEEGE);
             }
        }
        return $this->_view();
    }  
    // edit an existing user data
    public function editAction(){
        $this->language->load('template.common');
        $this->language->load('users.edit');
        $this->language->load('users.labels');
        $this->language->load('validation.errors');
        $this->language->load('users.messages');
        // get  the id of selected user to edit 
        $id = $this->filterInt($this->_params[0]);
        $user = UserModel::getByPK($id);
        // check for if the user exists or trying the user who already login to edit himself
        if($user === FALSE || $this->session->user->UserID == $id){
            $this->redirect('/users');
        }
        $this->_data['user'] = $user;
        $this->_data['groups'] = UserGroupModel::getAll();
        if(isset($_POST['submit']) && $this->isValidInput($this->_editRules, $_POST)){
            $user->PhoneNumber = $this->filterStr($_POST['phone']);
            $user->GroupID = $this->filterStr($_POST['GroupID']);
            if($user->save()){
                $this->messeger->add($this->language->get('message_create_success'));
                $this->redirect('/users');
            }  else {
                $this->messeger->add($this->language->get('message_create_failed'), Messenger::ERROR_MESSEEGE);
             }
        }
        return $this->_view();
    }     
    // selected user to be deleted
    public function deleteAction(){
        $this->language->load('users.messages');
        // get  the id of selected user to edit 
        $id = $this->filterInt($this->_params[0]);
        $user = UserModel::getByPK($id);
        
        if($user === FALSE || $this->session->user->UserID == $id){
        $this->messeger->add($this->language->get('message_delete_failed'), Messenger::ERROR_MESSEEGE);
        $this->redirect('/users');
        }
        $this->language->load('users.messages');
        if($user->delete()){
            $this->messeger->add($this->language->get('message_delete_success'));
            $this->redirect('/users');
        }else {
            $this->messeger->add($this->language->get('message_delete_failed'), Messenger::ERROR_MESSEEGE);
            $this->redirect('/users');
        }
    }  
   
    public function userExistsAjaxAction(){
        if(isset($_POST['userName'])){
            header('Content-type: text/plain');
            if(UserModel::userExists($this->filterStr($_POST['userName'])) !== false){
                echo 1;
            }  else {
                echo 0;
            }
        }
    }
    
}

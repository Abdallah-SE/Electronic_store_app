<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\UserModel;
use PHPMVC\Models\UserGroupModel;
use PHPMVC\Models\UserProfileModel;
use PHPMVC\Models\CategoryModel;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\UploadHandler;
use PHPMVC\LIB\Helper;
use PHPMVC\lib\Messenger;
class CategoriesController extends AbstractController {
    private $_createRules = [
        'Name'         => 'req|alphanum|between(3,30)'
        ];  

    use InputFilter;
    use Helper;
    public function defaultAction(){
        $this->language->load('template.common');
        $this->language->load('categories.default');
       $this->_data['categories'] = CategoryModel::getAll();
       return $this->_view();
    }
    
    // create a new category
    public function createAction(){
        $this->language->load('template.common');
        $this->language->load('categories.create');
        $this->language->load('categories.labels');
        $this->language->load('validation.errors');
        $this->language->load('categories.messages');
        // TODO search for good solution for secure and check file type
        if(isset($_POST['submit']) && $this->isValidInput($this->_createRules, $_POST)){
            $category = new CategoryModel();
            $category->Name = $this->filterStr($_POST['Name']);
            $category->Image = (new UploadHandler($_FILES['Image']))->uploadFile()->getFile();
            if($category->save()){
                $this->messeger->add($this->language->get('message_create_success'));
                $this->redirect('/categories');
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
        $category = CategoryModel::getByPK($id);
        // check for if the user exists or trying the user who already login to edit himself
        if($category === FALSE || $this->session->user->UserID == $id){
            $this->redirect('/users');
        }
        $this->_data['user'] = $category;
        $this->_data['groups'] = UserGroupModel::getAll();
        if(isset($_POST['submit']) && $this->isValidInput($this->_editRules, $_POST)){
            $category->PhoneNumber = $this->filterStr($_POST['phone']);
            $category->GroupID = $this->filterStr($_POST['GroupID']);
            if($category->save()){
                $this->messeger->add($this->language->get('message_create_success'));
                $this->redirect('/categories');
            }  else {
                $this->messeger->add($this->language->get('message_create_failed'), Messenger::ERROR_MESSEEGE);
             }
        }
        return $this->_view();
    }     
    // selected user to be deleted
    public function deleteAction(){
        $this->language->load('categories.messages');
        // get  the id of selected user to edit 
        $id = $this->filterInt($this->_params[0]);
        $user = UserModel::getByPK($id);
        
        if($user === FALSE || $this->session->user->UserID == $id){
        $this->messeger->add($this->language->get('message_delete_failed'), Messenger::ERROR_MESSEEGE);
        $this->redirect('/categories');
        }
        $this->language->load('users.messages');
        if($user->delete()){
            $this->messeger->add($this->language->get('message_delete_success'));
            $this->redirect('/categories');
        }else {
            $this->messeger->add($this->language->get('message_delete_failed'), Messenger::ERROR_MESSEEGE);
            $this->redirect('/categories');
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

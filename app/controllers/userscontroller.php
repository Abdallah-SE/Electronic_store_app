<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\UserModel;
use PHPMVC\Models\UserGroupModel;
use PHPMVC\Models\UserProfileModel;
use PHPMVC\Models\UserGroupPrivilegeModel;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Helper;
use PHPMVC\lib\Messenger;
class UsersController extends AbstractController {
    private $_createRules = [
        'firstName'        => 'req|alpha|between(3,10)',
        'secondName'        => 'req|alpha|between(3,10)',
        'userName'        => 'req|alphanum|between(3,15)',
        'password'        => 'req|min(6)|equal_field(cPassword)',
        'cPassword'       => 'req|min(6)',
        'email'           => 'req|vEmail|equal_field(cEmail)',
        'cEmail'          => 'req|vEmail',
        'phone'           => 'alphanum|max(15)',
        'GroupID'           => 'req|int'
    ];  
    private $_editRules = [
        'phone'           => 'alphanum|max(15)',
        'GroupID'           => 'req|int'
    ];
    use InputFilter;
    use Helper;
    public function defaultAction(){
        $this->language->load('template.common');
        $this->language->load('users.default');
       $this->_data['users'] = UserModel::getUsers($this->session->user);
       return $this->_view();
    }
    
    // create a new user
    public function createAction(){
        $this->language->load('template.common');
        $this->language->load('users.create');
        $this->language->load('users.labels');
        $this->language->load('validation.errors');
        $this->language->load('users.messages');
        $this->_data['groups'] = UserGroupModel::getAll();
        if(isset($_POST['submit']) && $this->isValidInput($this->_createRules, $_POST)){
            $user_obj = new UserModel();
            $user_obj->Username = $this->filterStr($_POST['userName']);
            $user_obj->encryptPassword($_POST['password']);
            $user_obj->Email = $this->filterStr($_POST['email']);
            $user_obj->PhoneNumber = $this->filterStr($_POST['phone']);
            $user_obj->GroupID = $this->filterStr($_POST['GroupID']);
            $user_obj->SubscriptionDate = date('y-m-d H:I:S');
            $user_obj->LastLogin = date('y-m-d H:I:S');
            $user_obj->Status = 1;
            if(UserModel::userExists($user_obj->Username)){
                $this->messeger->add($this->language->get('message_user_exists_failed'), Messenger::ERROR_MESSEEGE);
                $this->redirect('/users/create');
            }
            // TODO:: task to  handle WELCOME EMAIL to new user
            if($user_obj->save()){
                $newUserProfile = new UserProfileModel();
                $newUserProfile->UserID = $user_obj->UserID;
                $newUserProfile->FirstName = $this->filterStr($_POST['firstName']);
                $newUserProfile->LastName = $this->filterStr($_POST['secondName']);
                $newUserProfile->save(FALSE);
                $this->messeger->add($this->language->get('message_create_success'));
                $this->redirect('/users');
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

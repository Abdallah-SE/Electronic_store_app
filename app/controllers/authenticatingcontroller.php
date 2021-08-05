<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\UserModel;
use PHPMVC\LIB\Messenger;
use PHPMVC\LIB\Helper;
class AuthenticatingController extends AbstractController{
    use Helper;
    public function loginAction(){
        $this->language->load('Authenticating.login');
        // fun for swapp the unwanted templates
        $this->_template->exchangeTemplate(
                [
                    ':view' => ':action_view'
                ]
                );
        // if the user submit the login of the form
        if(isset($_POST['login'])){
            $_user = UserModel::authenticatingUser($_POST['ucname'], $_POST['ucpwd'], $this->session); 
                    if($_user == 1){
            $this->messeger->add($this->language->get('message_login_success'));
            $this->redirect('/');
        }  elseif ($_user == 2) {
            $this->messeger->add($this->language->get('message_login_user_disable'), Messenger::ERROR_MESSEEGE);
        }  elseif($_user === FALSE) {
            $this->messeger->add($this->language->get('message_login_failed'), Messenger::ERROR_MESSEEGE);
        }
        }
        $this->_view();
    }
    public function logoutAction(){
        $this->session->kill();
        $this->redirect('/');
    }
}
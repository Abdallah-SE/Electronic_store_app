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
        'Name'         => 'req|alphanum|between(3,35)'
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
        $uploadError = FALSE;
        // TODO search for good solution for secure and check file type
        if(isset($_POST['submit']) && $this->isValidInput($this->_createRules, $_POST)){
            $category = new CategoryModel();
            $category->Name = $this->filterStr($_POST['Name']);
            if(!empty($_FILES['Image']['name'])){
                $upload_ob = new UploadHandler($_FILES['Image']);
                try {
                    $upload_ob->uploadFile();
                    $category->Image = $upload_ob->getFile();
                } catch (\Exception $exc) {
                    $this->messeger->add($exc->getMessage(), Messenger::ERROR_MESSEEGE);
                    $uploadError = TRUE;
                }
                        }
            if($uploadError === FALSE && $category->save()){
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
        $this->language->load('categories.edit');
        $this->language->load('categories.labels');
        $this->language->load('validation.errors');
        $this->language->load('categories.messages');
        $uploadError = FALSE;
        // get  the id of selected category to edit 
        $id = $this->filterInt($this->_params[0]);
        $category = CategoryModel::getByPK($id);
        // check for if the category exists or trying the user who already login to edit himself
        if($category === FALSE){
            $this->redirect('/categories');
        }
        $this->_data['category'] = $category;
        if(isset($_POST['submit']) && $this->isValidInput($this->_createRules, $_POST)){
            $category->Name = $this->filterStr($_POST['Name']);
            // check if the image is ste or not or it's empty
            if((!empty($_FILES['Image']['name']))){
                // remove the current image
                if($category->Image !=='' && (file_exists(UPLOAD_MEMORY_IMG. DS .$category->Image)) && is_writable(UPLOAD_MEMORY_IMG)){
                    unlink(UPLOAD_MEMORY_IMG. DS .$category->Image);
                }
                $upload_ob = new UploadHandler($_FILES['Image']);
                try {
                    $upload_ob->uploadFile();
                    $category->Image = $upload_ob->getFile();
                } catch (\Exception $exc) {
                    $this->messeger->add($exc->getMessage(), Messenger::ERROR_MESSEEGE);
                    $uploadError = TRUE;
                }
            }
            if($uploadError === FALSE && $category->save()){
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
        // get  the id of selected category to edit 
        $id = $this->filterInt($this->_params[0]);
        $category = CategoryModel::getByPK($id);
        
        if($category === FALSE){
        $this->messeger->add($this->language->get('message_delete_failed'), Messenger::ERROR_MESSEEGE);
        $this->redirect('/categories');
        }
        if($category->delete()){
            // remove the current image
            if($category->Image !=='' && (file_exists(UPLOAD_MEMORY_IMG. DS .$category->Image)) && is_writable(UPLOAD_MEMORY_IMG)){
                unlink(UPLOAD_MEMORY_IMG.DS.$category->Image);
            }
            $this->messeger->add($this->language->get('message_delete_success'));
            $this->redirect('/categories');
        }else {
            $this->messeger->add($this->language->get('message_delete_failed'), Messenger::ERROR_MESSEEGE);
        }
        $this->redirect('/categories');
    }  
}

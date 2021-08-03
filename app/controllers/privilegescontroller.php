<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\UserPrivilegeModel;
use PHPMVC\Models\UserGroupPrivilegeModel;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Helper;

class PrivilegesController extends AbstractController {
    use InputFilter;
    use Helper;
    public function defaultAction(){
        $this->language->load('template.common');
        $this->language->load('usersprivileges.default');
        $this->_data['privileges'] = UserPrivilegeModel::getAll();
        return $this->_view();
    }   
    public function createAction(){
        $this->language->load('template.common');
        $this->language->load('usersprivileges.labels');
        $this->language->load('usersprivileges.create');
        
        if(isset($_POST['submit'])){
            $privilege = new UserPrivilegeModel();
            $privilege->PrivilegeTitle = $this->filterStr($_POST['PrivilegeTitle']);
            $privilege->Privilege = $this->filterStr($_POST['Privilege']);
            //check if the save operation is successfully happended 
            if($privilege->save()){
                $this->messeger->add('تم حفظ الصلاحيه بشكل صحيح.');
                $this->redirect('/privileges');
            }
        }
        return $this->_view();
    }  
    // TODO 1 save the data be sent by csrf protection
    public function editAction(){
        $this->language->load('template.common');
        $this->language->load('usersprivileges.labels');
        $this->language->load('usersprivileges.edit');
        // get the data of the edited privilege
        $pk = $this->filterInt($this->_params[0]);
        $privilege = UserPrivilegeModel::getByPK($pk);
        // check if the id is correct
        if($privilege === FALSE){
            $this->redirect('/privileges');
        }
        // fech the data to the editting form
        $this->_data['privilege'] = $privilege;
        if(isset($_POST['submit'])){
            $privilege->PrivilegeTitle = $this->filterStr($_POST['PrivilegeTitle']);
            $privilege->Privilege = $this->filterStr($_POST['Privilege']);
            //check if the save operation is successfully happended 
            if($privilege->save()){
                $this->redirect('/privileges');
            }
        }
        return $this->_view();
    }      
    public function deleteAction(){
        // get the deleted privilege by id
        $pk = $this->filterInt($this->_params[0]);
        $privilege = UserPrivilegeModel::getByPK($pk);
        // check if the id is correct
        if($privilege === FALSE){
            $this->redirect('/privileges');
        }
        $groupPrivileges = UserGroupPrivilegeModel::getBy(['PrivilegeID' => $privilege->PrivilegeID]);
        if(FALSE !== $groupPrivileges){
            foreach ($groupPrivileges as $value) {
                $value->delete();
            }
        }
        //check if the delete operation is successfully happended 
        if($privilege->delete()){
            $this->redirect('/privileges');
        }
    }   
}

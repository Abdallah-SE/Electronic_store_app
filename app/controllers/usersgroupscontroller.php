<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\UserGroupModel;
use PHPMVC\Models\UserPrivilegeModel;
use PHPMVC\Models\UserGroupPrivilegeModel;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Helper;
class UsersGroupsController extends AbstractController {
    
    use InputFilter;
    use Helper;
    public function defaultAction(){
        $this->language->load('template.common');
        $this->language->load('usersgroups.default');
        $this->_data['groups'] = UserGroupModel::getAll();
        return $this->_view();
    }   
    public function createAction(){
        $this->language->load('template.common');
        $this->language->load('usersgroups.create');
        $this->language->load('usersgroups.labels');
        // get privileges of the group
        $this->_data['privileges'] = UserPrivilegeModel:: getAll();
        
        if(isset($_POST['submit'])){
            $group = new UserGroupModel();
            $group->GroupName = $this->filterStr($_POST['GroupName']);
            if($group->save()){
                if( isset($_POST['privileges']) && is_array($_POST['privileges']) ){
                    foreach ($_POST['privileges'] as $privilegeId){
                        $groupPrivilege = new UserGroupPrivilegeModel();
                        $groupPrivilege->GroupID = $group->GroupID;
                        $groupPrivilege->PrivilegeID = $privilegeId;
                        $groupPrivilege->save();
                    }
                }
            }
            $this->redirect('/usersgroups');
        }
        return $this->_view();
    }  
    
    public function editAction(){
        // get the details of the group by the pk sent to  link
        $pkGroup = $this->filterInt($this->_params[0]);
        $group = UserGroupModel::getByPK($pkGroup);
        // check if the id is fake
        if(FALSE === $group){
            $this->redirect('/usersgroups');
        }

        // get the group
        $this->_data['group'] = $group;
        // get privileges of the group
        $this->_data['privileges'] = UserPrivilegeModel:: getAll();
        
        $groupPrivileges = UserGroupPrivilegeModel::getBy(['GroupID' => $group->GroupID]);
        $extractedPrivileges = [];
        if(FALSE !== $groupPrivileges){
            foreach ($groupPrivileges as $privilege){
                $extractedPrivileges [] = $privilege->PrivilegeID;
            }
        }
        $this->_data['groupPrivileges'] = $extractedPrivileges ;
        
        $this->language->load('template.common');
        $this->language->load('usersgroups.edit');
        $this->language->load('usersgroups.labels');
        
        if(isset($_POST['submit'])){
             $group->GroupName = $this->filterStr($_POST['GroupName']);
            if($group->save()){
                if( isset($_POST['privileges']) && is_array($_POST['privileges']) ){
                    $deletedPrivileges = array_diff($extractedPrivileges, $_POST['privileges']);
                    $addedPrivileges = array_diff($_POST['privileges'], $extractedPrivileges);
                    foreach ($deletedPrivileges as $deletePrivilege) {
                        $deleteThisItem = UserGroupPrivilegeModel::getBy(['PrivilegeID' => $deletePrivilege, 'GroupID' => $group->GroupID]);
                        $deleteThisItem->current()->delete();
                    }
                    foreach ($addedPrivileges as $privilegeId){
                        $groupPrivilege = new UserGroupPrivilegeModel();
                        $groupPrivilege->GroupID = $group->GroupID;
                        $groupPrivilege->PrivilegeID = $privilegeId;
                        $groupPrivilege->save();
                    }
                }
            }
            $this->redirect('/usersgroups');
        }
        return $this->_view();
    }   
    public function deleteAction(){
        $pkGroup = $this->filterInt($this->_params[0]);
        $group = UserGroupModel::getByPK($pkGroup);
        // check if the id is fake
        if(FALSE === $group){
            $this->redirect('/usersgroups');
        }
        $groupPrivileges = UserGroupPrivilegeModel::getBy(['GroupID' => $group->GroupID]);
        if(FALSE !== $groupPrivileges){
            foreach ($groupPrivileges as $value) {
                $value->delete();
            }
        }
        if($group->delete()){
            $this->redirect('/usersgroups');
        }

    }
}

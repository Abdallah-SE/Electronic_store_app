<?php
namespace PHPMVC\Controllers;
use PHPMVC\Models\Employee;
use PHPMVC\LIB\InputFilter;
use PHPMVC\LIB\Helper;
class EmployeeController extends AbstractController {
    use InputFilter;
    use Helper;
    public function defaultAction(){
        $this->language->load('template.common');
        $this->language->load('employee.default');
        $this->_data['employees'] = Employee::getAll();
        return $this->_view();
    }   
    public function addAction(){
        $this->language->load('template.common');
        if(isset($_POST['submit'])){
            $empl = new Employee();
            $empl->name = $this->filterStr($_POST['name']);
            $empl->age = $this->filterInt($_POST['age']);
            $empl->salary = $this->filterFloat($_POST['salary']);
            $empl->address = $this->filterStr($_POST['address']);
            $empl->tax = $this->filterFloat($_POST['tax']);
            if($empl->save()){
                $this->redirect('/employee');
            }
        }
        return $this->_view();
    }  
    public function editAction(){
        $id = $this->filterInt($this->_params[0]);
        $empl = Employee::getByPK($id);
        if($empl ===FALSE){
            $this->redirect('/employee');
        }
        $this->_data['employee'] = $empl;
        $this->language->load('template.common');
        if(isset($_POST['submit'])){
            $empl->name = $this->filterStr($_POST['name']);
            $empl->age = $this->filterInt($_POST['age']);
            $empl->salary = $this->filterFloat($_POST['salary']);
            $empl->address = $this->filterStr($_POST['address']);
            $empl->tax = $this->filterFloat($_POST['tax']);
            if($empl->save()){
                $this->redirect('/employee');
            }
        }
        return $this->_view();
    }   
    public function deleteAction(){
        $id = $this->filterInt($this->_params[0]);
        $empl = Employee::getByPK($id);
        if($empl ===FALSE){
            $this->redirect('/employee');
        }  
            if($empl->delete()){
                $this->redirect('/employee');
        }
    }
    
}

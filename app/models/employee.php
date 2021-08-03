<?php
namespace PHPMVC\Models;
class Employee extends AbstractModel{
    public $id;
    public $name;
    public $address;
    public $age;
    public $salary;
    public $tax;

    public static $tableName = 'employees';
    public static $tableSchema = array(
        'name'    =>self::DATA_TYPE_STR,
        'address' =>self::DATA_TYPE_STR,
        'age'     =>self::DATA_TYPE_INT,
        'salary' =>self::DATA_TYPE_DECIMAL,
        'tax'    =>self::DATA_TYPE_DECIMAL
    );
    protected static $primaryKey = 'id';
    

    // calculate the real salary after reduce the tax from salary
    public function calculateSalary(){
        return $this->salary = ($this->salary -($this->salary * $this->tax) / 100); 
    }
    public function getTableName(){
        return self::$tableName;
    }
    
}

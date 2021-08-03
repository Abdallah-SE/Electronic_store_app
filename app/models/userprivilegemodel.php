<?php
namespace PHPMVC\Models;
class UserPrivilegeModel extends AbstractModel{
    public $GroupName;
    public $GroupID;
    public $PrivilegeTitle;

    public static $tableName = 'app_users_privileges';
    public static $tableSchema = array(
        'PrivilegeID'          =>self::DATA_TYPE_INT,
        'Privilege'            =>self::DATA_TYPE_STR,
        'PrivilegeTitle'            =>self::DATA_TYPE_STR
    );
    
    protected static $primaryKey = 'PrivilegeID';

    public function getTableName(){
        return self::$tableName;
    }

}
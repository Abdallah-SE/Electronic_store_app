<?php
namespace PHPMVC\Models;
class UserGroupPrivilegeModel extends AbstractModel{
    public $id;
    public $GroupID;
    public $PrivilegeID;

    public static $tableName = 'app_users_groups_privileges';
    public static $tableSchema = array(
        'GroupID'           =>self::DATA_TYPE_INT,
        'PrivilegeID'       =>self::DATA_TYPE_INT
    );
    
    protected static $primaryKey = 'id';

    public function getTableName(){
        return self::$tableName;
    }

}
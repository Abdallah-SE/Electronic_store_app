<?php
namespace PHPMVC\Models;
class UserGroupModel extends AbstractModel{
    public $GroupName;
    public $GroupID;

    public static $tableName = 'app_users_groups';
    public static $tableSchema = array(
        'GroupName'           =>self::DATA_TYPE_STR,
        'GroupID'             =>self::DATA_TYPE_INT
    );
    
    protected static $primaryKey = 'GroupID';

    public function getTableName(){
        return self::$tableName;
    }

}
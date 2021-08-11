<?php
namespace PHPMVC\Models;
class UserProfileModel extends AbstractModel{
    public $UserID;
    public $FirstName;
    public $LastName;
    public $Address;
    public $DateOfBirth;
    public $Image;

    public static $tableName = 'app_users_profiles';
    
    public static $tableSchema = array(
        'UserID'             =>self::DATA_TYPE_INT,
        'FirstName'          =>self::DATA_TYPE_STR,
        'LastName'           =>self::DATA_TYPE_STR,
        'Address'            =>self::DATA_TYPE_STR,
        'DateOfBirth'        =>self::DATA_TYPE_DATE,
        'Image'              =>self::DATA_TYPE_STR
    );
    protected static $primaryKey = 'UserID';

    public function getTableName(){
        return self::$tableName;
    }
}
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
    
    /// get the url from the privilege
    public static function getURLGroupPrivileges($groupId){
        $sql = 'SELECT augp.*, aup.Privilege FROM '. self::$tableName .' augp INNER JOIN app_users_privileges aup ON aup.PrivilegeID = augp.PrivilegeID';
        $sql .= ' WHERE augp.GroupID = '.$groupId;
        $prifileges = self::get($sql);
        $arr_privileges = [];
        if(FALSE !== $prifileges){
            foreach ($prifileges as $prifilege_value) {
                $arr_privileges[] = $prifilege_value->Privilege;
            }
        }
        return $arr_privileges;
    }
}
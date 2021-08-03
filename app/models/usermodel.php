<?php
namespace PHPMVC\Models;
class UserModel extends AbstractModel{
    public $UserID;
    public $Username;
    public $Password;
    public $Email;
    public $PhoneNumber;
    public $SubscriptionDate;
    public $LastLogin;
    public $GroupID;
    public $Status;

    public static $tableName = 'app_users';
    public static $tableSchema = array(
        'UserID'             =>self::DATA_TYPE_INT,
        'Username'           =>self::DATA_TYPE_STR,
        'Password'           =>self::DATA_TYPE_STR,
        'Email'              =>self::DATA_TYPE_STR,
        'PhoneNumber'        =>self::DATA_TYPE_STR,
        'SubscriptionDate'   =>self::DATA_TYPE_STR,
        'LastLogin'          =>self::DATA_TYPE_STR,
        'GroupID'            =>self::DATA_TYPE_INT,
        'Status'             =>self::DATA_TYPE_INT
    );
    protected static $primaryKey = 'UserID';

    public function getTableName(){
        return self::$tableName;
    }
   public function encryptPassword($password){
       $this->Password = crypt($password, MIXTURECHARS_SALT);
 }
    // override the getall fun
      public static function getUsers()
    {
        return self::get(
        'SELECT au.*, aug.GroupName GroupName FROM ' . self::$tableName . ' au INNER JOIN app_users_groups aug ON aug.GroupID = au.GroupID'
        );
    }
    //TODO:: Learn how to use header to ensure the data of ajacx be return succesfully
    public static function userExists($userName){
        return self::get('SELECT * FROM ' .self::$tableName. ' WHERE Username = "'.$userName.'"');
    }
    
    // check success or failed  user login
    public static function authenticatingUser($userName, $password, $session){
        $_password = crypt($password, MIXTURECHARS_SALT);
        $sql = 'SELECT * FROM '. self::$tableName .' WHERE Username = "'.$userName.'" AND Password = "'.$_password.'"';
        $found_user = self::getOne($sql);
        if(FALSE !== $found_user){
            if($found_user->Status == 2){
                return 2;
            }
            $found_user->LastLogin = date('y-m-d H:I:S');
            $found_user->save();
            $session->user = $found_user;
            return 1;
        }
        return FALSE;
    }
}
<?php
namespace PHPMVC\Models;
class ProductModel extends AbstractModel{
    public $UserID;
    public $Username;
    public $Password;
    public $Email;
    public $PhoneNumber;
    public $SubscriptionDate;
    public $LastLogin;
    public $GroupID;
    public $Status;
    
    public static $tableName = 'app_products_list';
    public static $tableSchema = array(
        'CategoryID'       =>self::DATA_TYPE_INT,
        'Name'             =>self::DATA_TYPE_STR,
        'Image'            =>self::DATA_TYPE_STR,
        'Quantity'         =>self::DATA_TYPE_INT,
        'Price'            =>self::DATA_TYPE_DECIMAL,
        'BarCode'          =>self::DATA_TYPE_STR,
        'Unit'             =>self::DATA_TYPE_INT
    );
    protected static $primaryKey = 'ProductID';

    public function getTableName(){
        return self::$tableName;
    }
}
<?php
namespace PHPMVC\Models;
class SupplierModel extends AbstractModel{
    
    public $SupplierID;
    public $Name;
    public $PhoneNumber;
    public $Email;
    public $Address;
    
    public static $tableName = 'app_suppliers';
    
    public static $tableSchema = array(
        'Name'                   =>self::DATA_TYPE_STR,
        'PhoneNumber'            =>self::DATA_TYPE_STR,
        'Email'                  =>self::DATA_TYPE_STR,
        'Address'                =>self::DATA_TYPE_STR
    );
    protected static $primaryKey = 'SupplierID';

}
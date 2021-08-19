<?php
namespace PHPMVC\Models;
class ProductModel extends AbstractModel{
    public $CategoryID;
    public $Name;
    public $Image;
    public $Quantity;
    public $BuyPrice;
    public $BarCode;
    public $Unit;
    public $SellPrice;
   
    public static $tableName = 'app_products_list';
    protected static $primaryKey = 'ProductID';
    
    public static $tableSchema = array(
        'CategoryID'       =>self::DATA_TYPE_INT,
        'Name'             =>self::DATA_TYPE_STR,
        'Image'            =>self::DATA_TYPE_STR,
        'Quantity'         =>self::DATA_TYPE_INT,
        'BuyPrice'            =>self::DATA_TYPE_DECIMAL,
        'BarCode'          =>self::DATA_TYPE_STR,
        'Unit'             =>self::DATA_TYPE_INT,
        'SellPrice'            =>self::DATA_TYPE_DECIMAL
    );
    
    public function getTableName(){
        return self::$tableName;
    }
    // Get the products with it's category
    public static function getProducts(){
        $sql = 'SELECT apl.*, apc.Name categoryName FROM '.self::$tableName. ' apl';
        $sql .= ' INNER JOIN ' .CategoryModel::getModelTableName(). ' apc ON apl.CategoryID = apc.CategoryID';
        return self::get($sql);
    }
}
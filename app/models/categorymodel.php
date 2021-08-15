<?php
namespace PHPMVC\Models;
class CategoryModel extends AbstractModel{
    
    public $CategoryID;
    public $Name;
    public $Image;
    
    public static $tableName = 'app_prodcuts_categories';
    
    public static $tableSchema = array(
        'Name'       =>self::DATA_TYPE_STR,
        'Image'      =>self::DATA_TYPE_STR
            
    );
    protected static $primaryKey = 'CategoryID';

}
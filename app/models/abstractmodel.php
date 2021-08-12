<?php
namespace PHPMVC\Models;
use PHPMVC\Lib\Database\DatabaseHandler;
class AbstractModel{
    const DATA_TYPE_BOOL = \PDO::PARAM_BOOL;
    const DATA_TYPE_STR = \PDO::PARAM_STR;
    const DATA_TYPE_INT = \PDO::PARAM_INT;
    const DATA_TYPE_DECIMAL = 4;
    const DATA_TYPE_DATE = 5;
    
    protected $_data = [];
    private function prepareValues(\PDOStatement &$stmt){
        foreach (static::$tableSchema as $columnName =>$type){
            if($type == 4){
                $filterDecimal = filter_var($this->$columnName, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $stmt->bindValue(':'.$columnName.'',$filterDecimal);
            }  else {
                $stmt->bindValue(':'.$columnName.'', $this->$columnName, $type);
            }
        }
    }
  

    private static function buildNameParamsSQL(){
        $namesParams = '';
        foreach (static::$tableSchema as $columnName => $type){
            $namesParams .= $columnName. ' = :' .$columnName . ',' ;
        }
        return trim($namesParams, ',');
    }
    private function create(){
        $sql = 'INSERT INTO '.static::$tableName. ' SET '.self::buildNameParamsSQL();
        $stmt = DatabaseHandler::factory()->prepare($sql);
        $this->prepareValues($stmt);
        if($stmt->execute()){
            $this->{static::$primaryKey} = DatabaseHandler::factory()->lastInsertId();
            return true;
        }
        return FALSE;
    }  
    private function update(){
        $sql = 'UPDATE '.static::$tableName. ' SET '.self::buildNameParamsSQL().' WHERE '.static::$primaryKey.' = '. $this->{static::$primaryKey};
        $stmt = DatabaseHandler::factory()->prepare($sql);
        $this->prepareValues($stmt);
        return $stmt->execute();
    }    
    public function save($checkPK = TRUE){
        if($checkPK === FALSE){
            return $this->create();
        }
        return $this->{static::$primaryKey}===NULL? $this->create():$this->update();
    }

    public function delete(){
        $sql = 'DELETE FROM '.static::$tableName. ' WHERE ' .static::$primaryKey.' = '. $this->{static::$primaryKey};
        $stmt = DatabaseHandler::factory()->prepare($sql);
        return $stmt->execute();
    }
     public static function getAll()
    {
        $sql = 'SELECT * FROM ' . static::$tableName;
        $stmt = DatabaseHandler::factory()->prepare($sql);
        $stmt->execute();
        if(method_exists(get_called_class(), '__construct')) {
            $results = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableSchema));
        } else {
            $results = $stmt->fetchAll(\PDO::FETCH_CLASS, get_called_class());
        }
        if ((is_array($results) && !empty($results))) {
            return new \ArrayIterator($results);
        };
        return false;
    }
    public static function getByPK($pk){
        $sql = 'SELECT * FROM '. static::$tableName .' WHERE ' .static::$primaryKey .'="'.$pk.'"';
        $stmt = DatabaseHandler::factory()->prepare($sql);
        if($stmt->execute()===TRUE){
            if(method_exists(get_called_class(), '__construct')) {
                $obj = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableSchema));
                }else{
                    $obj = $stmt->fetchAll(\PDO::FETCH_CLASS, get_called_class());
                     }
            return !empty($obj) ? array_shift($obj) : FALSE;
        }
        return FALSE;
    }
    public static function get($sql, $options = array()){
        $stmt = DatabaseHandler::factory()->prepare($sql);
        if (!empty($options)) {
            foreach ($options as $columnName => $type) {
                if ($type[0] == 4) {
                    $sanitizedValue = filter_var($type[1], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    $stmt->bindValue(":{$columnName}", $sanitizedValue);
                } elseif ($type[0] == 5) {
                    if (!preg_match(self::VALIDATE_DATE_STRING, $type[1]) || !preg_match(self::VALIDATE_DATE_NUMERIC, $type[1])) {
                        $stmt->bindValue(":{$columnName}", self::DEFAULT_MYSQL_DATE);
                        continue;
                    }
                    $stmt->bindValue(":{$columnName}", $type[1]);
                } else {
                    $stmt->bindValue(":{$columnName}", $type[1], $type[0]);
                }
            }
        }
        $stmt->execute();
        if(method_exists(get_called_class(), '__construct')) {
            $results = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableSchema));
        } else {
            $results = $stmt->fetchAll(\PDO::FETCH_CLASS, get_called_class());
        }
        if ((is_array($results) && !empty($results))) {
            return new \ArrayIterator($results);
        };
        return false;
    }
    public static function getBy($columns, $options = array())
    {
        $whereClauseColumns = array_keys($columns);
        $whereClauseValues = array_values($columns);
        $whereClause = [];
        for ( $i = 0, $ii = count($whereClauseColumns); $i < $ii; $i++ ) {
            $whereClause[] = $whereClauseColumns[$i] . ' = "' . $whereClauseValues[$i] . '"';
        }
        $whereClause = implode(' AND ', $whereClause);
        $sql = 'SELECT * FROM ' . static::$tableName . '  WHERE ' . $whereClause;
        return static::get($sql, $options);
    }
    public static function getOne($sql, $options = array())
    {
        $result = static::get($sql, $options);
        return $result === false ? false : $result->current();
    }
    ///return the table name
   public static function getModelTableName(){
      return static::$tableName;
    }
}
    
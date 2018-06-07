<?php
/**
 * Created by PhpStorm.
 * User: catafrakt
 * Date: 6/7/18
 * Time: 3:36 PM
 */

namespace models;


class Article extends DB{


    public $stmt;
    private $select = "";
    private $insert = "";

    public function setSelect($select){
        $this->select = $select;
    }
    public function getSelect(){
        return $this->select;
    }
    public function setInsert($insert){
        $this->insert = $insert;
    }
    public function getInsert(){
        return $this->insert;
    }
    private $where = "";
    public function setWhere($where){
        $this->where = $where;
    }
    public function getWhere(){
        return $this->where;
    }
    private $limit = "";
    public function setLimit($limit){
        $this->limit = $limit;
    }
    public function getLimit(){
        return $this->limit;
    }

    private $values = array();
    public function setValues($values){
        $this->values = $values;
    }
    public function getValues(){
        return $this->values;
    }

    public function __construct()
    {
        parent::__construct();
//        $this->tableName = $tableName;
//        $this->where = $where;
//        $this->select = $select;
//        $this->limit = $limit;
    }

}

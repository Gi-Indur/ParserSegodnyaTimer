<?php
/**
 * Created by PhpStorm.
 * User: catafrakt
 * Date: 5/10/18
 * Time: 3:32 PM
 */

namespace models;

class DB
{
    public $config;
    public $connectionParams;
    public $conn;
    private $tableName = "";


    public function __construct()
    {
        try {
            $this->config = new \Doctrine\DBAL\Configuration();
            $this->connectionParams = array(
                'dbname' => 'parser',
                'user' => 'root',
                'password' => 'root',
                'host' => 'mysql',
                'port' => '3306',
                'driver' => 'pdo_mysql',
                'charset' => 'utf8'
            );
            $this->conn = \Doctrine\DBAL\DriverManager::getConnection($this->connectionParams, $this->config);
        } catch (\Doctrine\DBAL\DBALException $e) {
            $e->getMessage();
        }
    }
    public function setTableName($tableName){
        $this->tableName = $tableName;

    }
    public function getTableName(){
        return $this->tableName;
    }
}



























//
//        $config = new \Doctrine\DBAL\Configuration();
//        $connectParams = array(
//            'dbname' => 'parserDB',
//            'user' => 'root',
//            'password' => 'password',
//            'host' => '127.0.0.1',
//            'port' => 8001,
//            'driver' => 'pdo_mysql',
//            'charset' => 'utf8'
//        );
//        $conn = \Doctrine\DBAL\DriverManager::getConnection($connectParams, $config);
//
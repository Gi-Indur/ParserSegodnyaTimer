<?php
/**
 * Created by PhpStorm.
 * User: catafrakt
 * Date: 5/10/18
 * Time: 3:32 PM
 */

namespace models;

Class Database
{
    private $config;

    public function getConfig()
    {
        return $this->config = new \Doctrine\DBAL\Configuration();
    }

    private $connParams = array(
        'dbname' => 'parser',
        'user' => 'root',
        'password' => 'testc',
//        'host' => '127.0.0.1',
        'host' => 'localhost',
        'port' => 8001,
        'driver' => 'pdo_mysql',
        'charset' => 'utf8'
    );

    public function getConnParams()
    {
        return $this->connParams;
    }

    private $conn;

    public function getConn()
    {
//        try{
            $this->conn = \Doctrine\DBAL\DriverManager::getConnection($this->getConnParams(), $this->getConfig());
            return $this->conn;
//        }
//        catch(\Doctrine\DBAL\DBALException $exception)
//        {
//            $this->getConn()->rollback();
//        }

    }
    public function createTable($sql){
        try {
            $this->getConn()->query($sql);
        }
        catch(\Doctrine\DBAL\DBALException $exception){
            $exception->getMessage();
        }
    }
    public function doSelect($sql){
        try {
            $this->getConn()->query($sql);
//            return
        }
        catch(\Doctrine\DBAL\DBALException $exception){
            $exception->getMessage();
        }
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
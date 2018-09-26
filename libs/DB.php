<?php
namespace libs;

class DB
{
    // 连接数据库
    private static $_obj = null;
    public $_pdo ;
    private function __construct(){
        $this->_pdo = new \PDO('mysql:host=127.0.0.1;dbname=jxshop','root','123456');
        $this->_pdo->exec('set names utf8');
    }
    private function __clone() {}
    public static function make()
    {
        if(self::$_obj == null)
        {
            self::$_obj = new self;
        }
        return self::$_obj;
    }
    //  预处理
    public function prepare($sql)
    {
        return $this->_pdo->prepare($sql);
    }
    
    public function exec($sql)
    {
        return $this->_pdo->exec($sql);
    }

}
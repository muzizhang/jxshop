<?php
namespace models;


class model
{
    protected $_pdo;
    //  表名   由子级确定
    protected $table;
    //  接收数据
    protected $data;
    public function __construct()
    {
        $this->_pdo = \libs\DB::make();
    }

    //  添加数据
    public function insert()
    {
        //  取出key ，value
        $key = [];
        $value = [];
        $token = [];
        //  取出数据
        foreach($this->data as $k=>$v)
        {
            $key[] = $k;
            $value[] = $v;
            $token[] = '?';
        }
        //  数据转换为字符串
        $key = implode(',',$key);
        $token = implode(',',$token);
        $stmt = $this->_pdo->prepare("INSERT INTO $this->table($key) VALUES($token)");
        $stmt->execute($value);
    }
    //  接收数据
    public function fill($data)
    {
        foreach($data as $k=>$v)
        {
            // echo $k;
            // var_dump($this->fillable);
            // var_dump(in_array($k,$this->fillable));
            // die;
            /*
                is_array()   检测变量是否是数据
                in_array(待搜索的值,待搜索的数组)   判断数组中是否存在某个值
            */ 
            //  判断data传的数据  是否在白名单中
            if(!in_array($k,$this->fillable))
            {
                unset($data[$k]);
            }    
            $this->data = $data;
        }
    }
    //  更新数据
    public function update()
    {

    }
    //  删除数据
    public function delete()
    {

    }

    //  查询数据
    public function findAll()
    {

    }

    public function find()
    {

    }
}
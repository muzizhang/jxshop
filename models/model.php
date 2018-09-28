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

    //  钩子函数
    protected function _before_write(){}
    protected function _after_write(){}
    protected function _before_delete(){}
    protected function _after_delete(){}


    //  添加数据
    public function insert()
    {
        $this->_before_write();
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
        return $stmt->execute($value);
        $this->data['id'] = $this->_pdo->lastInsertId();

        $this->_after_write();
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
    public function update($id)
    {
        $this->_before_write();
        $key = [];
        $value = [];
        $token = [];
        foreach($this->data as $k=>$v)
        {
            $key[] = "$k=?";
            $value[] = $v;
            $token[] = '?';
        }
        $key = implode(',',$key);
        $value[] = $id;

        $sql = "UPDATE {$this->table} SET $key WHERE id=?";
        $stmt = $this->_pdo->prepare($sql);
        $stmt->execute($value);
        $this->_after_write();
    }
    //  删除数据
    public function delete($id)
    {
        $this->_before_delete();
        $stmt= $this->_pdo->prepare("DELETE FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        $this->_after_delete();
    }

    //  查询数据
    public function findAll($options =[])
    {
        $_option = [
            'fields'=>'*',
            'where'=>1,
            'order_by'=>'id',
            'order_way'=>'desc',
            'per_page'=>20
        ];
        //   合并用户的配置
        if($options)
        {
            $_option = array_merge($_option,$options);
        }
        //  翻页
        $page = isset($_GET['page']) ? max(1,(int)$_GET['page']) : 1;
        //  每页的初始ID 
        $offset = ($page-1)*$_option['per_page'];

        //  查询语句
        $sql = "SELECT {$_option['fields']}
                    FROM {$this->table}
                        WHERE {$_option['where']}
                            ORDER BY {$_option['order_by']} {$_option['order_way']}
                                LIMIT $offset,{$_option['per_page']}";
        $stmt = $this->_pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        //  获取总记录数
        $stmt = $this->_pdo->prepare("SELECT count(*) FROM {$this->table} WHERE {$_option['where']}");
        $stmt->execute();
        $count = $stmt->fetch(\PDO::FETCH_COLUMN);
        $pageCount = ceil($count/$_option['per_page']);

        //  拼接分页
        $page_str = '';
        for($i=1;$i<$pageCount;$i++)
        {
            $page_str .= '<a href="?page='.$i.'">'.$i.'</a>';
        }
        return [
            'data'=>$data,
            'page'=>$page_str
        ];
    }
    //  查询一条数据
    public function find($id)
    {
       $stmt = $this->_pdo->prepare("SELECT * FROM {$this->table} WHERE id = ? ");
       $stmt->execute([$id]);
       return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
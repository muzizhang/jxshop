<?php
namespace models;

class privilege extends model
{
    //   表名
    protected $table = 'privilege';
    //   白名单
    protected $fillable = ['pri_name','url_path','parent_id'];

    //  递归查询数据
    public function tree()
    {
        //  取出所有数据
        $data = $this->findAll([
            'order_way'=>'asc',
            'per_page'=>9999999999
        ]);
        //  将查询出来的数据  到新的函数中进行递归取出相应数据
        $ret = $this->_tree($data['data']);
        return $ret;
    }
    
}
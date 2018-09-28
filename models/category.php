<?php
namespace models;

class category extends model
{
    //   表名
    protected $table = 'category';
    //   白名单
    protected $fillable = ['cat_name','parent_id','path'];

    //  查询根级分类
    public function category($parent_id = 0)
    {
        return $this->findAll([
                'where'=>'parent_id = '.$parent_id,
                'order_way'=>'asc'
            ]);
    }

    //  无限级分类
    public function cate()
    {
        //  取出所有数据
        $data = $this->findAll();
        return $this->_sort($data['data']);
    }
    //  循环取出数据
    public function _sort($data,$parent_id=0,$level=0)
    {
        static $_arr = [];
        foreach($data as $v)
        {
            if($v['parent_id'] == $parent_id)
            {   
                $v['level'] = $level;
                $_arr[] = $v;
                $this->_sort($data,$v['id'],$level+1);
            }
        }
        return $_arr;
    }
}
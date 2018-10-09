#  sql
~~~sql
    //  查询表结构
    SHOW FULL FIELDS FROM 表名
~~~

## 操作数据
    控制器-》模型-》基模型-》DB


##  分类列表
   无限级分类
   方法一：`操作数据库`
~~~sql
    排序
        SELECT *,concat(path,id,'-') FROM category ORDER BY concat(path,id,'-') asc
~~~
-     $a = count(explode('-',$str))-2;
-     $a = substr_count($str,'-')-2;


   方法二：`递归查询`
~~~php
    //  定义一个函数
    public function tree()
    {
        //  取出所有数据
        $data = $this->findAll();
        //  进行分类
        $ret = $this->_tree($data['data']);
        return $ret;
    }
    //   将数据进行分级别
    public function _tree($data,$parent_id=0;$level=0)
    {
        //  定义一个空数组
        static $arr = [];
        foreach($data as $v)
        {
            if($v['parent_id'] == $parent_id)
            {
                //   记录级别
                $v['level'] = $level;
                //  将数据保存到数组中
                $arr[] = $v;
                //   当前级别的子级
                $this->_tree($data,$v['id'],$level+1);
            }
        }
        return $arr;
    }
~~~

# RBAC
基于角色的权限访问控制
RBAC就是一套权限系统，让不同的管理员只能访问它有权访问的功能模块
## 组成部分
- 权限管理
    - 管理网站中所有可以分配的功能权限
- 角色管理
    - 每个角色都会有多个权限
- 管理员管理
    - 一个账号
    - 每个管理员都要关联一个或者多个角色
        - tom管理员，这个管理员属于商品商品编辑这个角色，就会拥有这个角色所拥有的权限
## 表结构
`一般一个完整的RBAC基本都是由5张表组成`
如果两个表是多对多，要创建一个中间表
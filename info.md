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
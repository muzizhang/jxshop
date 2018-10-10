##  sql
~~~sql
    //  查询表结构
    SHOW FULL FIELDS FROM 表名
~~~

##  操作数据
    控制器-》模型-》基模型-》DB


##  实现图片预览功能


##  三级联动

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


##   超级管理员
判断当前管理员中的角色是否有超级管理员角色
~~~sql
    SELECT count(*) FROM role_admin WHERE role_id = 1 AND admin_id = ? 
    -- 如果存在，则保存到  session 中  $_SESSION['root'] = true;
    --  否则，取出当前管理员的对应的权限路径
~~~


##  登录验证
- 在登录时，将相应管理员的权限路径保存到session中
~~~php
    public function privilege_url()
    {
        $stmt = $this->_pdo->prepare(`
        SELECT c.url_path
            FROM role_admin a 
            LEFT JOIN role_privilege b ON a.role_id = b.role_id
            LEFT JOIN privilege c ON b.pri_id = c.id
            WHERE a.admin_id = ?
        `);


        //  取出的数据为二维数组，将其二维数组转换为一维数组
    }
~~~
- 当管理员访问的时候，地址栏的参数将在session['url_path']中的数据 判断是否存在   in_array()     返回值 为    true  false
- 如果返回为true  ，可以访问当前路径
- 如果返回为false  ，则拒绝访问 die('无法访问')
~~~php
    $white = ['index/index','index/main','index/emnu','index/top'];
    $url = array_merge($white,$_SESSION['url_path]);
    if(!in_array(trim($_SERVER['PATH_INFO'],'/'),$url))
    {
        die('无权访问');
    }
~~~


##  三级联动






##   集成中的session 共享
##   当用户未登录时选择的商品，用户登录放到购物车中
##   用户注册，登录需要注意的安全问题
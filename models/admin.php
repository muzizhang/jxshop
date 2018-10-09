<?php
namespace models;

class admin extends model
{
    //   表名
    protected $table = 'admin';
    //   白名单
    protected $fillable = ['user_name','password'];

    //  获取管理员拥有的权限路径
    public function privilege_url()
    {
        $sql = 'SELECT c.url_path
            FROM role_admin a
            LEFT JOIN role_privilege b ON a.role_id = b.role_id
            LEFT JOIN privilege c ON b.pri_id = c.id
            WHERE a.admin_id = ?';
        $stmt = $this->_pdo->prepare($sql);
        $stmt->execute([
            $_SESSION['id']
        ]);
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        //  将二维数组转换为一维数组
        $arr = [];
        foreach($data as $k=>$v)
        {
            //  判断$v['url_path']  中是否有  ，
            //   strpos()     查找  在字符串中第一次出现的位置
            if(FALSE == strpos($v['url_path'],','))
            {
                $arr[] = $v['url_path'];
            }
            else
            {
                //  将字符串分隔为数组
                $_tt = explode(',',$v['url_path']);
                //  将两个数组进行合并
                $arr = array_merge($arr,$_tt);
            }
        }
        return $arr;
    }

    //   登录
    public function login($username,$password)
    {
        $stmt = $this->_pdo->prepare('SELECT * FROM admin WHERE user_name = ? AND password = ?');
        $stmt->execute([
            $username,
            $password
        ]);
        $ret = $stmt->fetch(\PDO::FETCH_ASSOC);
        if($ret)
        {
            $_SESSION['id'] = $ret['id'];
            $_SESSION['username'] = $username;

            //   查看当前管理员 是否有一个角色是超级管理员
            $stmt = $this->_pdo->prepare('SELECT count(*) FROM role_admin WHERE role_id = 1 AND admin_id = ?');
            $stmt->execute([$ret['id']]);
            $ret = $stmt->fetch(\PDO::FETCH_COLUMN);
            if($ret>0)
                $_SESSION['root'] = true;
            else 
                //  在登录的时候将权限保存到session中
                $_SESSION['url_path'] = $this->privilege_url();
        }
        else
        {
            throw new \Exception('用户名或者密码错误');
        }
    }

    //  退出
    public function logout()
    {
        //  将session 清空
        $_SESSION = [];
        session_destroy();
    }

    //  删除中间表上的数据
    public function _before_delete()
    {
        $stmt = $this->_pdo->prepare('DELETE FROM role_admin WHERE admin_id = ?');
        $stmt->execute([$_GET['id']]);
    }

    //  取出该用户的角色
    public function role($id)
    {
        $stmt = $this->_pdo->prepare('SELECT role_id FROM role_admin WHERE admin_id = ?');
        $stmt->execute([
            $id
        ]);
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        //  将二维数组转换为一维数组
        $arr = [];
        foreach($data as $k=>$v)
        {
            $arr[] = $v['role_id'];
        }
        return $arr;
    }

    //  添加,更新数据
    public function _after_write()
    {
        //  获取id
        $id = isset($_GET['id']) ? $_GET['id'] : $this->data['id'];
        //  在更新数据之前，删除原数据
        $stmt = $this->_pdo->prepare('DELETE FROM role_admin WHERE admin_id = ?');
        $stmt->execute([$id]);
        //  插入数据
        $stmt = $this->_pdo->prepare('INSERT INTO role_admin(role_id,admin_id) VALUES(?,?)');
        foreach($_POST['role_id'] as $v)
        {
            $stmt->execute([
                $v,
                $id
            ]);
        }
    }
}
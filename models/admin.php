<?php
namespace models;

class admin extends model
{
    //   表名
    protected $table = 'admin';
    //   白名单
    protected $fillable = ['user_name','password'];

    //   登录
    public function login($username,$password)
    {
        $stmt = $this->_pdo->prepare('SELECT COUNT(*) FROM admin WHERE user_name = ? AND password = ?');
        $stmt->execute([
            $username,
            $password
        ]);
        $ret = $stmt->fetch(\PDO::FETCH_COLUMN);
        if($ret)
        {
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
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
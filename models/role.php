<?php
namespace models;

class role extends model
{
    //   表名
    protected $table = 'role';
    //   白名单
    protected $fillable = ['role_name'];

    //   在添加前，将权限数据，保存到数据库中
    public function _after_write()
    {
        $stmt = $this->_pdo->prepare('INSERT INTO role_privilege(pri_id,role_id) VALUES(?,?)');
        foreach($_POST['pri_id'] as $v)
        {
            $stmt->execute([
                $v,
                $this->data['id']
            ]);
        }
    }

    //  删除权限
    public function _before_delete()
    {
        //  删除当前角色所拥有的权限
        $stmt = $this->_pdo->prepare('DELETE FROM role_privilege WHERE role_id = ?');
        $stmt->execute([
            $_GET['id']
        ]);
    }

    //   根据id  查询 role_privilege 表 中的数据
    // public function privilege()
    // {
    //     //  取出所有数据
    //     $data = $this->findAll([
    //         'order_way'=>'asc'
    //     ]);

    //     $stmt = $this->_pdo->prepare('SELECT * FROM role_privilege a LEFT WHERE role_id = ?');
    //     static $arr = [];
    //     foreach($data['data'] as $v)
    //     {
    //         $stmt->execute([
    //             $v['id']
    //         ]);
    //         $arr[] = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    //     }
    //     return $arr;
    // }
}
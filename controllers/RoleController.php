<?php 
namespace controllers;

class RoleController
{
    // 分类首页
    public function index()
    {
        //  查询所有
        $role = new \models\role;
        $data = $role->findAll([
            'fields'=>'a.id,a.role_name,GROUP_CONCAT(c.pri_name) privilege',
            'order_way'=>'asc',
            'join'=>' a LEFT JOIN role_privilege b ON a.id = b.role_id LEFT JOIN privilege c ON b.pri_id = c.id',
            'groupBy'=>' GROUP BY a.id'
        ]);
        view('role/index',$data);
    }
    //  创建分类
    public function create()
    {
        $role = new \models\privilege;
        $data = $role->tree();
        view('role/create',$data);
    }
    //  处理添加分类表单
    public function add()
    {
        //  调用模型
        $role = new \models\role;
        //  传输数据
        $role->fill($_POST);

        // $a = $role->privilege();
        // var_dump($a);
        // die;
        //  添加数据
        $role->insert();
        //  跳转页面
        redirect('/role/index');
    }
    //   编辑分类
    public function edit()
    {
        //  获取原数据
        $role = new \models\role;
        //  接收数据
        $data = $role->find($_GET['id']);
        view('role/edit',[
            'data'=>$data
        ]);
    }
    //  处理编辑分类表单
    public function modify()
    {
        //  调用模型
        $role = new \models\role;
        //  传输数据
        $role->fill($_POST);
        //  添加数据
        $role->update($_GET['id']);
        redirect('/role/index');
    }
    //  删除分类
    public function delete()
    {
        $role = new \models\role;
        //  删除数据
        $role->delete($_GET['id']);
        redirect('/role/index');
    }
}
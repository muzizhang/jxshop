<?php 
namespace controllers;

class AdminController
{
    // 分类首页
    public function index()
    {
        //  查询所有
        $admin = new \models\admin;
        $data = $admin->findAll([
            'order_way'=>'asc'
        ]);
        view('admin/index',$data);
    }
    //  创建分类
    public function create()
    {
        //  取出角色
        $role = new \models\role; 
        $ro = $role->findAll([
            'order_way'=>'asc'
        ]);

        view('admin/create',[
            'role'=>$ro
        ]);
    }
    //  处理添加分类表单
    public function add()
    {
        //  调用模型
        $admin = new \models\admin;
        $_POST['password'] = md5($_POST['password']);
        //  传输数据
        $admin->fill($_POST);
        //  添加数据
        $admin->insert();
        
        //  跳转页面
        redirect('/admin/index');
    }
    //   编辑分类
    public function edit()
    {
        //  获取原数据
        $admin = new \models\admin;
        //  接收数据
        $data = $admin->find($_GET['id']);

        //  取出角色列表
        $role = new \models\role;
        $ro = $role->findAll([
            'order_way'=>'asc'
        ]);
        //  取出当前用户的角色
        $roles = $admin->role($_GET['id']);
        // echo '<pre>';
        // var_dump($roles);
        view('admin/edit',[
            'data'=>$data,
            'role'=>$ro,
            'roles'=>$roles
        ]);
    }
    //  处理编辑分类表单
    public function modify()
    {
        //  调用模型
        $admin = new \models\admin;
        //  传输数据
        $admin->fill($_POST);

        //  添加数据
        $admin->update($_GET['id']);
        redirect('/admin/index');
    }
    //  删除分类
    public function delete()
    {
        $admin = new \models\admin;
        //  删除数据
        $admin->delete($_GET['id']);
        redirect('/admin/index');
    }
}
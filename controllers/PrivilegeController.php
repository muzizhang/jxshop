<?php 
namespace controllers;

class PrivilegeController
{
    // 分类首页
    public function index()
    {
        //  查询所有
        $privilege = new \models\privilege;
        $data = $privilege->tree();
        view('privilege/index',$data);
    }
    //  创建分类
    public function create()
    {

        view('privilege/create');
    }
    //  处理添加分类表单
    public function add()
    {
        //  调用模型
        $privilege = new \models\privilege;
        //  传输数据
        $privilege->fill($_POST);
        //  添加数据
        $privilege->insert();
        //  跳转页面
        redirect('/privilege/index');
    }
    //   编辑分类
    public function edit()
    {
        //  获取原数据
        $privilege = new \models\privilege;
        //  接收数据
        $data = $privilege->find($_GET['id']);
        view('privilege/edit',[
            'data'=>$data
        ]);
    }
    //  处理编辑分类表单
    public function modify()
    {
        //  调用模型
        $privilege = new \models\privilege;
        //  传输数据
        $privilege->fill($_POST);
        //  添加数据
        $privilege->update($_GET['id']);
        redirect('/privilege/index');
    }
    //  删除分类
    public function delete()
    {
        $privilege = new \models\privilege;
        //  删除数据
        $privilege->delete($_GET['id']);
        redirect('/privilege/index');
    }
}
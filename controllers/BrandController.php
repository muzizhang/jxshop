<?php 
namespace controllers;

class BrandController
{
    // 分类首页
    public function index()
    {
        //  查询所有
        $brand = new \models\brand;
        $data = $brand->findAll();
        view('brand/index',$data);
    }
    //  创建分类
    public function create()
    {

        view('brand/create');
    }
    //  处理添加分类表单
    public function add()
    {
        //  调用模型
        $brand = new \models\brand;
        //  传输数据
        $brand->fill($_POST);
        //  添加数据
        $brand->insert();
        //  跳转页面
        redirect('/brand/index');
    }
    //   编辑分类
    public function edit()
    {
        //  获取原数据
        $brand = new \models\brand;
        //  接收数据
        $data = $brand->find($_GET['id']);
        view('brand/edit',[
            'data'=>$data
        ]);
    }
    //  处理编辑分类表单
    public function modify()
    {
        //  调用模型
        $brand = new \models\brand;
        //  传输数据
        $brand->fill($_POST);
        //  添加数据
        $brand->update($_GET['id']);
        redirect('/brand/index');
    }
    //  删除分类
    public function delete()
    {
        $brand = new \models\brand;
        //  删除数据
        $brand->delete($_GET['id']);
        redirect('/brand/index');
    }
}
<?php 
namespace controllers;

class GoodsController
{
    // 分类首页
    public function index()
    {
        //  查询所有
        $goods = new \models\goods;
        $data = $goods->findAll();
        view('goods/index',$data);
    }
    //  创建分类
    public function create()
    {

        view('goods/create');
    }
    //  处理添加分类表单
    public function add()
    {
        //  调用模型
        $goods = new \models\goods;
        //  传输数据
        $goods->fill($_POST);
        //  添加数据
        $goods->insert();
        //  跳转页面
        redirect('/goods/index');
    }
    //   编辑分类
    public function edit()
    {
        //  获取原数据
        $goods = new \models\goods;
        //  接收数据
        $data = $goods->find($_GET['id']);
        view('goods/edit',[
            'data'=>$data
        ]);
    }
    //  处理编辑分类表单
    public function modify()
    {
        //  调用模型
        $goods = new \models\goods;
        //  传输数据
        $goods->fill($_POST);
        //  添加数据
        $goods->update($_GET['id']);
        redirect('/goods/index');
    }
    //  删除分类
    public function delete()
    {
        $goods = new \models\goods;
        //  删除数据
        $goods->delete($_GET['id']);
        redirect('/goods/index');
    }
}
<?php 
namespace controllers;

class TestController
{
    // 分类首页
    public function index()
    {
        view('test/index');
    }
    //  创建分类
    public function create()
    {
        view('test/create');
    }
    //  处理添加分类表单
    public function add()
    {

    }
    //   编辑分类
    public function edit()
    {
        view('test/create');
    }
    //  处理编辑分类表单
    public function modify()
    {

    }
    //  删除分类
    public function delete()
    {
        view('test/create');
    }
}
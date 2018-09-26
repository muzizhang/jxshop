<?php 
namespace controllers;

class BlogController
{
    // 分类首页
    public function index()
    {
        view('blog/index');
    }
    //  创建分类
    public function create()
    {
        view('blog/create');
    }
    //  处理添加分类表单
    public function add()
    {

    }
    //   编辑分类
    public function edit()
    {
        view('blog/create');
    }
    //  处理编辑分类表单
    public function modify()
    {

    }
    //  删除分类
    public function delete()
    {
        view('blog/create');
    }
}
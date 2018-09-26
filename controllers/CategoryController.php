<?php 
namespace controllers;

class CategoryController
{
    // 分类首页
    public function index()
    {
        view('category/index');
    }
    //  创建分类
    public function create()
    {
        view('category/create');
    }
    //  处理添加分类表单
    public function add()
    {

    }
    //   编辑分类
    public function edit()
    {
        view('category/create');
    }
    //  处理编辑分类表单
    public function modify()
    {

    }
    //  删除分类
    public function delete()
    {
        view('category/create');
    }
}
<?php 
namespace controllers;

class Article_categoryController
{
    // 分类首页
    public function index()
    {
        //  查询所有
        $article_category = new \models\article_category;
        $data = $article_category->findAll();
        view('article_category/index',$data);
    }
    //  创建分类
    public function create()
    {

        view('article_category/create');
    }
    //  处理添加分类表单
    public function add()
    {
        //  调用模型
        $article_category = new \models\article_category;
        //  传输数据
        $article_category->fill($_POST);
        //  添加数据
        $article_category->insert();
        //  跳转页面
        redirect('/article_category/index');
    }
    //   编辑分类
    public function edit()
    {
        //  获取原数据
        $article_category = new \models\article_category;
        //  接收数据
        $data = $article_category->find($_GET['id']);
        view('article_category/edit',[
            'data'=>$data
        ]);
    }
    //  处理编辑分类表单
    public function modify()
    {
        //  调用模型
        $article_category = new \models\article_category;
        //  传输数据
        $article_category->fill($_POST);
        //  添加数据
        $article_category->update($_GET['id']);
        redirect('/article_category/index');
    }
    //  删除分类
    public function delete()
    {
        $article_category = new \models\article_category;
        //  删除数据
        $article_category->delete($_GET['id']);
        redirect('/article_category/index');
    }
}
<?php 
namespace controllers;

class ArticleController
{
    // 分类首页
    public function index()
    {
        //  查询所有
        $article = new \models\article;
        $data = $article->disable();
        //  将获取到的分类id   数字，进行文字化
        view('article/index',$data);
    }
    //  创建分类
    public function create()
    {
        //  取出分类
        $article = new \models\article_category;
        $data = $article->findAll([
            'order_way'=>'asc'
        ]);

        view('article/create',[
            'data'=>$data['data']
        ]);
    }
    //  处理添加分类表单
    public function add()
    {
        //  调用模型
        $article = new \models\article;
        //  传输数据
        $article->fill($_POST);
        //  添加数据
        $article->insert();
        //  跳转页面
        redirect('/article/index');
    }
    //   编辑分类
    public function edit()
    {
        //  获取原数据
        $article = new \models\article;
        //  接收数据
        $data = $article->find($_GET['id']);
        
        //  取出分类
        $article = new \models\article_category;
        $category = $article->findAll([
            'order_way'=>'asc'
        ]);

        view('article/edit',[
            'data'=>$data,
            'category'=>$category['data'],
        ]);
    }
    //  处理编辑分类表单
    public function modify()
    {
        //  调用模型
        $article = new \models\article;
        //  传输数据
        $article->fill($_POST);
        //  添加数据
        $article->update($_GET['id']);
        redirect('/article/index');
    }
    //  删除分类
    public function delete()
    {
        $article = new \models\article;
        //  删除数据
        $article->delete($_GET['id']);
        redirect('/article/index');
    }
}
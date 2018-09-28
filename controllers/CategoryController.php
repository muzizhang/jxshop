<?php 
namespace controllers;

class CategoryController
{
    // 分类首页
    public function index()
    {
        //  计算级别
        // $str = '-1-';
        // //  对字符串进行分割
        // $a = count(explode('-',$str))-2;

        // $a = substr_count($str,'-')-2;
        // echo '<pre>';
        // var_dump($a);
        // die;

        $option =[
            'order_by'=>"concat(path,id,'-')",
            'order_way'=>'asc',
            'per_page'=>99999999
        ];
        //  查询所有
        $category = new \models\category;
        /* 无限级分类 */
        // $a = $category->cate();
        // echo "<pre>";
        // var_dump($a);

        $data = $category->findAll($option);

        view('category/index',$data);
    }
    //  创建分类
    public function create()
    {

        view('category/create');
    }
    //  处理添加分类表单
    public function add()
    {
        //  调用模型
        $category = new \models\category;
        //  传输数据
        $category->fill($_POST);
        //  添加数据
        $category->insert();
        //  跳转页面
        redirect('/category/index');
    }
    //   编辑分类
    public function edit()
    {
        //  获取原数据
        $category = new \models\category;
        //  接收数据
        $data = $category->find($_GET['id']);
        view('category/edit',[
            'data'=>$data
        ]);
    }
    //  处理编辑分类表单
    public function modify()
    {
        //  调用模型
        $category = new \models\category;
        //  传输数据
        $category->fill($_POST);
        //  添加数据
        $category->update($_GET['id']);
        redirect('/category/index');
    }
    //  删除分类
    public function delete()
    {
        $category = new \models\category;
        //  删除数据
        $category->delete($_GET['id']);
        redirect('/category/index');
    }
}
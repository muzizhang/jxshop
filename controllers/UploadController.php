<?php
namespace controllers;

class UploadController
{
    public function upload()
    {
        //   接收图片
        $img = $_FILES['file'];
        //  生成目录
        if(!is_dir(ROOT.'/public/uploads/article/'.date('Ymd')))
        {
            mkdir(ROOT.'/public/uploads/article/'.date('Ymd'),0777,true);
        }
        //  生成文件名
        $name = time().rand(1,9999999);
        // 图片后缀
        $_ext = explode('/',$img['type']);
        //  将文件移动到指定位置
        move_uploaded_file($img['tmp_name'],ROOT.'/public/uploads/article/'.date('Ymd').'/'.$name.$_ext[1]);
        echo json_encode([
            'success'=>true,
            'file_path'=>'/public/uploads/',
        ]);
    }
    public function doupload()
    {
        //   取出当前文章的内容
        $article = new \models\article;
        $data = $article->find($_GET['id']);
        //  正则匹配
        // $a = preg_match_all('/.*<img.*src="(.*)".*>.*/U',$data['content'],$rest);
        // echo '<pre>';
        // var_dump($a,$rest);
        // die;
        //   接收图片
        $img = $_FILES['file'];
        //  生成目录
        if(!is_dir(ROOT.'/public/uploads/article/'.date('Ymd')))
        {
            mkdir(ROOT.'/public/uploads/article/'.date('Ymd'),0777,true);
        }
        //  生成文件名
        $name = time().rand(1,9999999);
        // 图片后缀
        $_ext = explode('/',$img['type']);
        //  将文件移动到指定位置
        move_uploaded_file($img['tmp_name'],ROOT.'/public/uploads/article/'.date('Ymd').'/'.$name.$_ext[1]);
        echo json_encode([
            'success'=>true,
            'file_path'=>'/public/uploads/',
        ]);
    }
}
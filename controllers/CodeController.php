<?php
namespace controllers;

class CodeController
{
    //  代码生成器
    public function born()
    {
        //  接收类名
        $tableName = $_GET['name'];
        //  控制器名
        $name = ucfirst($tableName);
        //  缓存区
        ob_start();
        //  引入文件
        include(ROOT.'templates/CategoryController.php');
        //  从缓冲区取出数据
        $str = ob_get_clean();
        //  将获取的数据，加载到指定位置
        file_put_contents(ROOT.'controllers/'.$tableName.'Controller.php',"<?php ".$str);

        //   模型
        ob_start();
        include(ROOT.'templates/category.php');
        $str = ob_get_clean();
        file_put_contents(ROOT.'models/'.$tableName.'.php',"<?php".$str);

        //  视图
        //  创建文件夹
        @mkdir(ROOT.'views/'.$tableName,0777);
        //  创建
        ob_start();
        include(ROOT.'templates/create.html');
        $str = ob_get_clean();
        file_put_contents(ROOT.'views/'.$tableName.'/create.html',$str);
        //  编辑
        ob_start();
        include(ROOT.'templates/edit.html');
        $str = ob_get_clean();
        file_put_contents(ROOT.'views/'.$tableName.'/edit.html',$str);
        //   首页
        ob_start();
        include(ROOT.'templates/index.html');
        $str = ob_get_clean();
        file_put_contents(ROOT.'views/'.$tableName.'/index.html',$str);
    }
}
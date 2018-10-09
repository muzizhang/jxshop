<?php
namespace controllers;

class BaseController
{
    public function __construct()
    {
        // 判断用户是否登录
        if(!isset($_SESSION['id']))
        {
            redirect('/login/index');
        }

        $admin = new \models\admin;
        //   地址栏是否有参数
        $parms = isset($_SERVER['PATH_INFO']) ? trim($_SERVER['PATH_INFO'],'/') : 'index/index';
        $white = ['index/index','index/top','index/menu','index/main'];
        //  合并数组
        $url = array_merge($_SESSION['url_path'],$white);
        //  将地址栏的参数   到  数组中查找
        if(!in_array($parms,$url))
        {
            die('无权访问');
        }
    }
}
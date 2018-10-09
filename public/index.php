<?php
session_start();
//  设置常量
define('ROOT',__DIR__.'/../');
//  引入函数类
require(ROOT.'libs\function.php');
//  实现类的自动加载
function autoload($class)
{
    $path = str_replace('\\','/',$class);
    require(ROOT.$path.'.php');
}
//  注册函数
spl_autoload_register('autoload');
//   解析路由
//   定义默认控制器，方法
$controller = '\controllers\IndexController';
$active = 'index';
if(isset($_SERVER['PATH_INFO']))
{
    //  处理接收 的路由
    $router = explode('/',$_SERVER['PATH_INFO']);
    $controller = '\controllers\\'.ucfirst($router[1]).'Controller';
    $active = $router[2];
}
//   实例化对象
$class = new $controller;
$class->$active();
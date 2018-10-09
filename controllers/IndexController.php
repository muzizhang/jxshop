<?php
namespace controllers;

class IndexController extends BaseController
{
    //  显示首页
    public function index()
    {
        view('index/index');
    }
    //  头部
    public function top()
    {
        view('index/top');
    }
    //   menu
    public function menu()
    {
        view('index/menu');
    }
    //   main
    public function main()
    {
        view('index/main');
    }
}
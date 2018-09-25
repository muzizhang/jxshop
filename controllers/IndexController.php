<?php
namespace controllers;

class IndexController
{
    public function index()
    {
        view('index/index',[
            'name'=>'zhangsan',
            'age'=>'19'
        ]);
    }
}
<?php
namespace controllers;

class TestController extends BaseController
{
    public function test()
    {
        view('test/test');
    }
    public function upload()
    {
        view('test/upload');
    }
}
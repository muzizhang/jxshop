<?php
namespace controllers;

class LoginController
{
    public function index()
    {
        view('login/login');
    }

    //   登录
    public function login()
    {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $admin = new \models\admin;
        try
        {
            $admin->login($username,$password);
            view('/index/index');
        }
        catch(\Exception $e)
        {
            // echo 'message:'.$e->getMessage();
            redirect('/login/index');
        }
    }

    //   退出
    public function logout()
    {
        $admin = new \models\admin;
        $admin->logout();
        $this->index();
    }
}
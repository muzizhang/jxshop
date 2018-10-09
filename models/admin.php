<?php
namespace models;

class admin extends model
{
    //   表名
    protected $table = 'admin';
    //   白名单
    protected $fillable = ['user_name','password'];
}
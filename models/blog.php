<?php
namespace models;

class blog extends model
{
    //  指定表
    protected $table = 'blog';
    // 添加白名单
    protected $fillable = ['title','content','is_show'];
}
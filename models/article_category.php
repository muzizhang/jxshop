<?php
namespace models;

class article_category extends model
{
    //   表名
    protected $table = 'article_category';
    //   白名单
    protected $fillable = ['cat_name'];
}
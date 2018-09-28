<?php
namespace models;

class brand extends model
{
    //   表名
    protected $table = 'brand';
    //   白名单
    protected $fillable = ['brand_name','logo'];
}
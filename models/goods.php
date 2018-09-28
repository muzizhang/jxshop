<?php
namespace models;

class goods extends model
{
    //   表名
    protected $table = 'goods';
    //   白名单
    protected $fillable = ['goods_name','logo','is_on_sale','description','cat1_id','cat2_id','cat3_id','brand_id'];
}
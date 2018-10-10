<?php
namespace models;

class goods extends model
{
    //   表名
    protected $table = 'goods';
    //   白名单
    protected $fillable = ['goods_name','logo','is_on_sale','description','cat1_id','cat2_id','cat3_id','brand_id'];

    // public function _before_write()
    // {
    //     echo '<pre>';
    //     var_dump($this->data);
    //     die;
    // }

    //  添加属性
    // public function attribute()
    // {
    //     //  预处理
    //     $stmt = $this->_pdo->prepare("INSERT INTO goods_attribute(attr_name,attr_value,goods_id) VALUES(?,?,?)");
    //     foreach($_POST['attr_name'] as $k=>$v){
    //         $stmt->execute([
    //             $v,
    //             $_POST['attr_value'][$k],
    //             $this->data['id']
    //         ]);
    //     }
    // }
}
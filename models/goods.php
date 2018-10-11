<?php
namespace models;

class goods extends model
{
    //   表名
    protected $table = 'goods';
    //   白名单
    protected $fillable = ['goods_name','logo','is_on_sale','description','cat1_id','cat2_id','cat3_id','brand_id'];
    //   在修改之前删除原图片
    protected function _delete_logo()
    {
        if(isset($_GET['id']))
        {
            //  取出圆logo的路径
            $logo = $this->_pdo->find($_GET['id']);
            //  删除
            unlink(ROOT.'public'.$logo['logo']);
        }
    }

    //  修改和添加之前执行
    public function _before_write()
    {
        // echo '<pre>';
        // var_dump($_FILES);
        // die;
        //  在确定提交之前处理图片 ,   error   等于 0   ，图片可以添加
        if($_FILES['logo']['error'] === 0)
        {
            //   在修改之前删除原图片
            $this->_delete_logo();
            //  实现图片上传
            $upload = \libs\Uploader::make();
            $logo = '/uploads/'.$upload->upload('logo','logo');
            //   将logo  添加到数组中   ，插入到数据库
            $this->data['logo'] = $logo;
        }   
    }
    // 添加，修改之后执行
    //   添加时，获取商品id   $this->data['id']
    //   修改时，获取商品id   $_GET['id']
    public function _after_write()
    {
        //  获取id
        $goodId = isset($_GET['id']) ? $_GET['id']: $this->data['id'];
        //    添加图片
        $stmt = $this->_pdo->prepare("INSERT INTO goods_image(path,goods_id) VALUES(?,?)");
        $upload = \libs\Uploader::make();
        $_tmp = [];
        foreach($_FILES['img_name']['name'] as $k=>$v)
        {
            if($_FILES['img_name']['error'][$k] == 0)
            {
                //  保存用户上传的信息
                $_tmp['name'] = $v;
                $_tmp['type'] = $_FILES['img_name']['type'][$k];
                $_tmp['tmp_name'] = $_FILES['img_name']['tmp_name'][$k];
                $_tmp['size'] = $_FILES['img_name']['size'][$k];
                $_FILES['tmp'] = $_tmp;
                //   上传图片
                $image = '/uploads/'.$upload->upload('tmp','goods');
                $stmt->execute([
                    $image,
                    $goodId
                ]);
            }
        }
        

        //  添加属性
        //  预处理
        $stmt = $this->_pdo->prepare("INSERT INTO goods_attribute(attr_name,attr_value,goods_id) VALUES(?,?,?)");
        foreach($_POST['attr_name'] as $k=>$v){
            $stmt->execute([
                $v,
                $_POST['attr_value'][$k],
                $goodId
            ]);
        };
        
        //  添加skuid
        $stmt = $this->_pdo->prepare("INSERT INTO goods_sku(sku_name,stock,price,goods_id) VALUES(?,?,?,?)");
        foreach($_POST['sku_name'] as $k=>$v)
        {
            $stmt->execute([
                $v,
                $_POST['stock'][$k],
                $_POST['price'][$k],
                $goodId
            ]);
        }
    }
}
<?php
namespace models;

class article extends model
{
    //   表名
    protected $table = 'article';
    //   白名单
    protected $fillable = ['title','content','link','article_category_id'];

    //  取出所有数据，并且   将获取到的分类id   数字，进行文字化
    public function disable()
    {   
        $data = $this->findAll();
        $stmt = $this->_pdo->prepare('SELECT cat_name FROM article_category WHERE id = ?');
        static $arr = [];
        static $array = [];
        foreach($data['data'] as $k=>$v)
        {
            $stmt->execute([
                $v['article_category_id']
            ]);
            $arr[] = $stmt->fetch(\PDO::FETCH_ASSOC);
            
            //  将二维数组转换为一维数组
            foreach($arr as $b=>$a)
            {
                $array['cat_name'] = $a['cat_name'];
            }
            
            $data['data'][$k]['cat_name'] = $array['cat_name'];
        }
        return $data;
    }
}
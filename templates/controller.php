
namespace controllers;

class <?=$name?>Controller
{
    // 分类首页
    public function index()
    {
        //  查询所有
        $<?=$tableName?> = new \models\<?=$tableName?>;
        $data = $<?=$tableName?>->findAll();
        view('<?=$tableName?>/index',$data);
    }
    //  创建分类
    public function create()
    {

        view('<?=$tableName?>/create');
    }
    //  处理添加分类表单
    public function add()
    {
        //  调用模型
        $<?=$tableName?> = new \models\<?=$tableName?>;
        //  传输数据
        $<?=$tableName?>->fill($_POST);
        //  添加数据
        $<?=$tableName?>->insert();
        //  跳转页面
        redirect('/<?=$tableName?>/index');
    }
    //   编辑分类
    public function edit()
    {
        //  获取原数据
        $<?=$tableName?> = new \models\<?=$tableName?>;
        //  接收数据
        $data = $<?=$tableName?>->find($_GET['id']);
        view('<?=$tableName?>/edit',[
            'data'=>$data
        ]);
    }
    //  处理编辑分类表单
    public function modify()
    {
        //  调用模型
        $<?=$tableName?> = new \models\<?=$tableName?>;
        //  传输数据
        $<?=$tableName?>->fill($_POST);
        //  添加数据
        $<?=$tableName?>->update($_GET['id']);
        redirect('/<?=$tableName?>/index');
    }
    //  删除分类
    public function delete()
    {
        $<?=$tableName?> = new \models\<?=$tableName?>;
        //  删除数据
        $<?=$tableName?>->delete($_GET['id']);
        redirect('/<?=$tableName?>/index');
    }
}
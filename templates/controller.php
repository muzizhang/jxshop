
namespace controllers;

class <?=$name?>Controller
{
    // 分类首页
    public function index()
    {
        view('<?=$tableName?>/index');
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
        <?=$tableName?> = new \models\<?=$tableName?>;
        <?=$tableName?>->fill($_POST);
    }
    //   编辑分类
    public function edit()
    {
        view('<?=$tableName?>/create');
    }
    //  处理编辑分类表单
    public function modify()
    {

    }
    //  删除分类
    public function delete()
    {
        view('<?=$tableName?>/create');
    }
}
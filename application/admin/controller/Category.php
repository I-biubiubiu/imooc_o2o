<?php
namespace app\admin\controller;
use think\Controller;

class Category extends Controller
{
    private $obj;

    // 初始化
    public function initialize() {
        $this->obj = model("Category");
    }
    
    // 主视图
    public function index()
    {
        return $this->fetch();
    }

    // 添加视图
    public function add()
    {
        $categorys = $this->obj->getNormalFirstCategory();

        return $this->fetch('', [
            'categorys' => $categorys
        ]);
    }

    // 添加保存
    public function save()
    {
        $data = request()->post();
        $validate = validate('Category');
        if(!$validate->scene('add')->check($data)) {
            dump($validate->getError());
        }

        $res = $this->obj->add($data);
        if($res) {
            $this->success('新增成功');
        } else {
            $this->error('新增失败');
        }
    }
}

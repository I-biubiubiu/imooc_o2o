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
        $parentId = request()->param('parent_id', 0, 'intval');

        $categorys = $this->obj->getFirstCategorys($parentId);

        $this->assign('categorys', $categorys);
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
        if(!request()->isPost()) {
            $this->error('请求失败');
        }
        $data = request()->post();
        $validate = validate('Category');
        if(!$validate->scene('add')->check($data)) {
            dump($validate->getError());
        }

        // 判断是否进入编辑操作
        if(!empty($data['id'])) {
            return $this->update($data);
        }

        $res = $this->obj->add($data);
        if($res) {
            $this->success('新增成功');
        } else {
            $this->error('新增失败');
        }
    }
 
    // 编辑视图
    public function edit($id = 0)
    {
        if (intval($id) < 1) {
            $this->error('参数不合法');
        }

        $category = $this->obj->get($id);
        $categorys = $this->obj->getNormalFirstCategory();

        $this->assign([
            'categorys' => $categorys,
            'category'  => $category
        ]);
        return $this->fetch();
    }

    // 编辑保存
    public function update($data)
    {
        $res = $this->obj->save($data, ['id' => intval($data['id'])]);
        if($res) {
            $this->success('更新成功');
        } else {
            $this->error('更新失败');
        }
    }

    // 排序逻辑
    public function listorder($id, $listorder)
    {
        $res = $this->obj->save(['listorder'=>$listorder], ['id'=>$id]);
        if($res) {
            $this->result($_SERVER['HTTP_REFERER'], 1, 'success');
        } else {
            $this->result($_SERVER['HTTP_REFERER'], 0, '更新失败');
        }
    }

    // 修改状态
    public function status()
    {
        $data = request()->get();

        $res = $this->obj->save(['status'=>$data['status']], ['id'=>$data['id']]);
        if($res) {
            $this->success('状态更新成功');
        } else {
            $this->error('状态更新失败');
        }
    }
}

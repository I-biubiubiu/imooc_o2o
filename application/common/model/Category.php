<?php
namespace app\common\model;

use think\Model;

class Category extends Model
{
    protected $autoWriteTimestamp = true;

    // 添加保存操作
    public function add($data)
    {
        $data['status'] = 1;
        return $this->save($data);
    }

    // 查询分类操作
    public function getNormalFirstCategory()
    {
        $data = [
            'status'    => 1,
            'parent_id' => 0
        ];

        $order = [
            'id' => 'desc'
        ];

        return $this->where($data)
            ->order($order)
            ->select();
    }

    // 查询操作
    public function getFirstCategorys($parentId = 0)
    {
        $data = [
            'parent_id' => $parentId,
        ];

        $order = [
            'listorder' => 'desc',
            'id' => 'desc',
        ];

        $result = $this->where($data)
            ->where('status', '<>', -1)
            ->order($order)
            ->paginate();

        return $result;
    }

    // 查询分类
    public function getNormalCategoryByParentId($parentId=0)
    {
        $data = [
            'status' => 1,
            'parent_id' => $parentId
        ];

        $order = [
            'id' => 'desc'
        ];

        return $this->where($data)
            ->order($order)
            ->select();
    }
}
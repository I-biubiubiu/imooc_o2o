<?php
namespace app\api\controller;
use think\Controller;

class Category extends Controller
{
    // 获取分类子级
    public function getCategoryByParentId()
    {
        $parentId = request()->param('id', 0, 'intval');
        
        if(!$parentId) {
            $this->error('ID不合法');
        }

        // 通过parentId获取二级分类
        $category = model('Category')->getNormalCategoryByParentId($parentId);

        if(count($category) == 0) {
            return show(0, 'error');
        }

        return show(1, 'success', $category);
    }
}
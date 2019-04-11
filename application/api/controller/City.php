<?php
namespace app\api\controller;
use think\Controller;

class City extends Controller
{
    // 获取城市子级
    public function getCitysByParentId()
    {
        $parentId = request()->param('id');
        
        if(!$parentId) {
            $this->error('ID不合法');
        }

        // 通过parentId获取二级城市
        $citys = model('City')->getNormalCitysByParentId($parentId);

        if(count($citys) == 0) {
            return show(0, 'error');
        }

        return show(1, 'success', $citys);
    }
}
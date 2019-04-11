<?php
namespace app\bis\controller;
use think\Controller;

class Register extends Controller
{
    // 商家入住申请页
    public function index()
    {
        // 获取一级城市的数据
        $citys = model('City')->getNormalCitysByParentId();
        // 获取一级栏目的数据
        $categorys = model('Category')->getNormalCategoryByParentId();

        $this->assign([
            'citys' => $citys,
            'categorys' => $categorys
        ]);
        
        return $this->fetch();
    }

    public function aaa()
    {
        var_dump(date('Y-m-d', strtotime('last day of')));
    }

}

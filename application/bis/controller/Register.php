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

    // 执行保存
    public function add()
    {
        if(!request()->isPost()) {
            $this->error('请求错误');
        }

        $data = request()->post();

        // 获取经纬度
        $lnglat = \Map::getLngLat($data['address']);
        if(empty($lnglat) || $lnglat['status'] != 0 || $lnglat['result']['precise'] != 1) {
            $this->error('无法获取数据, 或者匹配的地址不精确');
        }

        // 商户基本信息入库
        $bisData = [
            'name' => $data['name'],
            'city_id' => $data['city_id'],
            'city_path' => empty($data['se_city_id']) ? $data['city_id'] : $data['city_id'].','.$data['se_city_id'],
            'logo' => $data['logo'],
            'licence_logo' => $data['licence_logo'],
            'description' => empty($data['description']) ? '' : $data['description'],
            'bank_info' => $data['bank_info'],
            'bank_user' => $data['bank_user'],
            'bank_name' => $data['bank_name'],
            'faren' => $data['faren'],
            'faren_tel' => $data['faren_tel'],
            'email' => $data['email']
        ];

        $bisId = model('Bis')->add($bisData);
        
        // 总店相关信息入库
        $data['cat'] = '';
        if(!empty($data['se_category_id'])) {
            $data['cat'] = implode('|', $data['se_category_id']);
        }

        $locationData = [
            'bis_id' => $bisId,
            'name' => $data['name'],
            'tel' => $data['tel'],
            'contact' => $data['contact'],
            'category_id' => $data['category_id'],
            'category_path' => $data['category_id'] . ',' . $data['cat'],
            'city_id' => $data['city_id'],
            'city_path' => empty($data['se_city_id']) ? $data['city_id'] : $data['city_id'].','.$data['se_city_id'],
            'address' => $data['address'],
            'open_time' => $data['open_time'],
            'content' => empty($data['content']) ? '' : $data['content'],
            'is_main' => 1, // 代表的是总店信息
            'xpoint' => empty($lnglat['result']['location']['lng']) ? '' : $lnglat['result']['location']['lng'],
            'ypoint' => empty($lnglat['result']['location']['lat']) ? '' : $lnglat['result']['location']['lat']
        ];

        $locationId = model('BisLocation')->add($locationData);

        // 账户相关信息入库
        $data['code'] = mt_rand(100, 10000);

        $accounData = [
            'bis_id' => $bisId,
            'username' => $data['username'],
            'code' => $data['code'],
            'password' => md5($data['password'] . $data['code']),
            'is_main' => 1 //代表的是总管理员
        ];
    }

}

<?php
namespace app\admin\controller;
use think\Controller;

class Bis extends Controller
{
    // 入驻申请列表
    public function apply()
    {
        $bis = model('Bis')->getBisStatus();

        $this->assign('bis', $bis);

        return $this->fetch();
    }

    // 入驻申请编辑页
    public function detail()
    {
        $id = request()->param('id');
        if(empty($id)) {
            return $this->error('ID错误');
        }
        // 获取一级城市的数据
        $citys = model('City')->getNormalCitysByParentId();
        // 获取一级栏目的数据
        $categorys = model('Category')->getNormalCategoryByParentId();
        // 获取商户数据
        $bisData = model('Bis')->get($id);
        $locationData = model('BisLocation')->get(['bis_id'=>$id, 'is_main'=>1]);
        $accountData = model('BisAccount')->get(['bis_id'=>$id, 'is_main'=>1]);


        $this->assign([
            'citys' => $citys,
            'categorys' => $categorys,
            'bisData' => $bisData,
            'locationData' => $locationData,
            'accountData' => $accountData
        ]);
        return $this->fetch();
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

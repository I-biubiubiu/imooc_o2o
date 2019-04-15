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
        return $this->fetch();
    }
}

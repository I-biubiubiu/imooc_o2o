<?php
namespace app\admin\controller;
use think\Controller;

class Index extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

    public function welcome()
    {
        \Map::getLngLat('北京市海淀区上地十街10号');
    }
}

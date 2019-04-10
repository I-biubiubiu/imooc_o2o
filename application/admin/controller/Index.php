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

    public function map()
    {
        return \Map::staticimage('北京市海淀区上地十街10号');
    }

    public function email()
    {
        \phpmailer\Email::send(1,1,1);
        return '发送邮件成功';
    }
}

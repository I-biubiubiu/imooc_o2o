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
        \phpmailer\Email::send('363310279@qq.com','这是标题','这是内容');
        return '发送邮件成功';
    }
}

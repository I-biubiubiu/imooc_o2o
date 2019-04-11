<?php
namespace app\bis\controller;
use think\Controller;

class Login extends Controller
{
    // 登陆页
    public function index()
    {
        return $this->fetch();
    }
}
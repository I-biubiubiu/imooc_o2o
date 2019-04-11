<?php
namespace app\api\controller;

use think\Controller;
use think\Request;

class Image extends Controller
{
    public function upload()
    {
        $file = request()->param();
        dump($file);exit();
    }
}
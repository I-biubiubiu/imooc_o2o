<?php
namespace app\api\controller;

use think\Controller;

class Image extends Controller
{
    public function upload()
    {
        $file = request()->file();
        // 移动到指定目录
        $info = $file["file"]->move('upload');
        
        if($info && $info->getSaveName()) {
            return show(1, 'success', '/upload/'.$info->getSaveName());
        }

        return show(0, 'upload error');
    }
}
<?php
namespace app\admin\validate;

use think\Validate;

class Category extends validate
{
    protected $rule = [
        'name'      => 'require|max:10',
        'parent_id' => 'number',
        'id'        => 'number',
        'status'    => 'number|in:-1,0,1',
        'listorder' => 'number'
    ];

    protected $message = [
        'name.require'  => '分类名必须传递',
        'name.max'      => '分类名不能超过10个字符',
        'status.number' => '状态必须是数字',
        'status.in'     => '状态范围不合法'
    ];

    protected $scene = [
        'add'       => ['name', 'parent_id', 'id'],
        'listorder' => ['id', 'listorder'],
        'status'    => ['id', 'status']
    ];
}
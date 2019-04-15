<?php
namespace app\common\model;

use think\Model;

/**
 * 公共的model层
 */
class BaseModel extends Model
{
    protected $autoWriteTimestamp = true;

    // 添加保存操作
    public function add($data)
    {
        $data['status'] = 0;
        $this->save($data);

        // 返回新增id
        return $this->id;
    }

   
}
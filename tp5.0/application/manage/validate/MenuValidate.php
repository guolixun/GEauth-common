<?php
namespace app\manage\validate;

use think\Validate;

class MenuValidate extends Validate
{

    protected $rule = [
        'name'       => 'require',
        'app'        => 'require',
        'controller' => 'require',
        //'parent_id'  => 'checkParentId',
        'action'     => 'require|unique:Menus,app^controller^action',
    ];

    protected $message = [
        'name.require'       => '名称不能为空',
        'app.require'        => '应用不能为空',
        //'parent_id'          => '超过了4级',
        'controller.require' => '名称不能为空',
        'action.require'     => '名称不能为空',
        'action.unique'      => '同样的记录已经存在!',
    ];
}
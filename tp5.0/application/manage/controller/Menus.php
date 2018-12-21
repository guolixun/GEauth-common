<?php
namespace app\manage\controller;

use think\Controller;
use app\manage\service\MenusService;

class Menus extends Controller
{

    public function index()
    {
        if(request()->isAjax()){
            //code与data参数不能少，否则前端treeGrid会报错
            $data['code'] = 0;
            $data['data'] = MenusService::_initMenu();
            return json($data);
        }
        return $this->fetch();
    }

    public function lists()
    {
        return $this->fetch();
    }

    public function addMenu()
    {
        if(request()->isAjax()){
            return json(MenusService::initTree());
        }

        return $this->fetch();
    }

    public function addPost()
    {
        if(request()->isPost()){
            $validate = validate('MenuValidate');
            if($result = $validate->check($data = request()->param()) !== true){
                return json(['msg' => $result,'code' => 0]);
            } else {

                db('menus')->insert($data);
                //cache(null, 'menus');// 删除后台菜单缓存
                return json(['msg' => '添加成功','code' => 1]);
            }
        }
    }

}
<?php
namespace app\manage\service;

use think\Db;

class MenusService
{

    public static function initTree()
    {
        $mySelf = new self();

        return $treeArr = $mySelf->getChild($mySelf::_initMenu());
    }

    public static function _initMenu()
    {
        return db('menus')->where('status',1)->field('id,name,parent_id,list_order')->order(["list_order" => "ASC"])->select();
    }

    private function getChild($arr,$myId = 0)
    {
        $newArr = [];
        if (is_array($arr)) {
            foreach ($arr as $k => $v) {
                if($v['parent_id'] == $myId){
                    $v['open'] = true;
                    $v['children'] = $this->getChild($arr,$v['id']);
                    $newArr[] = $v;
                }
            }
        }
        return $newArr ? $newArr : false;
    }
}
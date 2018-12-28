<?php

namespace epii\admin\ui\demo;

use epii\admin\ui\lib\i\epiiadmin\IEpiiAdminUi;

/**
 * Created by PhpStorm.
 * User: mrren
 * Date: 2018/12/28
 * Time: 2:03 PM
 */
class DemoUi implements IEpiiAdminUi
{

    public function getConfig()
    {
        // TODO: Implement getConfig() method.
    }

    public function getLeftMenuData()
    {
        // TODO: Implement getLeftMenuData() method.
        return [
            ["id" => 1, "name" => "仪表盘", "url" => "http://www.baidu.com", "icon" => " fa fa-dashboard", "pid" => 0],

            ["id" => 4, "name" => "仪表盘3", "url" => "http://www.baidu.com", "icon" => " fa fa-circle-o", "pid" => 1],
            ["id" => 5, "name" => "小组件", "url" => "http://www.baidu.com", "icon" => " fa fa-th", "pid" => 0],


            ["header" => 1, "title" => "其它设置", "after_id" => 5],
            ["id" => 6, "name" => "开发文档", "url" => "http://docs.epii-admin.epii.cn", "icon" => " fa fa-circle-o text-danger", "pid" => 0],

        ];
    }

    public function getTopRightNavs()
    {
        // TODO: Implement getTopRightNavs() method.
        return [];
    }

    public function getMenuActiveId()
    {
        // TODO: Implement getMenuActiveId() method.
        return 4;
    }

    public function isMenuAllOpen()
    {
        // TODO: Implement isMenuAllOpen() method.
        return true;
    }
}
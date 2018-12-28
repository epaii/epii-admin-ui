<?php
/**
 * Created by PhpStorm.
 * User: mrren
 * Date: 2018/6/29
 * Time: ����9:09
 */

namespace epii\admin\ui\lib\i\epiiadmin;


interface IEpiiAdminUi
{

    public function getConfig();
    public function getLeftMenuData();

    public function getTopRightNavs();

    public function getMenuActiveId();
    public function isMenuAllOpen();
}
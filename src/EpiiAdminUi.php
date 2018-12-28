<?php
namespace epii\admin\ui;

use epii\admin\ui\lib\epiiadmin\EpiiAdminMenu;
use epii\admin\ui\lib\i\epiiadmin\IEpiiAdminUi;


/**
 * Created by PhpStorm.
 * User: mrren
 * Date: 2018/12/28
 * Time: 1:21 PM
 */
class EpiiAdminUi
{
    private static $common_config = [

        "static_url_pre" => "https://epaii.github.io/epii-admin/public/epiiadmin-js/",
        "js_app_dir" => "static/js/app/",
        "site_url" => ""

    ];


    public static function setBaseConfig(Array $config)
    {
        if ($config)
            self::$common_config = array_merge(self::$common_config, $config);
    }


    public static function showTopPage(IEpiiAdminUi $adminUi)
    {


        $_data_ = array_merge([
            "user_avatar" => self::$common_config["static_url_pre"] . "img/user2-160x160.jpg",
            "user_name" => "Alexander Pierce",
            "site_logo_show" => self::$common_config["static_url_pre"] . "img/AdminLTELogo.png",
            "site_name_show" => "管理中心",
            "site_title" => "管理中心",
            "app_theme" => "danger",
            "app_left_theme" => "light",

        ], self::$common_config);
        $_config = $adminUi->getConfig();
        if ($_config) {
            $_data_ = array_merge($_data_, $_config);
        }
        $navsclass = $adminUi->getTopRightNavs();
        $navs = "";
        foreach ($navsclass as $nav) {
            if (is_string($nav) && class_exists($navs)) {
                $nav_mod = new $navs();
            } else {
                $nav_mod = $nav;
            }
            if (method_exists($nav_mod, "getHtml")) {
                $navs .= $nav_mod->getHtml();
            }

        }
        $_data_["navlist"] = $navs;


        $menu = $adminUi->getLeftMenuData();

        $siteuserinfo['menu'] = $menu;
        $siteuserinfo['menu_open'] = $adminUi->isMenuAllOpen();
        $siteuserinfo['menu_active_id'] = (int)$adminUi->getMenuActiveId();

        $asider = new EpiiAdminMenu();

        $_data_["menulist"] = $asider->getAsideHtml($siteuserinfo);

        $_ui_ = array_merge($_data_, self::getJsArgs(["title" => $_data_["site_title"], "isTop" => 1]));


        // print_r($_ui_);

        require_once __DIR__ . "/app/view/index/index.php";


    }

    public static function showPage(string $__CONTENT__, Array $data = [], string $appName = null)
    {
        $_ui_ = array_merge(["site_title" => isset($data["title"]) ? $data["title"] : ""], self::$common_config, self::getJsArgs($data));
        if ($appName) {
            $data["appName"] = $appName;
        }
        require_once __DIR__ . "/app/view/common/layout.php";
    }

    private static function getJsArgs($data_args = [])
    {
        $data = [
            "baseUrl" => self::$common_config["static_url_pre"] . "js/",
            "appUrl" => self::$common_config["js_app_dir"],
            "pluginsUrl" => "./plugins/",
            "epiiInitFunctionsName" => "epiiInitFunctions",
            "init_models" => [],
            "min" => ".min",
            "site_url" => self::$common_config["site_url"] ? self::$common_config["site_url"] : self::getUrl(),
            "version" => "0.0.1",
            "window_id" => md5(time()),
            "data" => ['title' => isset($js_data["title"]) ? $js_data["title"] : ""]
        ];

        if ($data_args)
            $data['data'] = array_merge($data['data'], $data_args);
        if (isset($data['data']['appName'])) $data['appName'] = $data['data']['appName'];
        return ["epiiargs_data" => json_encode($data)];
    }


    private static function is_https()
    {
        if (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off') {
            return true;
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
            return true;
        } elseif (!empty($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off') {
            return true;
        }
        return false;
    }

    private static function getUrl()
    {

        return (self::is_https() ? "https" : "http") . '://' . $_SERVER['HTTP_HOST'];
    }
}
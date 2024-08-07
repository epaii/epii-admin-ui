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
        "xxAdmin" => false,
        "xxAdmin_static_url_pre"=>"",
        "xxAdminSetting"=>[
            "setDarkTheme"=>false,
            "setAppTheme"=>null,
            "setNavMode"=>"vertical",// "vertical" | "horizontal";
            "setNavTheme"=>"dark",// "dark" | "light" | "header-dark";
            "setSettingBtnShow"=>true,
            "setSwitchTheme"=>true,
            "setNavDarkTheme"=>false
        ],
        "static_url_pre" => "https://epiiadmin-js.chinacloudsites.cn/",
        "fontawesome_fonts_url_pre" => "https://epiiadmin-js.chinacloudsites.cn/js/plugins/font-awesome/fonts/",
        "js_app_dir" => "static/js/app/",
        "site_url" => "",
        "version" => "0.0.8",
        "require_config_file" => "",
        "css" => [],
        "page_loading" => '<div style="display: flex;justify-content: center;align-items: center;height:90vh;font-size:25px">加载中...</div>',
        "page_loading_finish" => ' $("#___epii_loading").hide();$("#___epii_content").show("slow","linear");',
    ];

    public static function enableXxAdmin(bool $enable,string $static_pre=null,array $xxAdminSetting=[])
    {
        self::$common_config["xxAdmin"] = $enable;
        if(!$static_pre){
            self::$common_config["xxAdmin_static_url_pre"] = self::$common_config["static_url_pre"]."xx-admin/";
        }else{
            self::$common_config["xxAdmin_static_url_pre"]  = $static_pre;
        }

        self::$common_config["xxAdminSetting"]  = array_merge(self::$common_config["xxAdminSetting"] ,$xxAdminSetting);
    }

    public static function setBaseConfig(array $config)
    {
        if ($config) {
            self::$common_config = array_merge(self::$common_config, $config);
        }

    }

    private static $plugins_data = [];

    public static function addPluginData(string $key, string $value)
    {
        self::$plugins_data[$key] = $value;
    }

    public static function showTopPage(IEpiiAdminUi $adminUi, array $data = [], string $appName = null)
    {

        $_data_ = array_merge([
            "user_avatar" => self::$common_config["static_url_pre"] . "img/user2-160x160.jpg",
            "user_name" => "Alexander Pierce",
            "site_logo_show" => self::$common_config["static_url_pre"] . "img/AdminLTELogo.png",
            "site_name_show" => "管理中心",
            "site_title" => "管理中心",
            "app_theme" => "danger",
            "app_left_theme" => "light",
            "app_left_top_theme" => "danger",
            "app_left_selected_theme" => "danger",

        ], self::$common_config);
        $_config = $adminUi->getConfig()->getConfig();
        if ($_config) {
            $_data_ = array_merge($_data_, $_config);
        }

        $_data_["navlist"] = $adminUi->getTopRightNavHtml();

        $menu = $adminUi->getLeftMenuData();

        $siteuserinfo['menu'] = $menu->getConfig();
        $siteuserinfo['menu_open'] = $menu->_isAllOpened();
        $siteuserinfo['menu_active_id'] = $menu->_getActiveId();

        $asider = new EpiiAdminMenu();

        if (!self::$common_config["xxAdmin"]) {
            $_data_["menulist"] = $asider->getAsideHtml($siteuserinfo);
        } else {
            $_data_["siteuserinfo"] = $siteuserinfo;
        }

        if (!$data) {
            $data = [];
        }

        if ($appName) {
            $data["appName"] = $appName;
        }

        $_ui_ = array_merge($_data_, self::getJsArgs(array_merge(["title" => $_data_["site_title"], "isTop" => 1], $data)));

        if (self::$common_config["xxAdmin"]) {
            require_once __DIR__ . "/app/view/index/xxAdmin.php";

        } else {
            require_once __DIR__ . "/app/view/index/index.php";

        }

    }

    public static function showPage(string $__CONTENT__, array $data = [], string $appName = null)
    {
        if (!$data) {
            $data = [];
        }

        if ($appName) {
            $data["appName"] = $appName;
        }
        $_ui_ = array_merge(["site_title" => isset($data["title"]) ? $data["title"] : ""], self::$common_config, self::getJsArgs($data));
        require_once __DIR__ . "/app/view/common/layout.php";
    }

    private static function getJsArgs($data_args = [])
    {
        $data = [
            "baseUrl" => self::$common_config["static_url_pre"] . "js/",
            "appUrl" => stripos(self::$common_config["js_app_dir"], "http") === 0 ? self::$common_config["js_app_dir"] : (self::getUrl() . "/" . self::$common_config["js_app_dir"]),
            "pluginsUrl" => "./plugins/",
            "epiiInitFunctionsName" => "epiiInitFunctions",
            "init_models" => [],
            "min" => ".min",
            "site_url" => self::$common_config["site_url"] ? self::$common_config["site_url"] : self::getUrl(),
            "version" => self::$common_config["version"],
            "window_id" => md5(time()),
            "require_config_file" => self::$common_config["require_config_file"] ? self::$common_config["require_config_file"] : "",
            "data" => ['title' => isset($data_args["title"]) ? $data_args["title"] : ""],
            "pluginsData" => self::$plugins_data,
        ];

        if ($data_args) {
            $data['data'] = array_merge($data['data'], $data_args);
        }

        if (isset($data['data']['appName'])) {
            $data['appName'] = $data['data']['appName'];
        }
  
        
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

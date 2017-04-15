<?php
namespace Tiny;
/**
 * TinyPHP 应用程序类 执行应用过程管理
 */
class App
{
    public static function run(){
        //全局粗过滤
        array_walk_recursive($_GET,'tiny_fliter');
        array_walk_recursive($_POST,'tiny_fliter');
        array_walk_recursive($_REQUEST,'tiny_fliter');

        //执行应用程序
        APP::execute();
    }

    /**
     * 正式执行应用程序
     */
    public static function execute(){
        //解析PATH_INFO
        $pathinfo=explode("/",$_SERVER[PATH_INFO]);
        if($pathinfo[0]=='')
            $controller=DEFAULT_CONTROLLER;
        else{
            //安全过滤
            $controller=$pathinfo[0];
        }
        if($pathinfo[1]=='')
            $action=DEFAULT_ACTION;
        else{
            //安全过滤
            $action=$pathinfo[1];
        }

        //运行控制器->动作
        controller($controller,$action);
    }


}
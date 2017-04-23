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
        if($pathinfo[1]=='')
            $controller=DEFAULT_CONTROLLER;
        else{
            //安全过滤
            $controller=$pathinfo[1];
        }
        if($pathinfo[2]=='')
            $action=DEFAULT_ACTION;
        else{
            //安全过滤
            $action=$pathinfo[2];
        }

        //运行控制器
        $module=controller($controller);
        if(!$module)
            exit("can not open controller");

        //执行当前操作
        if (!method_exists($module,$action)) exit("can not find action");
        $method=new \ReflectionMethod($module,$action);
        if ($method->isPublic()&&!$method->isStatic()){
            //$class=\ReflectionClass($module);
            $method->invoke($module);
        }else{
            exit("action is not public or action is static");
        }

    }


}
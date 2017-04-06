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

        
    }
}
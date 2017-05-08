<?php
namespace Tiny;
/**
 * 数据库中间层实现类
 */
class Db
{
    static private $instance=array();   //数据库连接实例
    static private $_instance=null;     //当前数据库连接实例

    static public function getInstance(){
        $md5=md5(serialize(''));
        if(!isset($instance[$md5])){
            $option=self::parseConfig();
            if($option['DB_TYPE']!=='mysql') exit('database is not mysql');
            $class='Tiny\\Db\\Driver\\'.ucwords(strtolower($option['DB_TYPE']));
            if(class_exists($class)){
                self::$instance[$md5]=new $class($option);
            }else{
                exit('can not find '.$class);
            }
            self::$_instance[$md5]=self::$instance[$md5];
            var_dump(self::$instance[$md5]);
            return self::$_instance;
        }
    }

    static private function parseConfig(){
        $config=load_config(APP_CONF.'config.php');
        return $config;
    }
}
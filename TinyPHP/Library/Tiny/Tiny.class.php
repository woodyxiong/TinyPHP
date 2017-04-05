<?php
namespace Tiny;
class Tiny{
    //类映射
    private static $_map=array();

    /**
     * 应用程序初始化
     */
    public static function begin(){
        //注册AUTOLOAD方法
        spl_autoload_register('Tiny\Tiny::autoload');
        //设定错误和异常处理

        include TINY_COMMON.'function.php';
        T('loadTime');
    }

    public static function autoload($class){
        //是否存在类映射
        if(isset(self::$_map[$class])){
            include self::$_map[$class];
        }elseif(false!==strpos($class,'\\')){
            $name=strstr($class,'\\',true);
            $filename=TINY_LIB.$class.EXT;
            if(is_file($filename))
                include $filename;
        }
    }
}
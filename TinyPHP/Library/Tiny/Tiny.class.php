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
        error_reporting(E_ALL || ~E_NOTICE); //显示除去 E_NOTICE 之外的所有错误信息

        include TINY_COMMON.'function.php';
        T('loadTime');

        //运行应用
        App::run();
    }

    public static function autoload($class){
        //是否存在类映射
        if(isset(self::$_map[$class])){
            include self::$_map[$class];
        }elseif(false!==strpos($class,'\\')){
            $namespace=strstr($class,'\\',true);
            //linux环境下,对'\'和'/'敏感
            $class=str_ireplace('\\','/',$class);

            //若为Tiny系统类
            if(is_dir(TINY_LIB.$namespace)){
                $filename=TINY_LIB.$class.EXT;
            }
            //业务类
            else{
                $filename=APP_PATH.$class.EXT;
            }
            if(is_file($filename)){
                include $filename;
                self::$_map[$class]=$filename;
            }
        }
    }
}

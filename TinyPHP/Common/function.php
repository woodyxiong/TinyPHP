<?php
/**
 * 设置cookie
 * @param  string $name  名称
 * @param  string $value 值
 * @return mixed 若只有一个参数，则返回值
 */
function cookie($name='',$value='',$option=array()){
    if(empty($name)&&empty($value)){
        // 都为空,返回整个$_COOKIE
        return $_COOKIE;
    }elseif(is_null($value)){
        //清空cookie
        setcookie($name,time()-3600);
        unset($_COOKIE[$name]);
        return null;
    }elseif(empty($value)){
        //只有一个值，则返回cookie值
        return $_COOKIE[$name];
    }else{
        //两个值都有，设置cookie
        if(empty($option)){
            $option=load_config(APP_CONF.'cookie.php');
        }
        $result=setcookie($name,$value,$option['COOKIE_EXPIRE'],$option['COOKIE_PATH'],$option['COOKIE_DOMAIN']);
        // 返回是否添加cookie的结果
        return $result;
    }
}

/**
 * 设置session
 * @param  string $name  名称
 * @param  string $value 值
 * @return mixed
 */
function session($name='',$value=''){
    if(empty($name)){
        // 都为空，返回所有$_SESSION
        return $_SESSION;
    }elseif(is_null($value)){
        // 删除session
        unset($_SESSION[$name]);
        return null;
    }elseif(empty($value)){
        // 返回session值
        return $_SESSION[$name];
    }else{
        // 设置session
        $_SESSION[$name]=$value;
        return null;
    }
}

/**
 * 记录和统计时间（微秒）和内存使用情况
 * 使用方法:
 * <code>
 * T('begin'); // 记录开始标记位
 * // ... 区间运行代码
 * T('end'); // 记录结束标签位
 * echo G('begin','end',6); // 统计区间运行时间 精确到小数后6位
 * echo G('begin','end','m'); // 统计区间内存使用情况
 * 如果end标记位没有定义，则会自动以当前作为标记位
 * 其中统计内存使用需要 MEMORY_LIMIT_ON 常量为true才有效
 * </code>
 * @param $start
 * @param string $end
 * @param int $dec
 * @return 综上所述
 */
function T($start,$end='',$dec=6){
    static $_time=array();
    static $_mem=array();
    if(is_float($end)){//记录时间
        $_time[$start]=$end;
    }elseif(!empty($end)){//统计时间和内存使用
        if(!isset($_time[$end]))
            $_time[$end]=microtime(true);
        if(MEMORY_LIMIT_ON && $dec=='m'){
            if(!isset($_mem[end]))
                $_mem[end]=memory_get_usage();
            return number_format(($_mem[$end]-$_mem[$start])/1024).'M';
        } else{
            return number_format(($_time[$end]-$_time[$start]),$dec).'S';
        }
    }else{//记录时间和内存时间
        $_time[$start]=microtime(true);
        if(MEMORY_LIMIT_ON)
            $_mem[$start]=memory_get_usage();
    }
    return null;
}

//控制器
function controller($controller){
    //$controller变成大写
    $controller=substr_replace($controller,strtoupper(substr($controller,0,1)),0,1);

//    $class=Home\Controller\IndexController
    $class='Home'.'\\'.'Controller';
    $class =$class.'\\'.$controller.'Controller';

    if(class_exists($class)){
        return new $class();
    }else{
        return false;
    }
}

/**
 * 加载配置
 * @param  string $file 配置文件路径
 */
function load_config($file){
    if(is_file($file)){
        return include $file;
    }else{
        exit($file.' is not existence');
    }
}

/**
 * @param string $config    数据库配置
 * @return mixed object     数据库实例
 */
function M($config=array()){
    //执行默认配置
    if(empty($config)){
        $config=load_config(APP_CONF.'db.php');
    }
    static $_model=array();
    $class='Tiny\\Model';
    $guid=md5(serialize($config));
    if(!isset($_model[$guid])){
        $_model[$guid]=new $class($config);
    }
    return $_model[$guid];
}

/**
 * var_dump
 * @param [type] $value 需要打印的变量
 */
function D($var, $echo=true, $label=null, $strict=true) {
    ob_start();
    var_dump($var);
    $output = ob_get_clean();
    $output = preg_replace('/\]\=\>\n(\s+)/m', '] => ', $output);
    $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
    echo($output);
}

//全局变量全部过滤
//貌似是粗过滤
function tiny_filter(&$value){
    if(preg_match("asdfasgasgasdfasfdasgfdasg",$value)){
        $value .= ' ';//貌似是加一个空格
    }
}

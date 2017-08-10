<?php
//记录开始运行时间
$GLOBALS['_beginTime'] = microtime(TRUE);

//默认控制器
defined('DEFAULT_CONTROLLER') or define('DEFAULT_CONTROLLER','index');
//默认操作
defined('DEFAULT_ACTION') or define('DEFAULT_ACTION','index');

//系统常量定义
defined('APP_DEBUG') or define('APP_DEBUG',false);						//是否开启debug
defined('APP_PATH') or define('APP_PATH', 'Home/');						//应用目录
defined('APP_HOME') or define('APP_HOME', APP_PATH.'Home/');			//应用目录home
defined('APP_RUNTIME') or define('APP_RUNTIME', APP_PATH.'Runtime/');	//应用目录runtime

defined('APP_CONF') or define('APP_CONF', APP_HOME.'Conf/');			//应用目录Home/Home/Conf
defined('APP_CONT') or define('APP_CONT', APP_HOME.'Controller/');		//应用目录Home/Home/Controller
defined('APP_VIEW') or define('APP_VIEW', APP_HOME.'View/');			//应用目录Home/Home/View
defined('APP_COMMON') or define('APP_COMMON', APP_HOME.'Common/');			//应用目录Home/Home/Common

defined('APP_LOG') or define('APP_LOG', APP_RUNTIME.'Log/');			//应用目录Home/Runtime/Log
defined('APP_CACHE') or define('APP_CACHE', APP_RUNTIME.'Cache/');		//应用目录Home/Runtime/Cache

//版本信息
const TINY_VERSION     =   '1.0.0';

//类文件后缀
const EXT               =   '.class.php';

//TinyPHP核心目录
defined('TINY') or define('TINY', __DIR__.'/');							//核心目录TinyPHP/
defined('TINY_LIB') or define('TINY_LIB', TINY.'Library/');				//核心目录TinyPHP/Library
defined('TINY_PATH') or define('TINY_PATH', TINY_LIB.'Tiny/');			//核心目录TinyPHP/Library/Tiny
defined('TINY_COMMON') or define('TINY_COMMON', TINY.'Common/');		//核心目录TinyPHP/Common
defined('TINY_CONF') or define('TINY_CONF', TINY.'Conf/');				//核心目录TinyPHP/Conf

//第三方库文件
defined('TINY_VENDOR') or define('TINY_VENDOR', TINY_LIB.'Vendor/');	//核心目录TinyPHP/Library/vendor

//加载核心类库
require TINY_PATH.'/Tiny'.EXT;
//应用初始化
Tiny\Tiny::begin();

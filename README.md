# tinyPHP

仿造thinkPHP开发的开源极简的PHP框架

## 安装环境
在本地开发环境是 ubuntu16.04+PHP7.0.18+MySQL5.7.19+nginx1.10.3

理论来说PHP>=5.3即可，因为框架有面向对象(还没有测试过）

数据库由PDO驱动，理论支持主流数据库

## 安装步骤
### 第一步
将源码下载
```
git clone git@github.com:woodyxiong/ss-panel.git
```

### 第二步

如果使用nginx,则将配置文件指向Web目录
```
server {
    listen	80;
    index index.php;
    server_name servername;
	root yourpath/TinyPHP/Web;
```

### 第三步

与thinkPHP类似，你可以自由在用户目录写业务代码

## 使用特性

### 渲染html页面

在业务层代码直接执行 `display()`函数
> 显示默认的视图模板
> Application/Home/View/Index/Index.html

```
public function index(){
    $this->display();
}
```
> 指定视图模板 Application/Home/View/Index/Index2.html

```
public function index(){
    $this->display('index2');
}
```

### 使用数据库
在 `Application/Home/Conf/db.php` 可对数据库信息进行配置
```
'DB_TYPE'   => 'mysql', // 数据库类型
'DB_HOST'   => 'localhost', // 服务器地址
'DB_NAME'   => 'databasename', // 数据库名
'DB_USER'   => 'databaseuser', // 用户名
'DB_PWD'    => 'password', // 密码
'DB_PORT'   => port, // 端口
'DB_PREFIX' => 'prex', // 数据库表前缀
'DB_CHARSET'=> 'utf8', // 字符集
```

>数据库操作方法

在业务层代码先用 `M()` 对数据库连接实例化，然后用 `excute()` 执行sql语句

用 `getLastSql()` 可获得上次执行的sql语句
```
public function sql(){
    $data=M()->execute('select * from camera');//执行sql语句
    $sql=M()->getLastSql();//获取上次的sql语句
}
```

### cookie操作
在 `Application/Home/Conf/db.php` 可对cookie进行配置
```
'COOKIE_EXPIRE' => 3600,   // Cookie有效期
'COOKIE_PATH'   => '',     // Cookie有效域名
'COOKIE_DOMAIN' => '/',    // Cookie作用域
```

>cookie操作方法

```
$cookie=cookie();//获取全部cookie
cookie('tinyPHP','very good');//设置名为tinyPHP的cookie为very good
$cookie['tinyPHP']=cookie('tinyPHP');//返回名为tinyPHP的cookie
cookie('tinyPHP',null);//清除名为tinyPHP的cookie信息
```

### session操作
在 `Application/Home/Conf/session.php` 可对session进行配置
```
'SESSION_NAME' => 'tinySSID',//session在cookie的名称
'SESSION_SAVEPATH' => '/var/lib/php/sessions',//session的存储路径
```
> session操作方法

```
$session=session();//获取全部cookie
session('tinyPHP','very good');//设置名为tinyPHP的session为very good
$session['tinyPHP']=session('tinyPHP');//返回名为tinyPHP的session
session('tinyPHP',null);//清除名为tinyPHP的cookie信息
```

### api的令牌操作

### 静态页面缓存

### php邮箱操作

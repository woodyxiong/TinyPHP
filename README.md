# tinyPHP

仿造thinkPHP开发的开源极简的PHP框架

## 安装环境
在本地开发环境是 ubuntu16.04+PHP7.0.18+MySQL5.7.19+nginx1.10.3

理论来说支持PHP>=5.3因为框架有面向对象(还没有测试过）

数据库

## 安装步骤
### 第一步
将源码下载
```
git clone git@github.com:woodyxiong/ss-panel.git ```
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
### 静态页面缓存
### 使用数据库
### cookie和session的操作
### api的令牌操作

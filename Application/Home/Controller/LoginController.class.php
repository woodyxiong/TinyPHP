<?php
namespace Home\Controller;
use Tiny\Controller\apiController;
class LoginController extends apiController{
    /**
     * 假定用户登录
     * 返回给用户token
     */
    public function auth(){
        // ...验证登录
        // 创建token
        $username='xk';
        $token=$this->createToken($username);
        // ...保存token到数据库或者缓存中
        // 将token发送给客户端
        $data['token']=$token;
        $this->success($data);
    }

    /**
     * 假定用户使用token
     * 来与服务器进行交互
     */
    public function example(){
        $token=$_GET['token'];
        $timestamp=$_GET['timestamp'];
        $sign=$_GET['sign'];

        $username=$this->getuser($token);
        if(!$username)
            exit('token错误');

        $ispasstoken=$this->checksession($token,$timestamp,$sign);
        if($ispasstoken){
            $data['username']=$username;
        }
        $this->success($data);

    }
    
    //测试函数
    public function test(){
        $token=$_GET['token'];
        $time=time();
        echo $time;
        echo "<br>";
        echo md5($token.$this->option['token_signsalt'].$time);
    }

    //找到用户名
    private function getuser($token){
        if($token=='4d94286ab3ad22b74e8af0deef4b0736'){
            return 'xk';
        }else{
            return false;
        }
    }




}

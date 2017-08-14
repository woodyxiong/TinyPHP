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
        $username='tinyPHP';
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
        $user=$this->getuser();
        //  获取token与user的关系
        // $username=$this->getuser($token);
        // 业务逻辑
        //  ...
        $data["username"]='tinyPHP';
        $this->success($data);
    }

    /**
     * 获取用户名
     * 由于是父类的虚函数，所以必须写
     */
    protected function getuser(){
        $token=$_GET['token'];
        $this->checkToken();
        if($token=="7cfb01bdac5fdd88f57556e0b3302702")
            return "tinyPHP";
        else
            $this->fail("106");
    }
    
    //测试函数
    public function test(){
        $token=$_GET['token'];
        $time=time();
        echo $time;
        echo "<br>";
        echo md5($token.$this->option['token_signsalt'].$time);
    }

}

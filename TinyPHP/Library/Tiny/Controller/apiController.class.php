<?php
namespace Tiny\Controller;
/**
 * tinyPHP 接口控制类 抽象类
 */
abstract class apiController{
    //向外输出的json数据
    public $json=array();
    //token配置
    protected $option=array();
    //错误列表
    protected $errorList=array();

    /**
     * 构造函数
     */
    public function __construct(){
        //初始化json结构
        $this->json = array('code' => null,'message'=>null,'data'=>array());
        //导入token配置
        $this->option=load_config(APP_CONF.'token.php');
        //导入错误列表
        $this->errorList=load_config(APP_CONF.'api.php');
    }

    /**
     * 一切成功,输出json数据
     * @param  array $data 数据
     */
    public function success($data){
        // 返回JSON数据格式到客户端 包含状态信息
        header('Content-Type:application/json; charset=utf-8');
        $this->json['code']='200';
        $this->json['message']=$this->errorList['200'];
        $this->json['data']=$data;
        echo json_encode($this->json);
    }

    /**
     * 生成token
     * @param  string $username  用户名
     * @return string            token
     */
    public function createToken($username){
        $timestamp=time();
        $token=md5($username.$this->option['token_serversalt'].$timestamp);
        return $token;
    }

    
    public function checksession($token,$timestamp,$sign){
        if((time()-$timestamp)>$this->option['token_expiretime']){
            //超时
            exit("超时");
        }
        $_sign=md5($token.$this->option['token_signsalt'].$timestamp);
        if($_sign!=$sign){
            //签名不一致
            exit("签名不一致");
        }
        return true;
    }






}

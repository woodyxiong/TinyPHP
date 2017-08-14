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
        $this->json = array('code' => null,'message'=>null,'data'=>null);
        //导入token配置
        $this->option=load_config(APP_CONF.'token.php');
        //导入错误列表
        $this->errorList=load_config(APP_CONF.'api.php');
    }

    /**
     * 成功,输出json数据
     * @param  array $data 数据
     */
    public function success($data){
        // 返回JSON数据格式到客户端 包含状态信息
        header('Content-Type:application/json; charset=utf-8');
        $this->json['code']='200';
        $this->json['message']=$this->errorList['200'];
        $this->json['data']=$data;
        echo json_encode($this->json);
        exit(0);
    }

    /**
     * 失败输出
     * @param string $code失败原因码
     */
    public function fail($code=''){
        if(empty($code)){
            $this->json['code']='0';
            $this->json['message']='unknow exception';
        }else{
            if(is_null($this->errorList[$code])){
                $this->json['code']='0';
                $this->json['message']='unknow exception';   
            }else{
                $this->json['code']=$code;
                $this->json['message']=$this->errorList[$code];
            }
        }
        // 返回JSON数据格式到客户端 包含状态信息
        header('Content-Type:application/json; charset=utf-8');
        echo json_encode($this->json);
        exit(0);
    }

    /**
     * 生成token
     * @param  string $username  用户名
     * @return string            token
     */
    public function createToken($username){
        if(is_null($username))
            exit("username is null");
        $timestamp=time();
        $token=md5($username.$this->option['token_serversalt'].$timestamp);
        return $token;
    }

    // 获得用户的id或名称啥的，因为是虚函数，所以必须也在子类声明
    abstract protected function getuser(); 

    /**
     * 验证token是否合法
     * @return mix
     */
    protected function checkToken(){
        $token=$_GET['token'];
        $timestamp=$_GET['timestamp'];
        $sign=$_GET['sign'];

        if(is_null($token))
            $this->fail("101");
        if(is_null($timestamp))
            $this->fail("102");
        if(is_null($sign))
            $this->fail("103");
        if((time()-$timestamp)>$this->option['token_expiretime']){
            $this->fail("104");
        }
        $_sign=md5($token.$this->option['token_signsalt'].$timestamp);
        if($_sign!=$sign){
            $this->fail("105");
        }
        return true;
    }
}

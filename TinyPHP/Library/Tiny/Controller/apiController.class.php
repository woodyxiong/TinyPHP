<?php
namespace Tiny\Controller;
/**
 * tinyPHP 接口控制类 抽象类
 */
abstract class apiController{
    //向外输出的json数据
    public $json=array();
    //数据内容
    public $data;
    //token配置
    private $option=array();
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
    public function jsonReturn($data){
        // 返回JSON数据格式到客户端 包含状态信息
        header('Content-Type:application/json; charset=utf-8');
        $json['code']='0';
        $json['message']=$this->errorList['0'];
        $json['data']=$data;
        echo json_encode($json);
    }








}

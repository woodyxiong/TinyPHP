<?php
namespace Tiny;
/**
 * TinyPHP 控制器基类 抽象类
 */
abstract class Controller{
    /**
     * 视图实例对象
     * @var view
     */
    protected $view=null;

    /**
     * 构造函数 获得View实例
     */
    public function __construct(){
        $this->view=new View;
    }

    /**
     * 模板赋值
     * @param  [type] $name  名
     * @param  string $value 键
     */
    public function assign($name,$value=''){
        $this->view->assign($name,$value);
    }

    /**
     * 调用模板引擎
     * @param  string $templateFile 模板名称
     */
    public function display($templateFile=''){
        $this->view->display($templateFile);
    }

    /**
     * 输出json数据
     * @param  array $data 数据
     */
    public function jsonReturn($data){
        // 返回JSON数据格式到客户端 包含状态信息
        header('Content-Type:application/json; charset=utf-8');
        exit(json_encode($data,$json_option));
    }
}

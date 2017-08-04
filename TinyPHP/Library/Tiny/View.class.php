<?php
namespace Tiny;
/**
 * Tiny 视图类
 */
class View{
    protected $tVar=array();

    /**
     * 模板变量赋值
     * @param  mixed $name  变量名
     * @param  string $value 变量值
     */
    public function assign($name,$value=''){
        if(is_array($name)){
            $this->tVar=array_merge($this->tVar,$name);
        }else{
            $this->tVar[$name]=$value;
        }
    }

    /**
     * 调用模板引擎显示
     * @param  string $templateFile 模板名称
     */
    public function display($templateFile=''){
        //获得模板路径
        $controller_name=ucfirst(CONTROLLER_NAME);
        if(empty($templateFile)){
            $templateFile=APP_HOME.'View/'.$controller_name.'/'.ACTION_NAME.'.html';
        }else{
            $templateFile=APP_HOME.'View/'.$controller_name.'/'.$templateFile.'.html';
        }
        //找不到模板
        if(!is_file($templateFile)) exit("can not find templatefile");

        
    }

}

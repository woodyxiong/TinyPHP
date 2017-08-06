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
        $templatePath=$this->fetch($templateFile);
        //获得模板数据
        $content=$this->getContent($templatePath);
        //渲染模板
        $this->render($content);
    }

    /**
     * 获得模板
     * @param  string $templateFile 模板文件名
     * @return string $templatePath 模板实际路径
     */
    private function fetch($templateFile=''){
        $controller_name=ucfirst(CONTROLLER_NAME);
        $templatePath='';
        if(empty($templateFile)){
            $templatePath=APP_HOME.'View/'.$controller_name.'/'.ACTION_NAME.'.html';
        }else{
            $templatePath=APP_HOME.'View/'.$controller_name.'/'.$templateFile.'.html';
        }
        //找不到模板
        if(!is_file($templatePath)) exit("can not find templatefile");
        return $templatePath;
    }

    /**
     * 获得输出到浏览器的文本
     * @param  string $templatePath 模板路径
     * @return [type]               文本内容
     */
    private function getContent($templatePath){
        //开始页面缓存
        ob_start();
        //强制不输出到浏览器
        ob_implicit_flush(0);
        //拆分变量
        extract($this->tVar,EXTR_OVERWRITE);
        include $templatePath;
        //获得从浏览器的输出
        $content=ob_get_clean();
        return $content;
    }

    /**
     * 添加header，渲染html页面
     * @param  string $content 模板内容
     */
    private function render($content){
        // 网页字符编码
        header('text/html;charset=UTF-8');
        header('X-Powered-By: tinyPHP');
        // 输出模板文件
        echo $content;
    }

}

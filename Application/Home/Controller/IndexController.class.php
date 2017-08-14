<?php
namespace Home\Controller;
use Tiny\Controller\viewController;
class IndexController extends viewController{
    public function index(){
        $this->assign("tiny","php");
        $this->display();
    }

    /**
     * sql语句测试
     */
    public function sql(){
        $data=M()->execute('select * from camera');
        $sql=M()->getLastSql();
        D($sql);
        D($data);
    }

    /**
     * json api 测试
     */
    public function json(){
        $data = array(
            'name' =>'WoodyXiong',
            'sex'  =>'male',
            'phoneNumber'=>'18888888888'
        );
        $this->jsonReturn($data);
    }

    /**
     * 动态网页测试
     */
    public function html(){
        $this->assign("xk","shuai");
        $this->display('index');
    }
}

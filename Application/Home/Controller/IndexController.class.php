<?php
namespace Home\Controller;
use Tiny\Controller;
class IndexController extends Controller{
    public function index(){
        $data=M()->execute('select * from camera');
        D($data);
        echo "index";
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

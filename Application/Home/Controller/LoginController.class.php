<?php
namespace Home\Controller;
use Tiny\Controller\apiController;
class LoginController extends apiController{
    //用户认证页面
    public function auth(){
        $data=array('asdfasf'=>'asfaf');
        $this->jsonReturn($data);
    }




}

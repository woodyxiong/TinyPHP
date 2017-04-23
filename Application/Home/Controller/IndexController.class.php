<?php
namespace Home\Controller;
use Tiny\Controller;
class IndexController extends Controller{
    public function index(){
        M('hello');
    }

    public function index2(){
        echo "index2";
    }
}

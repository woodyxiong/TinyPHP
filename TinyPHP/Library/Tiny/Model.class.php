<?php
namespace Tiny;
use PDO;
class Model{
    private $db=null;
    // 构造函数
    public function __construct($config) {
        //仅支持mysql数据库
        if(!in_array($config['DB_TYPE'],array('mysql'))){
            exit('can not support '.$config['DB_TYPE'].' DATABASE');
        }
        try{
            $dsn=$config['DB_TYPE'].":host=".$config['DB_TYPE'].";dbname=".$config['DB_PWD'];
            echo "pdo1";
            $db=new PDO($dsn,$config['DB_USER'],$config['DB_PWD']);
            echo "pdo2";
        }catch(\PDOException $e){
            die ($e->getMessage());
        }

    }

}

<?php
namespace Tiny;
use PDO;
class Model{
    //数据库实例
    private $db=null;
    //数据库配置
    private $config=array();

    /**
     * 构造连接数据库实例
     * @param array $config 数据库连接配置
     */
    public function __construct($config) {
        $this->config=config;
        //仅支持mysql数据库
        D($this->config);
        if(!in_array($config['DB_TYPE'],array('mysql'))){
            exit('can not support '.$config["DB_TYPE"].' DATABASE');
        }
    }

    /**
     * 执行sql语句
     * @param  string $sql sql语句
     * @return [type]      [description]
     */
    public function execute($sql=''){
        if(empty($sql)) exit('sql is empty');
        $this->open();
        $data=$this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        $this->close();
        return $data;
    }

    /**
     * 打开数据库连接，并生成db实例
     */
    private function open(){
        try{
            $dsn=$config['DB_TYPE'].":host=".$config['DB_HOST'].";dbname=".$config['DB_NAME'];
            //生成数据库实例
            $db=new PDO($dsn,$config['DB_NAME'],$config['DB_PWD']);
        }catch(PDOException $e){
            die ($e->getMessage());
        }
        //设置字符集
        $db->exec("set names ".$config['DB_CHARSET']);
    }

    /**
     * 关闭数据库连接，并将db置为null
     */
    private function close(){
        $this->db = null;
    }


}

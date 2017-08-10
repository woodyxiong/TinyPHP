<?php
namespace Tiny;
use PDO;
class Model{
    //数据库实例
    private $pdo=null;
    //数据库配置
    private $config=array();
    //上次执行的sql语句
    private $sql;

    /**
     * 构造连接数据库实例
     * @param array $config 数据库连接配置
     */
    public function __construct($config) {
        $this->config=$config;
        //仅支持mysql数据库
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
        //保存sql语句
        $this->sql=$sql;
        // 打开连接
        $this->open();
        //执行sql语句
        $result=$this->pdo->query($sql);
        if (!$result) {
            echo "sql executed failed\n";
            D($this->pdo->errorInfo());
            exit();
        }
        //若返回的是PDOStatement数据集
        return $result->fetchAll(PDO::FETCH_ASSOC);
        //关闭连接
        $this->close();
        return $data;
    }

    /**
     * 返回上次执行的sql语句
     * @return string sql语句
     */
    public function getLastSql(){
        return $this->sql;
    }

    /**
     * 打开数据库连接，并生成db实例
     */
    private function open(){
        try{
            $dsn=   $this->config['DB_TYPE'].
                    ":host=".$this->config['DB_HOST'].
                    ";dbname=".$this->config['DB_NAME'];
            //生成数据库实例
            $this->pdo=new PDO($dsn,$this->config['DB_NAME'],$this->config['DB_PWD']);
        }catch(PDOException $e){
            die ($e->getMessage());
        }
        //设置字符集
        $this->pdo->exec("set names ".$this->config['DB_CHARSET']);
    }

    /**
     * 关闭数据库连接，并将db置为null
     */
    private function close(){
        $this->pdo = null;
    }


}

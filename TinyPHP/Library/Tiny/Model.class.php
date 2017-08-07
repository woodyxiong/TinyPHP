<?php
namespace Tiny;
class Model{
    // 表名
    protected $name='';
    // 表前缀
    protected $tablePrefix='';
    // 数据库对象池
    private $_db=array();

    // 构造函数
    public function __construct($name) {
        $this->_db['name']=$name;
        $this->db(0);
    }

    public function db($linkNum=''){
        $this->_db[$linkNum]=Db::getInstance();
        // 切换数据库
        $this->db=$this->_db[$linkNum];
        // 字段检测
        return $this;
    }


}

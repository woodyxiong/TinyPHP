<?php
namespace Tiny;
class Model{
    // 构造函数
    public function __construct($name) {
        $this->_db['name']=$name;
        $this->db(0);
    }

}

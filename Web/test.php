<?php
static $config=array();
function load($config1){
    var_dump($config1);
    array_merge($config1,$config);
}

load(array('123','456'));
var_dump($config);

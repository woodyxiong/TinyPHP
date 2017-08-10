<?php
try{
    $dsn='mysql:host=localhost;dbname=data';
    $db=new PDO($dsn,'data','itt@123');
}catch(\PDOException $e){
    die ($e->getMessage());
}
$db->exec("set names utf8");
// $sql = "DELETE FROM `data` WHERE `data`.`instrumentid` = 3 AND `data`.`datatime` = '2017-08-10 08:30:00'";
$sql="select * from camera";
// $data=$db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
$data=$db->query($sql);
var_dump($data->execute());

<?php
try{
    $dsn='mysql:host=localhost;dbname=data';
    $db=new PDO($dsn,'data','itt@123');
}catch(\PDOException $e){
    die ($e->getMessage());
}
$db->exec("set names utf8");
$sql='select * from camera';
$data=$db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
var_dump($data);

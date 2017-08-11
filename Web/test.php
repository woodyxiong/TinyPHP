<?php
ini_set('session.name','tinyPHPssid');
session_start();
// setcookie('tinyPHPssid',time()-3600);
// unset($_COOKIE['tinyPHPssid']);
// unset($_COOKIE['PHPSESSID']);
// $_SESSION['x']='k';
var_dump($_SESSION);
var_dump($_COOKIE);
// phpinfo();

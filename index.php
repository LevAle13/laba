<?php
/**
 * Created by PhpStorm.
 * User: LevAle
 * Date: 02.02.2016
 * Time: 22:53
 */
header("Content-Type: text/html; charset=utf-8");
$check = 1;
//header('Location: http://178.150.197.121/');
include "config.php";

include 'core/Routing.php';
$requestData = $_REQUEST;
//print_r ($requestData);
// Можно сделать конструктором;
$myRouting = new Routing();

$myRouting->routingStart($requestData);
//$myRouting->printParse();

?>
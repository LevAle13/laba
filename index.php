<?php
/**
 * Created by PhpStorm.
 * User: LevAle
 * Date: 02.02.2016
 * Time: 22:53
 */
$check = 1;
include "config.php";
include 'core/Routing.php';
$requestData = $_REQUEST;
// Можно сделать конструктором;
$myRouting = new Routing();

$myRouting->routingStart($requestData);
//$myRouting->printParse();

?>
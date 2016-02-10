<?php
/**
 * Created by PhpStorm.
 * User: LevAle
 * Date: 02.02.2016
 * Time: 22:53
 */
$check = 1;
include "config.php";
$requestData = $_REQUEST;
require_once 'core/Routing.php';
$myRouting = new Routing();
$myRouting->routingStart($requestData);
$myRouting->printParse();

?>
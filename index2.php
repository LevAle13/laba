<?php
/**
 * Created by PhpStorm.
 * User: LevAle
 * Date: 02.02.2016
 * Time: 22:53
 */
$check = 1;
include "config.php";
//ini_set('display_errors', 1);

$requestData = $_REQUEST;
require_once 'core/requestsController.php';
//require_once 'load.php';
$newRequest = new requestsController();
$newRequest->getRequest($requestData);




?>
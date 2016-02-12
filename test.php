<?php
$check=1;
include "config.php";
include 'controllers/UsersController2.php';
include 'models/Users.php';

$hero = new UsersController();

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ГРИНД</title>
    <link href="css/bootstrap.css" rel="stylesheet">
</head>
<body>

<?php

    $myValue = $hero->userInfo(33);
    echo $myValue->login;

?>

</body>
</html>
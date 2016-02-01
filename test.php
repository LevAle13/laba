<?php
$check=1;
include "config.php";
include 'controllers/usersController.php';
include 'models/usersModel.php';

$hero = new UsersController(32);

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

   echo $hero->userInfo(32);

?>

</body>
</html>
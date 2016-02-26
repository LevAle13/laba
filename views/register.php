<?php
/**
 * Created by PhpStorm.
 * User: LevAle
 * Date: 26.02.2016
 * Time: 20:01
 */

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Проект Гринд</title>
    <link href="/css/bootstrap.css" rel="stylesheet">


</head>
<body>
<header>
    <div class="container">
        <!--Содержимое-->
        <IMG src="/pic/top1.jpg" class="img-responsive" class="img-rounded"  width="100%">
    </div>
</header>
<main>
    <div class="container">
        <div class="row" style ="padding: 10px; border: 1px solid blue; ">

                <h1 class="text-center" style="color:blue; font-weight:bold;">Проект Гринд</h1><hr>
                Для регистрации необходимо выбрать Логин - имя Вашего персонажа.<br>
                Класс персонажа определит лишь его начальную направленность, в последующем будет возможность освоить любые направления.<br><br>
                    <div style= "white-space: nowrap; background:#FF93FF; color:blue; font-family: Verdana; width:100%; display: inline-block; text-align: center;">
                        Регистрация
                    </div>

                <div class="container" style="background:#AEFFF0;">

                    <div class="col-md-3 col-lg-3">
                    </div>

                    <div class="col-md-3 col-lg-3" style="color: blue; ">
                        <br>
                        Login<br><br>
                        Введите пароль:<br><br>
                        Введите пароль еще раз:<br>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <br>
                        <form action="/Users/register" method="POST">
                        <input type="text" name="login" class="form-control" placeholder="Введите имя персонажа"/>
                        <input type="password" name="password1" class="form-control" id="inputPassword" placeholder="Введите пароль" />
                        <input type="password" name="password2" class="form-control" id="inputPassword" placeholder="Введите пароль еще раз" />

                    </div>

                </div>

                    <div class="container" style="background:#b6f7ff;">


                    <div class="col-md-3 col-lg-3">
                    </div>

                    <div class="col-md-3 col-lg-3" style="color: blue; ">
                        <br><strong>
                        Выбор игрового класса:</strong><br><br>
                        Воин:<br><br>
                        Лучник:<br><br>
                        Маг:<br><br>
                    </div>

                    <div class="col-md-6 col-lg-6">
                        <br><br><br>
                        <input type="radio" VALUE = "1" name="class" /><br><br>
                        <input type="radio" VALUE = "2" name="class" /><br><br>
                        <input type="radio" VALUE = "3" name="class" /><br><br>



                    </div>

                    <div class="text-center"><input  type="submit" value='Регистрация'></div></form>
                </div>
        </div>
</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>


</body>
</html>
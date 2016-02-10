<?php
/**
 * Created by PhpStorm.
 * User: LevAle
 * Date: 10.02.2016
 * Time: 20:10
 */

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Проект Гринд</title>
<link href="css/bootstrap.css" rel="stylesheet">


</head>
<body>
    <header>
      <div class="container">
        <!--Содержимое-->
		<IMG src="pic/top1.jpg" class="img-responsive" class="img-rounded"  width="100%">
      </div>
    </header>
    <main>
    <div class="container">
        <div class="row" style ="border: 1px solid blue;">
          <article class="col-sm-12 col-md-8 col-lg-9" style ="border: 1px solid blue;">
            <!--Содержимое-->

		<div class = "text-center">
			<h1><font color="blue"><strong>Проект Гринд</strong></font></h1>
		</div>
		<br>

		<font size=3 color=#3333FF face="Verdana">
		<div class="lead" >
			<p>Простая текстовая игрушка, в которой необходимо убивать монстров и развивать персонажа, преодолевая препятствия.</p>
			<p>У каждого персонажа есть навыки, которые он изучает. Одни навыки улучшают атаку и защиту, другие позволяют одевать и использовать специальное снаряжение, элексиры и улучшения.</p>
			<p>Любой персонаж может быть универсальным, выбирая любое оружие - но для этого необходимо выучить навык. В некоторых случаях нужно учить совсем не выученные навыки, чтобы одеть более эффективное в бою снаряжение.</p>
			<p>В игре нет уровней - персонаж зарабатывает опыт, который тратит на изучение навыков.</p>
			<p>Персонаж может сражаться с другими игроками за место в Рейтинге, или просто проходить локации с монстрами, пытаясь установить новый рекорд.</p>
		</div>


			<?php
			  include 'parser.php';

			?>

</article>


<aside class="col-sm-12 col-md-4 col-lg-3">
    <div class="row">
        <div class="col-sm-6 col-md-12">
            <!--Содержимое-->

            <font size="3" face="Tahoma"><b><center>ВХОД</center></b></font></td></tr></table><br></center>

            <form action="login.php" method="POST">
                <font size="2" face="Tahoma"><b>Логин:</b><br></font><input type="text" name="login" style=" width:100%;" /><br>
                <font size="2" face="Tahoma"><b>Пароль:</b><br></font><input type="password" name="pass"  style=" width:100%;"  />
                <center>

                    <input type="submit" value="Вход"/>
            </form>
            </center>

            <hr>
            <font size="2" face="Tahoma"><center><b><A HREF="register.php">Регистрация</A></b></center></font>


        </div>
    </div>
</aside>
</div>
</div>
</main>
<footer>
    <div class="container">
        <!--Содержимое-->
    </div>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
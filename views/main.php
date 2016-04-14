<?php
/**
 * Created by PhpStorm.
 * User: LevAle
 * Date: 25.02.2016
 * Time: 20:04
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
		<IMG src="/pic/top1.jpg" class="img-responsive" class="img-rounded"  width="100%">
      </div>
    </header>

    <main>
        <div class="container">
             <div class="row" style ="border: 1px solid blue;">

                 <?php include 'UserInfo.php';?>

                 <div class="col-md-9 col-lg-9" style ="border: 1px solid rgba(116, 23, 187, 0.19);">
                     <div style="font-family: Tahoma; font-size: 14pt; font-weight:bold; color: blue; ">

                         <?php
                         if ($viewsData['errorMessage']<>'')
                         {
                             echo "<div style='color: red; text-align: center'>".$viewsData['errorMessage']."</div><hr>";
                         }
                         ?>

                         <br>
                         <A HREF='/Users/questSelect'>Начать приключение</A><br><br>
                         <A HREF='/Users/inventory'>Инвентарь</A>
                         &nbsp;<A HREF='/Users/inventory2'>+</A><br><br>
                         <A HREF='/Users/skills'>Умения</A><br><br>
                         <A HREF='/Items/itemShop'>Магазин оружия и доспехов</A><br><br>
                         <A HREF='/Items/potionShop'>Магазин Эликсиров</A><br><br>
                         <A HREF='/Users/rating'>Рейтинг игроков</A><br><br>
                         <A HREF='/Users/ratingPvp'>PVP Рейтинг</A><br>
                     </div>
                 </div>



             </div>
        </div>
    </main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
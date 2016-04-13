<?php
/**
 * Created by PhpStorm.
 * User: LevAle
 * Date: 27.02.2016
 * Time: 1:55
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
                <div style="font-family: Tahoma; padding: 3px; font-size: 11pt; color: black; ">


                    <?php
                    echo "
                    <table class='table ' border='1' border=0 cellspacing='1' cellpadding='2' bgcolor='#AAAAAA'>";

                    echo "<tr class='warning'>
                    <td style='padding: 3px;' ALIGN='center' width='5%' bgcolor='white'>№</td>
                    <td style='padding: 3px;' ALIGN='center' width='20%' bgcolor='white'>Имя игрока</td>
                    <td style='padding: 3px;' ALIGN='center' width='20%' bgcolor='white'>Опыт игрока</td>
                    <td style='padding: 3px;' ALIGN='center' width='20%' bgcolor='white'>ПвП Рейтинг</td>
                    <td style='padding: 3px;' ALIGN='center' width='20%' bgcolor='white'>Дата входа в игру</td>
                    <td style='padding: 3px;' ALIGN='center' width='20%' bgcolor='white'>Сражение</td>
                    </tr>
                    ";

                    $k=0;
                    foreach($viewsData['users'] as $ingr)
                    {
                        $k=$k+1;

                        $buk="<A HREF='/Users/pvp/".$ingr['userId']."'>Схватка</a>";

                        echo "
                        <tr >
                        <td style='padding: 2px;' ALIGN='center' width='5%' bgcolor='white'>".$k."</td>
                        <td style='padding: 2px;' width='20%' bgcolor='white'>".($ingr['login'])."</td>
		                <td style='padding: 2px;' width='20%' ALIGN='center' bgcolor='white'>".($ingr['spentExperience'])."</td>
		                <td style='padding: 2px;' width='20%' ALIGN='center'  bgcolor='white'>".($ingr['pvpScore'])."</td>
		                <td style='padding: 2px;' width='20%' ALIGN='center' bgcolor='white'>".date("d.m.Y  H:i:s", ($ingr['lastLoginTime']))."</td>
		                <td style='padding: 2px;' ALIGN='center' width='20%' bgcolor='white'>".$buk."</td>
		                </tr>";



                    };
                    echo "</table>";

                    echo "
                    <br>
                    <div style='text-align: center;'>
                        <A HREF='/Users/main'>Вернуться назад</A>
                    </div>";
                    ?>


                </div>
            </div>



        </div>
    </div>
</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
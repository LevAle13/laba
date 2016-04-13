<?php
/**
 * Created by PhpStorm.
 * User: LevAle
 * Date: 25.02.2016
 * Time: 17:48
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
            <div class="row" style ="border: 1px solid blue;">
                    <div class="lead" style = 'text-align: center;'>
                         <?php
                             echo $viewsData['returnMessage'];
                         ?>
                    </div>
            </div>
        </div>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </body>
</html>


</body>
</html>

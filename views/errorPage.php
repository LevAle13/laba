<?php
/**
 * Created by PhpStorm.
 * User: LevAle
 * Date: 17.02.2016
 * Time: 17:59
 */
header("HTTP/1.0 404 Not Found");
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

<?php

echo '<div style="font-size: 34pt;  ">Grind Error Page</div><br>';
echo '<div style="font-size: 14pt;  ">GEP Message: ' .$this->errorMessage.'<br></div>';
echo '<div style="font-size: 14pt;  "><A HREF="/">Вернуться на центральную страницу</A></div>';

?>

</body>
</html>






<?php
/**
 * Created by PhpStorm.
 * User: LevAle
 * Date: 01.02.2016
 * Time: 13:15
 */

class SqlJob
{

    public static function sqlConnect()
    {
        $host = "localhost";
        $user = "root";
        $pass = "fUTxUvGW9cjfwM4B";
        $db = "pafos";

        mysql_connect($host, $user, $pass);
        mysql_select_db($db);
        mysql_query("SET NAMES utf8");
    }


}

?>
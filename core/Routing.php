<?php
/**
 * Created by PhpStorm.
 * User: LevAle
 * Date: 09.02.2016
 * Time: 19:35
 */

class Routing
{
    public $controller;
    public $action;
    public $parseValue;

    public static function parseUrl ()
    {
        $parse = explode("/", trim($_SERVER['REQUEST_URI'], "/"));

        $controller = $parse['1'].'Controller';
        $action = $parse['2'].'Action';
        $parseValue = $parse['3'];

        print_r ($parse);
        echo '<br><br>Controller: '.$controller;
        echo '<br><br>Action: '.$action;
        echo '<br><br>Value: '.$parseValue;
    }

}


?>
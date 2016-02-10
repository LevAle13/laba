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
    public $parse;
    public $requestData;

    public function routingStart($requestData)
    {
        // Нужен код для проверки пользовательских данных;
        $this->requestData=$requestData;
        $this->parseUrl();
        $this->loadClass();
        $this->actionController();
    }

    // Парсим адресную строку;
    public function parseUrl ()
    {
        $this->parse = explode("/", trim($_SERVER['REQUEST_URI'], "/"));

        $this->controller = $this->parse['0'].'Controller';
        $this->action = $this->parse['1'].'Action';
        $this->parseValue = $this->parse['2'];

        // Проверка на пустой контроллер;
        if (empty($this->controller))
        {
            $this->controller = 'IndexController';
            $this->action = 'IndexAction';
        }

        // Проверка на пустой Экшен;
        if (empty($this->action))
        {
            $this->controller = 'IndexController';
            $this->action = 'ErrorPage';
        }
    }

    // Вывод на экран
    public function printParse()
    {
        print_r ($this->parse);
        echo '<br><br>Controller: '.$this->controller;
        echo '<br><br>Action: '.$this->action;
        echo '<br><br>Value: '.$this->parseValue;
        echo '<br><br>Login: '.$this->requestData['login'];
        echo '<br><br>Password: '.$this->requestData['pass'];
    }

    // Подгружаем необходимые классы для основного метода, на основе массива;
    public function loadClass()
    {
        $filename = 'controllers/'.$this->controller.'.php';

        if (file_exists($filename))
        {
            include ($filename);
        }
        else
        {
            $this->controller = 'IndexController';
            $this->action = 'ErrorPage';
            $filename = 'controllers/'.$this->controller.'.php';
            include ($filename);
        }


    }

    // Создаем объект контроллера на основе полученных данных и вызываем метод action;
    public function actionController()
    {
        $newAction = new $this->controller;

        $actionBegin = $this->action;
        $newAction->$actionBegin($this->requestData);
    }


}


?>
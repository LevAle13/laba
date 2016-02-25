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
    // Хранятся данные полученные через POST and GET
    public $requestData;
    public $returnPage;
    public $resultParse;
    public $resultView;
    public $returnMessage;
    public $errorMessage;

    // Точка входа на Роутинг;
    public function routingStart($requestData)
    {
        // Нужен код для проверки пользовательских данных;
        $this->requestData = $requestData;
        $this->parseUrl($_SERVER['REQUEST_URI']);

//        echo '100<br>';

        if ($this->resultParse == 'true')
        {

            if ($this->loadClass() == true)
            {
                $this->actionController();
            }
        }

        // Вызываем вьюху;

        include 'views/'.$this->returnPage.'.php';
    }

    // Парсим адресную строку;
    public function parseUrl ($url)
    {

        $this->parse = explode("/", trim($url, "/"));

        $this->controller = $this->parse['0'].'Controller';
        $this->action = $this->parse['1'].'Action';
        $this->parseValue = $this->parse['2'];

        $this->resultParse = 'true';

        // Проверка на пустой Экшен;
        if (empty($this->parse['1']))
        {
            $this->resultParse = 'false';
            $this->returnPage = 'errorPage';
            $this->errorMessage = 'Action is empty!';
        }

        // Проверка на пустой контроллер;
        if ($this->controller == 'Controller')
        {
            $this->resultParse = 'false';
            $this->returnPage = 'errorPage';
            $this->errorMessage = 'Controller is empty!';
        }


//        $this->printParse();
    }

    // Вывод на экран; Вспомогательный метод для отслеживания передаваемых данных;
    public function printParse()
    {
        print_r ($this->parse);
        echo '<br><br>Controller: '.$this->controller;
        echo '<br><br>Action: '.$this->action;
        echo '<br><br>Value: '.$this->parseValue;
        echo '<br><br>Login: '.$this->requestData['login'];
        echo '<br><br>Password: '.$this->requestData['password'];
    }

    // Подгружаем необходимые классы для основного метода, на основе массива;
    public function loadClass()
    {
        $filename = 'controllers/'.$this->controller.'.php';


        if (file_exists($filename))
        {
            $loadResult = true;
            include ($filename);
        }
        else
        {
            $loadResult = false;
            $this->resultParse = 'false';
            $this->returnPage = 'errorPage';
            $this->errorMessage = 'Controller file: '.$filename.' is absent!';
        }

        return $loadResult;

    }

    // Создаем объект контроллера на основе полученных данных и вызываем метод action;
    public function actionController()
    {
        $newAction = new $this->controller;

        // Проверка наличия метода класса;
        if (method_exists($newAction,$this->action) == true)
        {
            $actionBegin = $this->action;
            $newAction->$actionBegin($this->requestData);

            $this->returnPage = $newAction->arrayResult['returnPage'];
            $this->returnMessage = $newAction->arrayResult['returnMessage'];
        }
        else
        {
            $this->returnPage = 'errorPage';
            $this->errorMessage = 'Action "'.$this->action.'" is absent!';


        }
    }


}


?>
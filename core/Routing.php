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

    public $data = array();


    // Точка входа на Роутинг;
    public function routingStart($requestData)
    {
        // Нужен код для проверки пользовательских данных;
        $this->requestData = $requestData;
        $this->parseUrl($_SERVER['REQUEST_URI']);

        if ($this->data['resultParse'] == true)
        {

            if ($this->loadClass() == true)
            {
                $this->actionController();
            }
        }

        // Вызываем вьюху;
        //echo " <br> Return page:".$this->data['returnPage']." <br> ";

        $viewsData = $this->data;

        //print_r($viewsData);
        include '/views/'.$this->data['returnPage'].'.php';
    }

    // Парсим адресную строку;
    public function parseUrl ($url)
    {

        $this->parse = explode("/", trim($url, "/"));

        $this->controller = $this->parse['0'].'Controller';
        $this->action = $this->parse['1'].'Action';
        $this->parseValue = $this->parse['2'];

        $this->data['resultParse'] = true;

        // Проверка на пустой Экшен;
        if (empty($this->parse['1']))
        {
            $this->data['resultParse'] = false;
            $this->data['returnPage'] = 'errorPage';
            $this->data['errorMessage'] = 'Action is empty!';
        }

        // Проверка на пустой контроллер;
        if ($this->controller == 'Controller')
        {
            $this->data['resultParse'] = false;
            $this->data['returnPage'] = 'index';
        }

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
            include ($filename);
            return true;
        }
        else
        {
            $this->data['resultParse'] = false;
            $this->data['returnPage'] = 'errorPage';
            $this->data['errorMessage'] = 'Controller file: '.$filename.' is absent!';
            return false;
        }
    }

    // Создаем объект контроллера на основе полученных данных и вызываем метод action;
    public function actionController()
    {
        $newAction = new $this->controller;

        // Проверка наличия метода класса;
        if (method_exists($newAction,$this->action) == true)
        {
            $actionBegin = $this->action;

            $this->data = $newAction->$actionBegin($this->requestData);
            if (isset($newAction->heroInfo)) $this->heroInfo = $newAction->heroInfo;
            if (isset($newAction->itemData)) $this->itemData = $newAction->itemData;
            if (isset($newAction->enemyData)) $this->enemyData = $newAction->enemyData;

            //echo "Return page: ".$this->data['returnPage']." <br>";
            //echo "RESULT JE: <br>";
            //print_r($this->data);

            //$this->data['returnPage'] = $newAction->arrayResult['returnPage'];
            //$this->data['returnMessage'] = $newAction->arrayResult['returnMessage'];
        }
        else
        {
            $this->data['returnPage'] = 'errorPage';
            $this->data['errorMessage'] = 'Action "'.$this->action.'" is absent!';
        }
    }


}


?>
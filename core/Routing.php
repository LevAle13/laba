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
        // Вызываем метод, который парсит строку;
        if ($this->parseUrl($_SERVER['REQUEST_URI']) == true)
        {
            // Фильтр сессии;
            include '/filters/sessionFilter.php';
            // Только если это не логин или регистрация;
            if (($this->action <> 'loginAction') and ($this->action <> 'registerAction'))
            {
                if (isset($_SESSION['userId']))
                {
                    $this->data['sessionCheck'] = true;
                }
                else
                {
                    // Если сессия не найдена - выкидываем на центральную страничку;
                    $this->data['returnPage'] = 'redirect';
                    $this->data['returnMessage'] = 'Время Вашей сессии истекло! <br><A HREF="/">Вернуться на центральную страницу</A>';
                    $this->data['sessionCheck'] = false;
                }
            }
            else
            {
                $this->data['sessionCheck'] = true;
            }

            if (($this->loadClass() == true) and ($this->data['sessionCheck'] == true) )
            {
                $this->actionController();
            }
        }


        $viewFile = 'views/'.$this->data['returnPage'].'.php';
        if (file_exists($viewFile) == false)
        {
            $this->data['returnPage'] = 'errorPage';
            $this->data['errorMessage'] = 'View file "'.$viewFile.'" is absent!';
        }
        //Вызываем вьюху;
        $viewsData = $this->data;
        include 'views/' . $this->data['returnPage'] . '.php';
    }

    // Парсим адресную строку;
    public function parseUrl ($url)
    {
        $this->parse = explode("/", trim($url, "/"));

        $this->controller = $this->parse['0'].'Controller';
        $this->action = $this->parse['1'].'Action';
        $this->parseValue = $this->parse['2'];

        // Проверка на пустой контроллер;
        if ($this->controller == 'Controller')
        {
            $this->data['returnPage'] = 'index';
            return false;
        }

        // Проверка на пустой Экшен;
        if (empty($this->parse['1']))
        {
            $this->data['returnPage'] = 'errorPage';
            $this->data['errorMessage'] = 'Action is empty!';
            return false;
        }

        return true;
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
            //echo "Return page: ".$this->data['returnPage']." <br>";
            //echo "RESULT JE: <br>";
            //print_r($this->data);
        }
        else
        {
            $this->data['returnPage'] = 'errorPage';
            $this->data['errorMessage'] = 'Action "'.$this->action.'" is absent!';
        }
    }


}


?>
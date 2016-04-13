<?php
/**
 * Created by PhpStorm.
 * User: LevAle
 * Date: 03.02.2016
 * Time: 0:22
 */

// Класс получающий данные от пользователя и направляющий пользователя на путь истинный (в основной контроллер);
class requestsController
{
    // На как
    public $renderPage = '';
    //
    public $controllerList = array();

    public function getRequest($requestData)
    {

        $this->renderPage = '';

        // Ищем передается ли нам в данных параметр 'page'
        if (isset($requestData['page']))
        {
            // Обработка логина
            if ($requestData['page']=='login')
            {
                $this->renderPage = 'login';
                $this->controllerList = array ('1' => 'Users');
                $this->loadClass($this->controllerList);

                $hero = new UsersController();

            }
        }
        else
        {
            // Обработка пустого запроса;
            $this->renderPage = 'index';

        }

        // Нужно реализовать последующий вызов контроллера бизнес логики, который сделает работу с моделью и вьюху
        // ...
        //

    }

    // Подгружаем необходимые классы для основного метода, на основе массива
    public function loadClass($classArray)
    {
        foreach ($classArray as $value) {
            //echo 'controllers/'.$value.'Controller.php';
            include ('controllers/'.$value.'Controller.php');
            include ('models/'.$value.'.php');
        }

    }

}

?>
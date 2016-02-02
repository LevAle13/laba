<?php
/**
 * Created by PhpStorm.
 * User: LevAle
 * Date: 02.02.2016
 * Time: 23:15
 */
class Routing
{
    static function execute()
    {
        $controllerName = 'Main';
        $actionName = 'index';
        $piecesOfUrl = explode('/', $_SERVER['REQUEST_URI']);

        if (!empty($piecesOfUrl[1]))
        {
            $controllerName = $piecesOfUrl[1];
        }
        if (!empty($piecesOfUrl[2]))
        {
            $actionName = $piecesOfUrl[2];
        }
        $modelName = 'Model_' . $controllerName;
        $controllerName = 'Controller_' . $controllerName;
        $actionName = 'action_' . $actionName;
        $fileWithModel = strtolower($modelName) . 'php';
        $fileWithModelPath	= "models/" . $fileWithModel;
        if (file_exists($fileWithModelPath))
        {
            include $fileWithModelPath;
        }
        $fileWithController = strtolower($controllerName) . '.php';
        $fileWithControllerPath = "controllers/" . $fileWithController;
        if (file_exists($fileWithControllerPath))
        {
            include $fileWithControllerPath;
        }
        else
        {
            //Здесь нужно добавить обработку ошибки.
            //Например, перекинуть пользователя на страницу 404
        }
        $controller = new $controllerName;
        $action = $actionName;
        if (method_exists($controller, $action))
        {
            call_user_func(array($controller, $actionName), $piecesOfUrl);
        }
        else
        {
            //Здесь тоже нужно добавить обработку ошибок
        }
    }
}
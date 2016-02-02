<?php
/**
 * Created by PhpStorm.
 * User: LevAle
 * Date: 03.02.2016
 * Time: 0:22
 */

class requestsController
{
    public $renderPage = '';
    public $controllerList = array();

    public function getRequest($requestData)
    {

        $this->renderPage = '';

        if (isset($requestData['page']))
        {
            if ($requestData['page']=='login')
            {
                $this->renderPage = 'login';
                $this->controllerList = array ('1' => 'users');
            }
        }
        else
        {
            $this->renderPage = 'index';

        }
    }
}

?>
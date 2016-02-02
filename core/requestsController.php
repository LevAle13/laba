<?php
/**
 * Created by PhpStorm.
 * User: LevAle
 * Date: 03.02.2016
 * Time: 0:22
 */

class requestsController
{
    public function getRequest($requestData)
    {

        $renderPage = '';

        if (isset($requestData['page']))
        {
            if ($requestData['page']=='login')
            {

            }
        }
        else
        {
            $renderPage = 'index';

        }

        return $renderPage;
    }
}

?>
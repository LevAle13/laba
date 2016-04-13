<?php
/**
 * Created by PhpStorm.
 * User: LevAle
 * Date: 13.04.2016
 * Time: 14:19
 */

class Filters
{
    public function readFilters()
    {
        include '/filters/sessionFilter.php';
    }

    public function startFilters($action)
    {
        if (($action <> 'login') and ($action <> 'register'))
        {
            $sessionFilter = new SessionFilter();
            return $sessionFilter->start();
        }
    }
}
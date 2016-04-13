<?php
/**
 * Created by PhpStorm.
 * User: LevAle
 * Date: 13.04.2016
 * Time: 14:25
 */

class SessionFilter
{
    public function start()
    {
        // Проверяем наличие сессии;
        if (isset($_SESSION['userId']))
        {
            $filterData['sessionCheck'] = true;
        }
        else
        {
            // Если сессия не найдена - выкидываем на центральную страничку;
            $filterData['returnPage'] = 'redirect';
            $filterData['returnMessage'] = 'Время Вашей сессии истекло! <br><A HREF="/">Вернуться на центральную страницу</A>';
            $filterData['sessionCheck'] = false;
        }

        return $filterData;
    }
}
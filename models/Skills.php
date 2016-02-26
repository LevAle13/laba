<?php
/**
 * Created by PhpStorm.
 * User: LevAle
 * Date: 27.02.2016
 * Time: 0:45
 */

class Skills
{
    public $userId;
    public $skillId;
    public $skillLevel;

    // Новый скил;
    public function newSkill($fields)
    {

        $sqlText1 = 'INSERT INTO skills (';
        $sqlText2 = ' VALUES (';
        foreach($fields as $key => $value)
        {
            $sqlText1 = $sqlText1 . $key . ', ';
            $sqlText2 = $sqlText2 .'"'. $value . '", ';
        }

        $sqlText1 = substr($sqlText1, 0, -2);
        $sqlText2 = substr($sqlText2, 0, -2);

        $sqlText1 = $sqlText1.') ';
        $sqlText2 = $sqlText2.')';

        $sqlText=$sqlText1.$sqlText2;

        //echo 'RESULT SQL: '.$sqlText1.$sqlText2.'<br>';

        $result = xquery($sqlText);
    }
}
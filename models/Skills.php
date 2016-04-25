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

    // По пользователю и айди скила считываем все значения;
    public function readSkillValue($userId,$skillId)
    {
        $sql = xquery ("select * from skills where userId='".$userId."' and skillId='".$skillId."'");
        for ($data=array(); $row=mysql_fetch_assoc($sql); $data[]=$row);
        return ($data[0]);
    }

    // Извлекаем все скилы по id пользователя;
    public function readAllSkills($userId)
    {
        $sql = xquery ("select * from skills where userId='".$userId."' order by skillLevel DESC");
        for ($data=array(); $row=mysql_fetch_assoc($sql); $data[]=$row);
        return $data;
    }

    // Считываем наличие скила и его уровень;
    public function readSkillById($userId,$skillId)
    {
        $sql = xquery ("select count(skillId) skillCount,skillLevel from skills where user_id='".$userId."' and skillId='".$skillId."' ");
        for ($data=array(); $row=mysql_fetch_assoc($sql); $data[]=$row);

        $returnData['skillCount'] = $data[0]["skillCount"];
        $returnData['skillLevel'] = $data[0]["skillLevel"];
        return $returnData;
    }

    // Добавлям в БД новый скил;
    public function addNewSkill($userId,$skillId)
    {
        $sql = "INSERT INTO skills (userId,skillId,skillLevel) VALUES ('".$userId."', '".$skillId."', '1')";
        xquery($sql);
    }

    // Увеличиваем существующий скил на +1;
    public function updateSkill($userId,$skillId,$newSkillLevel)
    {
        $sql=xquery('update skills set skillLevel="'.$newSkillLevel.'" where userId="'.$userId.'" and skillId="'.$skillId.'"');
        xquery($sql);
    }
}
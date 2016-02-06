<?php
/**
 * Created by PhpStorm.
 * User: LevAle
 * Date: 26.01.2016
 * Time: 20:05
 */
class skillsController
{
    public $userId;
    public $skill;
    public $skillLevel;

    // Дополнительные параметры.
    public $experienceSpent = 0;
    // Скилы.
    public $skillsArray = array(); //Модель?
    public $skillName = array(); //Модель?


    // Получаем все скилы для конкретного персонажа.
    public function loadSkills($userId)
    {

    }

    // Проверка наличия скила.
    public function checkSkill($skillId)
    {

    }

    // Учим новый скил.
    public function learnNewSkill($skillId)
    {
        $this->experienceSpent = 10;
    }

    // Улучшаем существующий скил.
    public function addLevelSkill($skillId)
    {
        $this->experienceSpent = 10;
    }


}

?>
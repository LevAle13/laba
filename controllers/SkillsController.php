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

    // �������������� ���������.
    public $experienceSpent = 0;
    // �����.
    public $skillsArray = array(); //������?
    public $skillName = array(); //������?


    // �������� ��� ����� ��� ����������� ���������.
    public function loadSkills($userId)
    {

    }

    // �������� ������� �����.
    public function checkSkill($skillId)
    {

    }

    // ���� ����� ����.
    public function learnNewSkill($skillId)
    {
        $this->experienceSpent = 10;
    }

    // �������� ������������ ����.
    public function addLevelSkill($skillId)
    {
        $this->experienceSpent = 10;
    }


}

?>
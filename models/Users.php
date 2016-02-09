<?php
/**
 * Created by PhpStorm.
 * User: LevAle
 * Date: 26.01.2016
 * Time: 20:26
 */


class UsersModel
{

    // Параметры учетки
    public $userId;
    public $login;
    public $password;
    public $registrationIp;
    public $lastLoginIp;
    public $registerTime;
    public $lastLoginTime;
    public $failPassTry;
    public $enterPassTime;

    // Параметры героя
    public $attackType;
    public $minimumDamage;
    public $maximumDamage;
    public $currentSwordAttack;
    public $currentBowAttack;
    public $currentMagicAttack;
    public $currentSwordShield;
    public $currentBowShield;
    public $currentMagicShield;
    public $maximumHitPoints;
    public $currentHitPoints;
    public $experience;
    public $spentExperience;
    public $currentGold;
    public $questGold;
    public $questId;
    public $questStep; // Движение по лесу (1-10)
    public $maximumLevelQuest;
    public $enemyId;
    public $pvpScore;
    public $def; // Не помню зачем это нужно

    //public $userInfo = array();


    // Считываем все данные пользователя по его айди
    public function readUser($userId)
    {
        $sql = xquery ("select * from users where id='" . $userId . "'");
        for ($data=array(); $row=mysql_fetch_assoc($sql); $data[]=$row);
        $result = $data[0];

        //$user = new UsersModel();

        $this->login = $result['login'];
        $this->password = $result['pass'];
        $this->registrationIp = $result['reg_ip'];
        $this->lastLoginIp = $result['last_ip'];
        $this->registerTime = $result['register_time'];
        $this->lastLoginTime = $result['last_time'];
        $this->failPassTry = $result['pass_try'];
        $this->enterPassTime = $result['pass_time'];
        $this->attackType = $result['tip_at'];
        $this->minimumDamage = $result['min_dmg'];
        $this->maximumDamage = $result['max_dmg'];
        $this->currentSwordAttack = $result['at_s'];
        $this->currentBowAttack = $result['at_b'];
        $this->currentMagicAttack = $result['at_m'];
        $this->currentSwordShield = $result['sh_s'];
        $this->currentBowShield = $result['sh_b'];
        $this->currentMagicShield = $result['sh_m'];
        $this->maximumHitPoints = $result['hp_max'];
        $this->currentHitPoints = $result['hp_tek'];
        $this->experience = $result['xp'];
        $this->spentExperience = $result['spend_xp'];
        $this->currentGold = $result['gold'];
        $this->questGold = $result['gold_temp'];
        $this->questId = $result['quest_id'];
        $this->questStep = $result['quest_step'];
        $this->maximumLevelQuest = $result['quest_max'];
        $this->enemyId = $result['enemy_id'];
        $this->pvpScore = $result['pvp_score'];
        //...
    }

    // Извлечение данных для логина;
    public function login($login,$password)
    {
        $sql = xquery ("select id, login, pass, last_time, pass_try, pass_time from users where login='". $login ."' and pass = '". $password ."'");
        for ($data=array(); $row=mysql_fetch_assoc($sql); $data[]=$row);
        $result = $data[0];

        $this->login = $result['id'];
        $this->login = $result['login'];
        $this->password = $result['pass'];
        $this->registerTime = $result['register_time'];
        $this->lastLoginTime = $result['last_time'];
        $this->failPassTry = $result['pass_try'];

    }

    // Загружаем выбранные поля
    public function loadFields($fields)
    {

    }

    // Упдайтеми нужные поля
    public function updateFields($fields)
    {

    }

    // Загружаем список скилов в массив $skillsArray()
    public function loadSkills()
    {

    }

}

?>
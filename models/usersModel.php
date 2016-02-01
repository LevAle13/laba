<?php
/**
 * Created by PhpStorm.
 * User: LevAle
 * Date: 26.01.2016
 * Time: 20:26
 */


class UsersModel
{

    // Пользовательские данные.
    public $userId;
    public $login;
    public $password;
    public $registrationIp;
    public $lastLoginIp;
    public $registerTime;
    public $lastLoginTime;
    public $failPassTry;
    public $enterPassTime;

    // Параметры персонажа.
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
    public $questStep; // Если не равен нулю то персонаж в бою и нужно обрезать ему часть действий - покупка, одевание и прочее.
    public $maximumLevelQuest;
    public $enemyId;
    public $pvpScore;
    public $def; // Не помню для чего это.

    //public $userInfo = array();


    // Считываем из БД данные по пользователю.
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

    // Считываем все параметры пользователя.
    public function ReadAllUserValue($userId)
    {

    }


    // Загрузка нужных полей. Модель.
    public function loadFields($fields)
    {

    }

    // Апдейтим нужные поля.  Модель.
    public function updateFields($fields)
    {

    }

    // Загрузка текущих скилов персонажа в массив $skillsArray(); Модель.
    public function loadSkills()
    {

    }

}

?>
<?php
/**
 * Created by PhpStorm.
 * User: LevAle
 * Date: 26.01.2016
 * Time: 20:26
 */


class Users
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

    // Системные поля
    public $loginAction = false;

    public $arrayStats = array(
        'userId' => "",
        'login' => "",
        'password' => "",
        'registrationIp' => "",
        'lastLoginIp' => "",
        'registerTime' => "",
        'lastLoginTime' => "",
        'failPassTry' => "",
        'enterPassTime' => "",
        'attackType' => "",
        'minimumDamage' => "",
        'maximumDamage' => "",
        'currentSwordAttack' => "",
        'currentBowAttack' => "",
        'currentMagicAttack' => "",
        'currentSwordShield' => "",
        'currentBowShield' => "",
        'currentMagicShield' => "",
        'maximumHitPoints' => "",
        'currentHitPoints' => "",
        'experience' => "",
        'spentExperience' => "",
        'currentGold' => "",
        'questGold' => "",
        'questId' => "",
        'questStep' => "",
        'maximumLevelQuest' => "",
        'enemyId' => "",
        'pvpScore' => "",
        'def' => "",
    );

    //public $userInfo = array();


    // Считываем все данные пользователя по его айди
    public function readUser($userId)
    {
        $sql = xquery ("select * from users where userId='" . $userId . "'");
        for ($data=array(); $row=mysql_fetch_assoc($sql); $data[]=$row);
        $result = $data[0];

        $this->writeDataToArray($result);

    }

    // Перенос полученных данных в поля и массив;
    public function writeDataToArray($data)
    {
        foreach($data as $key => $value)
        {
            $this->$key = $value;

            $this->arrayStats[''.$key.''] = $value;

            //echo $key.' = '.$this->$key.'<br>';
        }

 //       print_r($this->arrayStats);
    }

    // Хочу вывести массив на экран;
    public function printArray($data)
    {


        foreach($data as $key => $value)
        {
            echo $key.' = '.$value.'<br>';
        }

        //print_r($data);

    }

    // Извлечение данных для логина;
    public function readUserByLogin($login,$password)
    {
        $sql = xquery ("select * from users where login='". $login ."'");
        for ($data=array(); $row=mysql_fetch_assoc($sql); $data[]=$row);
        $result = $data[0];

        // Логин удачен или нет, и код ошибки;

        // Проверка логина - количество элементов в массиве дата;
        if ($result['login'])
        {
            $this->writeDataToArray($result);
            $this->loginAction = true;

            // Проверка таймаута пользователя

            // Проверка пароля - $this->password
            if ($this->password == md5($password))
            {
                // Сессию [id] = $userId; В КОНТРОЛЛЕРЕ

            }
                else
            {
                // увеличиваем количество ошибочных вводов и время последнего ввода апдейтим;
            }
        }
        else
        {
            // Логин не найден;
            $this->loginAction = false;
        }

        // Если проходит -

        //echo 'ID: ';

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
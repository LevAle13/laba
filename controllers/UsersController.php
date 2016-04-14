<?php
/**
 * Created by PhpStorm.
 * User: LevAle
 * Date: 26.01.2016
 * Time: 12:32
 */

include '/models/Users.php';

class UsersController
{

    // Данные для возврата;
    public $data;

    // Конструктор; ПУСТОЙ
    public function __construct()
    {
    }

    // Логин;
    public function loginAction($requestData)
    {
        //
        $login = htmlspecialchars($requestData['login']);
        $password = htmlspecialchars($requestData['password']);
        $user = new Users();

        if ($user->readUserByLogin($login) == true)
        {
            // Проверка таймаута пользователя
            $currentTime=time();
            if ((($user->enterPassTime+5*60)>$currentTime) and ($user->failPassTry>4))
            {
                $data = array();
                $data['returnPage'] = 'redirect';
                $data['returnMessage'] = 'Вы не правильно набрали пароль 5 раз! Ожидайте 5 минут!<br><A HREF="/">Вернуться на центральную страницу</A>';
                return $data;
            }

            //echo 'login input: '.$login.'<br>pass input: '.$password.'<br>pass input md5: '. md5($password).'<br>pass bd: '.$user->password.'<br>';
            // Проверка пароля - $this->password
            if ($user->password == md5($password))
            // Успешная авторизация;
            {
                $_SESSION['userId']= $user->userId;

                $fields = array(
                    'lastLoginTime' => $currentTime,
                    'lastLoginIp' => $_SERVER['REMOTE_ADDR'],
                );

                $condition = array(
                    'userId' => $user->userId,
                );

                $user->updateFields($fields,$condition);

                $data = array();
                $data['returnPage'] = 'redirect';
                $data['returnMessage'] = 'Успешная авторизация. Нажмите на ссылку ниже для перехода в игру.<br><A HREF="/Users/main">Продолжить</A>';
                return $data;
            }
            else
            {
                //Если последняя авторизация была в течении ближайших 5 минут, увеличиваем счетчик не верных авторизаций на 1, иначе обнуляем счетчик до значения 1
                if ($user->enterPassTime+5*60>$currentTime)
                // Увеличение количества не правильных входов;
                {
                    $fields = array(
                        'enterPassTime' => $currentTime,
                        'lastLoginIp' => $_SERVER['REMOTE_ADDR'],
                        'failPassTry' => ($user->failPassTry=$user->failPassTry+1),
                    );

                    $condition = array(
                        'login' => $login,
                    );

                    $user->updateFields($fields,$condition);

                }
                else
                // Обнуление количества не правильных входов;
                {

                    $fields = array(
                        'enterPassTime' => $currentTime,
                        'lastLoginIp' => $_SERVER['REMOTE_ADDR'],
                        'failPassTry' => 1,
                    );

                    $condition = array(
                        'login' => $login,
                    );

                    $user->updateFields($fields,$condition);
                }

                //$data = array();
                $data['returnPage'] = 'redirect';
                $data['returnMessage'] = 'Вы ввели не правильный пароль! <br><A HREF="/">Вернуться на центральную страницу</A>';
                return $data;
            }
        }
        else
        {
            $data = array();
            $data['returnPage'] = 'redirect';
            $data['returnMessage'] = 'Вы ввели не правильный пароль! <br><A HREF="/">Вернуться на центральную страницу</A>';
            return $data;
        }

    }

    // Основной игровой экран;
    public function mainAction()
    {
        $this->readUser();
        $this->data['returnPage'] = 'main';
        return $this->data;
    }

    // Экран рейтинга 1;
    public function ratingAction()
    {
        $this->readUser();
        $user = new Users();
        $this->data['users']=$user->listUsers();
        $this->data['returnPage'] = 'rating';
        return $this->data;
    }

    // Экран рейтинга 2;
    public function ratingPvpAction()
    {
        $this->readUser();
        $user = new Users();
        $this->data['users']=$user->listUsersbyPvp();
        $this->data['returnPage'] = 'rating2';

        return $this->data;
    }

    // Регистрация пользователя;
    public function registerAction($requestData)
    {
        $login = htmlspecialchars($requestData['login']);
        $password1 = htmlspecialchars($requestData['password1']);
        $password2 = htmlspecialchars($requestData['password2']);
        $class = htmlspecialchars($requestData['class']);


        //print_r($requestData);
        //echo 'pass3: '.$password3;

        // Если данные уже отосланы;
        if ($login<>'')
        {
            // Проверка на пустой пароль;
            if ($password1 == '')
            {
                $data['returnMessage'] = 'Введен пустой пароль!<br><A HREF="/Users/register">Вернуться к регистрации</A>';
                $data['returnPage'] = 'redirect';
                return $data;
            }

            // Проверка на не совпадение паролей;
            if ($password1<>$password2)
            {
                $data['returnMessage'] = 'Пароли не совпадают!<br><A HREF="/Users/register">Вернуться к регистрации</A>';
                $data['returnPage'] = 'redirect';
                return $data;
            }

            // Проверка, указан ли класс персонажа;
            if ($class == '')
            {
                $data['returnMessage'] = 'Не указан класс персонажа!<br><A HREF="/Users/register">Вернуться к регистрации</A>';
                $data['returnPage'] = 'redirect';
                return $data;
            }

            // Проверяем наличие подобного логина в базе;
            $user = new Users();
            if (($user->readUserByLogin($login)) == true)
            {
                $data['returnMessage'] = 'Пользователь с данным именем уже существует!<br><A HREF="/Users/register">Вернуться к регистрации</A>';
                $data['returnPage'] = 'redirect';
                return $data;
            };


            $password=md5($password1);
            $registerTime=time();

            $data['user']['login'] = $login;
            $data['user']['password'] = $password;
            $data['user']['registrationIp'] = $_SERVER['REMOTE_ADDR'];
            $data['user']['lastLoginIp'] = $_SERVER['REMOTE_ADDR'];
            $data['user']['registerTime'] = $registerTime;
            $data['user']['failPassTry'] = 0;

            $data['user']['currentSwordAttack'] = 0;
            $data['user']['currentBowAttack'] = 0;
            $data['user']['currentMagicAttack'] = 0;
            $data['user']['currentSwordShield'] = 0;
            $data['user']['currentBowShield'] = 0;
            $data['user']['currentMagicShield'] = 0;
            $data['user']['minimumDamage'] = 1;
            $data['user']['maximumDamage'] = 3;
            $hitPoints=10;
            //Буст робы
            $boostHitPoints=1;
            $hitPoints=$hitPoints+$boostHitPoints;
            $data['user']['maximumHitPoints'] = $hitPoints;
            $data['user']['currentHitPoints'] = $hitPoints;
            $data['user']['experience'] = 0;
            $data['user']['spentExperience'] = 0;
            $data['user']['currentGold'] = 0;
            $data['user']['questGold'] = 0;
            $data['user']['questId'] = 0;
            $data['user']['questStep'] = 0; // Движение по лесу (1-10)
            $data['user']['maximumLevelQuest'] = 1;
            $data['user']['enemyId'] = 0;
            $data['user']['pvpScore'] = 0;

            // Формируем оружие;
            $data['item1']['level'] = 1;
            $data['item1']['sellingPrice'] = 1;
            $data['item1']['purchasePrice'] = 1;
            $data['item1']['minimumDamage'] = 1;
            $data['item1']['maximumDamage'] = 3;
            $data['item1']['equip'] = 1;

            // Формируем доспех;
            $data['item2']['level'] = 1;
            $data['item2']['sellingPrice'] = 1;
            $data['item2']['purchasePrice'] = 1;
            $data['item2']['hitPoints'] = $boostHitPoints;
            $data['item2']['equip'] = 1;

            if ($class == 1)
            {
                $data['user']['attackType'] = $class;
                $data['user']['currentSwordAttack'] = 1;
                $data['user']['currentSwordShield'] = 2;
                $data['item1']['itemType'] = $class;
                $data['item2']['itemType'] = 4;
                $data['item1']['SwordAttack'] = 1;
                $data['item2']['SwordShield'] = 1;
                $data['item1']['name'] = 'Меч новичка';
                $data['item2']['name'] = 'Кольчуга новичка';
            }

            if ($class == 2)
            {
                $data['user']['attackType'] = $class;
                $data['user']['currentBowAttack'] = 1;
                $data['user']['currentBowShield'] = 2;
                $data['item1']['itemType'] = $class;
                $data['item2']['itemType'] = 4;
                $data['item1']['BowAttack'] = 1;
                $data['item2']['BowShield'] = 1;
                $data['item1']['name'] = 'Лук новичка';
                $data['item2']['name'] = 'Плащ новичка';
            }

            if ($class == 3)
            {
                $data['user']['attackType'] = $class;
                $data['user']['currentMagicAttack'] = 1;
                $data['user']['currentMagicShield'] = 2;
                $data['item1']['itemType'] = $class;
                $data['item2']['itemType'] = 4;
                $data['item1']['MagicAttack'] = 1;
                $data['item2']['MagicShield'] = 1;
                $data['item1']['name'] = 'Посох новичка';
                $data['item2']['name'] = 'Роба новичка';
            }

            $user->newUser($data['user']);
            $user->readUserByLogin($login);

            $data['item1']['userId'] = $user->userId;
            $data['item2']['userId'] = $user->userId;

            include '/models/Items.php';
            $item = new Items();
            $item->newItem($data['item1']);
            $item->newItem($data['item2']);

            include '/models/Skills.php';
            $skill = new Skills();

            // Скил на ношение оружия;
            $data['skill']['userId'] =$user->userId;
            $data['skill']['skillId'] =$user->attackType+6;
            $data['skill']['skillLevel'] =1;
            $skill->newSkill($data['skill']);

            // Скил на ношение доспеха;
            $data['skill']['skillId'] =$user->attackType+6+3;
            $skill->newSkill($data['skill']);

            // Скил на атаку;
            $data['skill']['skillId'] =$user->attackType;
            $skill->newSkill($data['skill']);

            // Скил на защиту;
            $data['skill']['skillId'] =$user->attackType+3;
            $skill->newSkill($data['skill']);

            //echo 'UserId: '.$user->userId;
            $data['returnMessage'] = 'Регистрация успешна! Для входа в игру, введите логин и пароль на главной странице!<br><A HREF="/">Вернуться на главную страницу</A>';
            $data['returnPage'] = 'redirect';
            return $data;
        }
        else
        // Если нужно вывести только страницу регистрации;
        {
            $data['returnPage'] = 'register';
            return $data;
        }

    }

    // Проверка на наличие сессии у пользователя; УПРАЗДНЕНО - УДАЛИТЬ
    public function checkSession()
    {
        // Проверяем наличие сессии;
        if (isset($_SESSION['userId']))
        {
            $this->data['sessionCheck'] = true;
        }
        else
        {
            // Если сессия не найдена - выкидываем на центральную страничку;
            $this->data['returnPage'] = 'redirect';
            $this->data['returnMessage'] = 'Время Вашей сессии истекло! <br><A HREF="/">Вернуться на центральную страницу</A>';
            $this->data['sessionCheck'] = false;
        }
    }

    public function readUser()
    {
        $user = new Users();
        $user->readUserById($_SESSION['userId']);
        include '/models/Items.php';
        $item = new Items();
        $this->data['user'] = $user;
        $this->data['itemAttack'] = $item->getEquipmentAttackItem($user->userId);
        $this->data['itemShield'] = $item->getEquipmentShieldItem($user->userId);
    }


    // Добавление опыта.
    public function addExperience($experience)
    {

    }

    // Добавление золота
    public function addGold($experience)
    {
        // Добавляем в текущее хранилище персонажа.
    }

    // Добавление предмета в инвентарь.
    public function pickupItem($idItem)
    {

    }

    // Одевание предмета.
    public function useItem($idItem)
    {
        // Определение типа предмета.
    }

    // Старт квеста.
    public function questStart()
    {

    }

    // Бой.
    public function battleAction()
    {

    }

    // Бегство.
    public function runTry()
    {

    }

    // Использование элексира.
    public function usePotion()
    {

    }

    // Убийство монстра = окончание шага квеста.
    public function killMonster()
    {
        // Увеличение текущего леса+1;
        // Получение опыта.
        // Получение денег.
    }

    // Окончание квеста = Добавление золота, перенос золота в хранилище. Добавление предмета в инветарь. Увеличение уровня квеста.
    public function endQuest()
    {
        // Перенос золота в постоянное хранилище.
        // Генерация предмета и добавление его в инвентарь.
        // Увеличение уровня квеста.
    }

    // Покупка предмета.
    public function buyItem()
    {

    }

    // Учим скил.
    public function skillLearn($skillId)
    {
        // Проверка на наличие опыта.
        // Увеличение уровня скила.
        // Отнимание опыта, добавление значения в потраченный опыт.
    }
}

?>
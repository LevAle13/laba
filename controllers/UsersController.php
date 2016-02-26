<?php
/**
 * Created by PhpStorm.
 * User: LevAle
 * Date: 26.01.2016
 * Time: 12:32
 */

class UsersController
{

    public $arrayResult = array(
        'returnPage' => "",
        'returnMessage' => "",
        'errorMessage' => "",
    );

    public $heroInfo;
    public $itemData;
    public $enemyData;

    // Конструктор.
    public function __construct()
    {
    }

    // ЛОГИН;
    public function loginAction($requestData)
    {
        // Подключаем модель Users
        include '/models/Users.php';
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
    public function mainAction($requestData)
    {
        include '/models/Users.php';

        //$data = $this->checkSession();
        $data = $this::checkSession();

        if ($data['sessionCheck'] == true)
        {
            $user = new Users();
            $user->readUserById($_SESSION['userId']);


            $data['returnPage'] = 'main';
            //$this->heroInfo = $user;

            include '/models/Items.php';
            $item = new Items();


            $data['returnPage'] = 'main';
            $data['user'] = $user;
            $data['item'] = $item->getEquipmentItem($user->userId);

            return $data;
        }
    }

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
            include '/models/Users.php';
            $user = new Users();
            if (($user->readUserByLogin($login)) == true)
            {
                $data['returnMessage'] = 'Пользователь с данным именем уже существует!<br><A HREF="/Users/register">Вернуться к регистрации</A>';
                $data['returnPage'] = 'redirect';
                return $data;
            };


            $password=md5($password1);
            $registerTime=time();

            $user->login = $login;
            $user->password = $password;
            $user->registrationIp = $_SERVER['REMOTE_ADDR'];
            $user->lastLoginIp = $_SERVER['REMOTE_ADDR'];
            $user->registerTime = $registerTime;
            $user->failPassTry = 0;

            $user->currentSwordAttack = 0;
            $user->currentBowAttack = 0;
            $user->currentMagicAttack = 0;
            $user->currentSwordShield = 0;
            $user->currentBowShield = 0;
            $user->currentMagicShield = 0;
            $user->minimumDamage = 1;
            $user->maximumDamage = 3;
            $hitPoints=10;
            //Буст робы
            $boostHitPoints=1;
            $hitPoints=$hitPoints+$boostHitPoints;
            $user->maximumHitPoints = $hitPoints;
            $user->currentHitPoints = $hitPoints;
            $user->experience = 0;
            $user->spentExperience = 0;
            $user->currentGold = 0;
            $user->questGold = 0;
            $user->questId = 0;
            $user->questStep = 0; // Движение по лесу (1-10)
            $user->maximumLevelQuest = 1;
            $user->enemyId = 0;
            $user->pvpScore = 0;

            // Формируем оружие;
            $data['item1']['level'] = 1;
            $data['item1']['sellingPrice'] = 1;
            $data['item1']['purchasePrice'] = 1;

            // Формируем доспех;
            $data['item2']['level'] = 1;
            $data['item2']['sellingPrice'] = 1;
            $data['item2']['purchasePrice'] = 1;

            if ($class == 1)
            {
                $user->attackType = $class;
                $user->currentSwordAttack = 1;
                $user->currentSwordShield = 2;
                $data['item1']['currentSwordAttack'] = 1;
                $data['item2']['currentSwordShield'] = 2;


                $sh_is=1;
                $tip=1;
                $name='Меч новичка';
                $name1='Кольчуга новичка';
            }

            if ($class == 2)
            {
                $user->attackType = $class;
                $at_b=1;
                $sh_b=2;
                $sh_ib=1;
                $tip=2;
                $name='Лук новичка';
                $name1='Плащ новичка';
            }

            if ($class == 3)
            {
                $user->attackType = $class;
                $at_m=1;
                $sh_m=2;
                $sh_im=1;
                $tip=3;
                $name='Посох новичка';
                $name1='Роба новичка';
            }

            $data['user'] = $user;



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


    // Проверка на наличие сессии у пользователя;
    public static function checkSession()
    {
        // Проверяем наличие сессии;
        if (isset($_SESSION['userId']))
        {
            $data['sessionCheck'] = true;
            return $data;
        }
        else
        {
            // Если сессия не найдена - выкидываем на центральную страничку;
            $data['returnPage'] = 'redirect';
            $data['returnMessage'] = 'Время Вашей сессии истекло! <br><A HREF="/">Вернуться на центральную страницу</A>';
            $data['sessionCheck'] = false;
            return $data;
        }
    }


    // Выводим информацию по персонажу и его инвентарю.
    public function userInfo($userId)
    {
        $user = new Users();
        $user->readUser($userId);
        // ...Вызов класса рендеринга страницы...
        // ----
        // ----
        return ($user);
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
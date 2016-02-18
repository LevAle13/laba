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

    // Конструктор.
    public function __construct()
    {
    }

    // ЛОГИН;1
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
            if (($user->lastLoginTime+5*60>$currentTime) and ($user->failPassTry>4))
            {
                $this->arrayResult['returnPage'] = 'index';
                $this->arrayResult['returnMessage'] = 'Вы не правильно набрали пароль 5 раз! Ожидайте 5 минут!';
                return false;
            }

            // Проверка пароля - $this->password
            if ($user->password == md5($password))
            {
                $_SESSION['id']= $user->userId;

                $fields = array(
                    'lastLoginTime' => $currentTime,
                    'lastLoginIp' => $_SERVER['REMOTE_ADDR'],
                );

                $condition = array(
                    'userId' => $user->userId,
                );

                $user->updateFields($fields,$condition);

                $this->arrayResult['returnPage'] = 'redirect';
                $this->arrayResult['returnMessage'] = 'Успешная авторизация. Нажмите на ссылку ниже для перехода в игру.';
                return true;
            }
            else
            {
                $this->arrayResult['returnPage'] = 'index';
                $this->arrayResult['returnMessage'] = 'Вы ввели не правильный пароль!';

                //Если последняя авторизация была в течении ближайших 5 минут, увеличиваем счетчик не верных авторизаций на 1, иначе обнуляем счетчик до значения 1
                if ($user->lastLoginTime+5*60>$currentTime)
                {
                    $fields = array(
                        'lastLoginTime' => $currentTime,
                        'lastLoginIp' => $_SERVER['REMOTE_ADDR'],
                        'failPassTry' => ($user->failPassTry=$user->failPassTry+1),
                    );

                    $condition = array(
                        'login' => $login,
                    );

                    $user->updateFields($fields,$condition);

                }
                else
                {
                    $fields = array(
                        'lastLoginTime' => $currentTime,
                        'lastLoginIp' => $_SERVER['REMOTE_ADDR'],
                        'failPassTry' => 1,
                    );

                    $condition = array(
                        'login' => $login,
                    );

                    $user->updateFields($fields,$condition);
                }
                return false;
            }
        }
        else
        {
            $this->arrayResult['returnPage'] = 'index';
            $this->arrayResult['returnMessage'] = 'Вы ввели не правильный пароль!';
            return false;
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
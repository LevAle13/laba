<?php
/**
 * Created by PhpStorm.
 * User: LevAle
 * Date: 26.01.2016
 * Time: 12:32
 */

class UsersController
{

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
        $user = new UsersModel();
        $user->readUserByLogin($login, $password);

        // Проводим проверку на совпадение логина и пароля.
        // Вернуть Роутингу страницу и текст.

    }


    // Выводим информацию по персонажу и его инвентарю.
    public function userInfo($userId)
    {
        $user = new UsersModel();
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

    // Бегство.1
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
<?php
/**
 * Created by PhpStorm.
 * User: LevAle
 * Date: 26.01.2016
 * Time: 19:14
 */

class itemsController
{
    // Данные для возврата;
    public $data;

    //
    public function inventoryAction($requestData)
    {
        // Используем модель Items;
        include_once '/models/Items.php';
        $item = new Items();
        // Вызываем контроллер пользователя для получения данных;
        include "/controllers/UsersController.php";
        $myUser = new UsersController();
        $myUser->readUser();
        $this->data = $myUser->data;

        // В бою нельзя лазить в инвентарь;
        if ($this->data['user']->questId <>0)
        {
            $this->data['returnPage'] = 'main';
            $this->data['errorMessage'] = 'В бою нельзя пользоваться инвентарем!<br>Вернитесь в бой!';
        }
        else
        {

            // Любые действия над предметом проходят проверку на наличие предмета;
            if ($requestData['parseValue2']<>'')
            {
                $this->data['item'] = $item->readById($requestData['parseValue2']);
            }


            // Продаем предмет;
            if ($requestData['parseValue1']=='sell')
            {

            }
            // Одеваем предмет;
            if ($requestData['parseValue1']=='use')
            {

            }

            // Все предметы;
            $this->data['items'] = $item->readAllItemsByUserId($_SESSION['userId']);
            // Количество предметов;
            $this->data['itemsCount'] = $item->itemsCount($_SESSION['userId']);
            // Уровень скила отвечающий за количество одетых предметов;
            include_once '/models/Skills.php';
            $mySkill = new Skills();
            $this->data['skillWear'] = $mySkill->readSkillValue($_SESSION['userId'], 18);

            $this->data['returnPage'] = 'inventory';
        }


        return $this->data;
    }

    //
    public function createItem($questInfo)
    {

    }

    //
    public function loadItem()
    {

    }

    //
    public function saveItem()
    {

    }

    //
    public function buyItem()
    {

    }

    //
    public function sellItem()
    {

    }

    //
    public function deleteItem()
    {

    }


    //
    public function upgradeItem()
    {

    }

    //
    public function incrustationItem()
    {

    }

}

?>
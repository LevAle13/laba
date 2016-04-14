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



            $this->data['returnPage'] = 'inventory';
            // Продаем предмет;
            if ($requestData['parseValue1']=='sell')
            {

            }
            // Одеваем предмет;
            if ($requestData['parseValue1']=='use')
            {

            }
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
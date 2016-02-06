<?php
/**
 * Created by PhpStorm.
 * User: LevAle
 * Date: 26.01.2016
 * Time: 19:14
 */

class itemsController
{
    public $itemId;
    public $userId;
    public $itemName;
    public $itemType;
    public $itemLevel;
    public $SwordAttack;
    public $BowAttack;
    public $MagicAttack;
    public $SwordShield;
    public $BowShield;
    public $MagicShield;
    public $minimumDamage;
    public $maximumDamage;
    public $upgradeLevel;
    public $itemBuy; // Цена покупки.
    public $itemSell;// Цена продажи.
    public $tempId;  // Не помню зачем.
    public $hitPoints;
    public $up; // ЧТО ЭТО?

    // Создаем новый предмет на основе данных из квеста.
    public function createItem($questInfo)
    {

    }

    // Загружаем предмет.
    public function loadItem()
    {

    }

    // Сохраняем предмет.
    public function saveItem()
    {

    }

    // Покупка предмета.
    public function buyItem()
    {

    }

    // Продажа предмета.
    public function sellItem()
    {

    }

    // Удаляем предмет.
    public function deleteItem()
    {

    }


    // Улучшение предмета заточкой.
    public function upgradeItem()
    {

    }

    // Улучшение предмета инкрустацией.
    public function incrustationItem()
    {

    }

}

?>
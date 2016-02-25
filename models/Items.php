<?php
/**
 * Created by PhpStorm.
 * User: LevAle
 * Date: 25.02.2016
 * Time: 22:03
 */

class Items
{
    public $itemsId;
    public $userId;
    public $name;
    public $itemType;
    public $level;
    public $swordAttack;
    public $bowAttack;
    public $magicAttack;
    public $swordShield;
    public $bowShield;
    public $magicShield;
    public $minimumDamage;
    public $maximumDamage;
    public $enhancement;
    public $purchasePrice;
    public $sellingPrice;
    public $tempId;
    public $equip;
    public $hitPoints;

    public $ItemsStats = array(
        'itemsId' => '',
        'userId' => '',
        'name' => '',
        'itemType' => '',
        'level' => '',
        'swordAttack' => '',
        'bowAttack' => '',
        'magicAttack' => '',
        'swordShield' => '',
        'bowShield' => '',
        'magicShield' => '',
        'minimumDamage' => '',
        'maximumDamage' => '',
        'enhancement' => '',
        'purchasePrice' => '',
        'sellingPrice' => '',
        'tempId' => '',
        'equip' => '',
        'hitPoints' => '',
    );


    // Получаем информацию о одетом предмете и его заточке по айди персонажа;
    public function getEquipmentItem($userId)
    {
        $sql = xquery ("select name,enhancement from items where userId='".$userId."' and equip='1' order by itemType");
        for ($data=array(); $row=mysql_fetch_assoc($sql); $data[]=$row);

        return $data[0];
    }
}
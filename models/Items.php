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


    // Получаем информацию об одетом ОРУЖИИ и его заточке по айди персонажа;
    public function getEquipmentAttackItem($userId)
    {
        $sql = xquery ("select name,enhancement from items where userId='".$userId."' and equip='1' order by itemType");
        for ($data=array(); $row=mysql_fetch_assoc($sql); $data[]=$row);
        return $data[0];
    }

    // Получаем информацию о одетом ДОСПЕХЕ и его заточке по айди персонажа;
    public function getEquipmentShieldItem($userId)
    {
        $sql = xquery ("select name,enhancement from items where userId='".$userId."' and equip='1' and itemType = '4'");
        for ($data=array(); $row=mysql_fetch_assoc($sql); $data[]=$row);
        return $data[0];
    }

    // Новый пользователь
    public function newItem($fields)
    {

        $sqlText1 = 'INSERT INTO items (';
        $sqlText2 = ' VALUES (';
        foreach($fields as $key => $value)
        {
            $sqlText1 = $sqlText1 . $key . ', ';
            $sqlText2 = $sqlText2 .'"'. $value . '", ';
        }

        $sqlText1 = substr($sqlText1, 0, -2);
        $sqlText2 = substr($sqlText2, 0, -2);

        $sqlText1 = $sqlText1.') ';
        $sqlText2 = $sqlText2.')';

        $sqlText=$sqlText1.$sqlText2;

        //echo 'RESULT SQL: '.$sqlText1.$sqlText2.'<br>';

        $result = xquery($sqlText);
    }

    // Получаем информацию об одетом ОРУЖИИ и его заточке по айди персонажа;
    public function getUserItems($userId)
    {
        $sql = xquery ("select * from items where userId='".$userId."' order by level DESC");
        for ($data=array(); $row=mysql_fetch_assoc($sql); $data[]=$row);
        return $data[0];
    }
}
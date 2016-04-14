<?php
/**
 * Created by PhpStorm.
 * User: LevAle
 * Date: 14.04.2016
 * Time: 12:55
 */

// Оружие;
foreach($viewsData['items'] as $myItems)
{
    if (($myItems['itemType']>0) and ($myItems['itemType']<3)and ($myItems['equip']==1))
    {
        if ($myItems['enhancement']>0) {$enhancedText =' +'.$myItems['enhancement'];} else {$enhancedText ='';} ;
        $itemName = "<A id = 'itemUse' HREF='/Items/inventory/use/".$myItems['itemsId']."'>".$myItems['name'].$enhancedText."</a>";

        $itemDescription = 'Вред: '.$myItems['minimumDamage'].'-'.$myItems['maximumDamage'].'<br>';
        if ($myItems['swordAttack']>0) { $itemDescription.="Усиление атаки: +".$myItems['swordAttack'];}
        if ($myItems['bowAttack']>0) { $itemDescription.="Усиление атаки: +".$myItems['bowAttack'];}
        if ($myItems['magicAttack']>0) { $itemDescription.="Усиление атаки: +".$myItems['magicAttack'];}
    }
}

$weaponText = "<table border='1' width='230' border=0 cellspacing='1' cellpadding='4' bgcolor='#FAAAAA'>
        <tr>
            <td VALIGN='top' bgcolor='#FFF2C4' width='230'><div id = 'itemTitle'>".$itemName."</div></td>
	        <td VALIGN='top' bgcolor='#FFF2C4' width='30' align = 'center'><div id = 'itemLevel'>".$myItems['level']."</div></td>
	    </tr>
	    <tr>
	        <td bgcolor='#FDF5E6' colspan='2' >
	            <div id = 'itemDescription'>".$itemDescription."</div>
	        </td>


	    </tr>
	    <tr>
	        <td  bgcolor='#FDF5E6' colspan='2' ALIGN = 'RIGHT'>
                <div id = 'itemSell'><A HREF='/Items/inventory/sell/".$myItems['itemsId']."'>Продать: </a>".$myItems['sellingPrice']."</div>
	        </td>
	    </tr>
	  </table>
	  <br>";


// Доспехи;
foreach($viewsData['items'] as $myItems)
{
    if (($myItems['itemType']==4) and ($myItems['equip']==1))
    {
        if ($myItems['enhancement']>0) {$enhancedText =' +'.$myItems['enhancement'];} else {$enhancedText ='';} ;
        $itemName = "<A id = 'itemUse' HREF='/Items/inventory/use/".$myItems['itemsId']."'>".$myItems['name'].$enhancedText."</a>";

        $itemDescription = 'Здоровье: +'.$myItems['hitPoints'].'<br>';
        if ($myItems['swordShield']>0) { $itemDescription.="Защита от меча: ".$myItems['swordShield'].'<br>';}
        if ($myItems['bowShield']>0) { $itemDescription.="Защита от лука: ".$myItems['bowShield'].'<br>';}
        if ($myItems['magicShield']>0) { $itemDescription.="Защита от магии: ".$myItems['magicShield'].'<br>';}
    }
}

$armorText = "<table border='1' width='230' border=0 cellspacing='1' cellpadding='4' bgcolor='#FAAAAA'>
        <tr>
            <td VALIGN='top' bgcolor='#FFF2C4' width='230'><div id = 'itemTitle'>".$itemName."</div></td>
	        <td VALIGN='top' bgcolor='#FFF2C4' width='30' align = 'center'><div id = 'itemLevel'>".$myItems['level']."</div></td>
	    </tr>
	    <tr>
	        <td bgcolor='#FDF5E6' colspan='2' >
	            <div id = 'itemDescription'>".$itemDescription."</div>
	        </td>


	    </tr>
	    <tr>
	        <td  bgcolor='#FDF5E6' colspan='2' ALIGN = 'RIGHT'>
                <div id = 'itemSell'><A HREF='/Items/inventory/sell/".$myItems['itemsId']."'>Продать: </a>".$myItems['sellingPrice']."</div>
	        </td>
	    </tr>
	  </table>
	  <br>";

// Не надетое снаряжение;
$notEquipmentItems = '';
foreach($viewsData['items'] as $myItems)
{
    if (($myItems['itemType']>0) and ($myItems['itemType']<5)and ($myItems['equip']==0))
    {
    if ($myItems['enhancement']>0) {$enhancedText =' +'.$myItems['enhancement'];} else {$enhancedText ='';} ;
    $itemName = "<A id = 'itemUse' HREF='/Items/inventory/use/".$myItems['itemsId']."'>".$myItems['name'].$enhancedText."</a>";

        if ($myItems['itemType']<4)
        {
            $itemDescription = 'Вред: '.$myItems['minimumDamage'].'-'.$myItems['maximumDamage'].'<br>';
            if ($myItems['swordAttack']>0) { $itemDescription.="Усиление атаки: +".$myItems['swordAttack'];}
            if ($myItems['bowAttack']>0) { $itemDescription.="Усиление атаки: +".$myItems['bowAttack'];}
            if ($myItems['magicAttack']>0) { $itemDescription.="Усиление атаки: +".$myItems['magicAttack'];}
        }
        else
        {
            $itemDescription = 'Здоровье: +'.$myItems['hitPoints'].'<br>';
            if ($myItems['swordShield']>0) { $itemDescription.="Защита от меча: ".$myItems['swordShield'].'<br>';}
            if ($myItems['bowShield']>0) { $itemDescription.="Защита от лука: ".$myItems['bowShield'].'<br>';}
            if ($myItems['magicShield']>0) { $itemDescription.="Защита от магии: ".$myItems['magicShield'].'<br>';}
        }

        $itemText = "<table border='1' width='230' border=0 cellspacing='1' cellpadding='4' bgcolor='#FAAAAA'>
        <tr>
        <td VALIGN='top' bgcolor='#FFF2C4' width='230'><div id = 'itemTitle'>".$itemName."</div></td>
        <td VALIGN='top' bgcolor='#FFF2C4' width='30' align = 'center'><div id = 'itemLevel'>".$myItems['level']."</div></td>
        </tr>
        <tr>
        <td bgcolor='#FDF5E6' colspan='2' >
            <div id = 'itemDescription'>".$itemDescription."</div>
        </td>


        </tr>
        <tr>
        <td  bgcolor='#FDF5E6' colspan='2' ALIGN = 'RIGHT'>
            <div id = 'itemSell'><A HREF='/Items/inventory/sell/".$myItems['itemsId']."'>Продать: </a>".$myItems['sellingPrice']."</div>
        </td>
        </tr>
        </table>
        <br>";

        $notEquipmentItems .=  $itemText;
    }
}

// Улучшения;
$enchantments = '';
foreach($viewsData['items'] as $myItems)
{
    if (($myItems['itemType']>5) and ($myItems['itemType']<9))
    {
        if ($myItems['enhancement']>0) {$enhancedText =' +'.$myItems['enhancement'];} else {$enhancedText ='';} ;
        $itemName = "<A id = 'itemUse' HREF='/Items/inventory/use/".$myItems['itemsId']."'>".$myItems['name'].$enhancedText."</a>";


        $itemText = "<table border='1' width='230' border=0 cellspacing='1' cellpadding='4' bgcolor='#FAAAAA'>
        <tr>
        <td VALIGN='top' bgcolor='#FFF2C4' width='230'><div id = 'itemTitle'>".$itemName."</div></td>
        <td VALIGN='top' bgcolor='#FFF2C4' width='30' align = 'center'><div id = 'itemLevel'>".$myItems['level']."</div></td>
        </tr>

        <tr>
        <td  bgcolor='#FDF5E6' colspan='2' ALIGN = 'RIGHT'>
            <div id = 'itemSell'><A HREF='/Items/inventory/sell/".$myItems['itemsId']."'>Продать: </a>".$myItems['sellingPrice']."</div>
        </td>
        </tr>
        </table>
        <br>";

        $enchantments .=  $itemText;
    }
}

// Расходуемое;
$potions = '';
foreach($viewsData['items'] as $myItems)
{
    if (($myItems['itemType']== 5) or ($myItems['itemType'] == 9))
    {
        if ($myItems['enhancement']>0) {$enhancedText =' +'.$myItems['enhancement'];} else {$enhancedText ='';} ;
        $itemName = "<A id = 'itemUse' HREF='/Items/inventory/use/".$myItems['itemsId']."'>".$myItems['name'].$enhancedText."</a>";


        $itemText = "<table border='1' width='230' border=0 cellspacing='1' cellpadding='4' bgcolor='#FAAAAA'>
        <tr>
        <td VALIGN='top' bgcolor='#FFF2C4' width='230'><div id = 'itemTitle'>".$itemName."</div></td>
        <td VALIGN='top' bgcolor='#FFF2C4' width='30' align = 'center'><div id = 'itemLevel'>".$myItems['level']."</div></td>
        </tr>

        <tr>
        <td  bgcolor='#FDF5E6' colspan='2' ALIGN = 'RIGHT'>
            <div id = 'itemSell'><A HREF='/Items/inventory/sell/".$myItems['itemsId']."'>Продать: </a>".$myItems['sellingPrice']."</div>
        </td>
        </tr>
        </table>
        <br>";

        $potions .=  $itemText;
    }
}

// Количество вещей в инвентаре;
// Количество максимально возможных вещей;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Проект Гринд</title>
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/inventory.css" rel="stylesheet">


</head>
<body>
<header>
    <div class="container">
        <IMG src="/pic/top1.jpg" class="img-responsive" class="img-rounded"  width="100%">
    </div>
</header>

<main>
    <div class="container">
        <div class="row" style ="border: 1px solid blue;">

            <?php include 'UserInfo.php';?>

            <div class="col-md-9 col-lg-9" style ="border: 1px solid rgba(116, 23, 187, 0.19);">
                <div style="font-family: Tahoma; font-size: 14pt; font-weight:bold; color: blue; ">

                    <br>

                    <?php
                    if ($viewsData['errorMessage']<>'')
                    {
                        echo "<div style='color: red; text-align: center'>".$viewsData['errorMessage']."</div><hr>";
                    }

                    //print_r($viewsData['items']);

                    echo "<div style='text-align: center'><A HREF='/Users/main'>Вернуться назад</A></center><hr></div>";

                    echo '
                    <table border="0" width="100%">
                        <tr>
                            <td width="50%" align="center">ОРУЖИЕ</td>
                            <td width="50%" align="center">ДОСПЕХИ</td>
                        </tr>
                        <tr>
                            <td width="50%" align="center">'.$weaponText.'</td>
                            <td width="50%" align="center">'.$armorText.'</td>
                        </tr>
                    </table>';

                    echo "<hr><div style='text-align: center'>Инвентарь (".$viewsData['itemsCount']." из ".(10+$viewsData['skillWear']['skillLevel']).")</div><hr>";

                    echo '
                    <table border="0" width="100%">
                        <tr>
                            <td width="33%" align="center">УЛУЧШЕНИЯ</td>
                            <td width="33%" align="center">РАСХОДУЕМОЕ</td>
                            <td width="33%" align="center">СНАРЯЖЕНИЕ</td>
                        </tr>
                        <tr>
                            <td width="33%" valign="top" align="center">'.$enchantments.'</td>
                            <td width="33%" valign="top" align="center">'.$potions.'</td>
                            <td width="33%" valign="top" align="center">'.$notEquipmentItems.'</td>
                        </tr>
                    </table><hr>';

                    ?>

                    <br>




                </div>
            </div>



        </div>
    </div>
</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>

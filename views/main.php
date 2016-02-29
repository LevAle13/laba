<?php
/**
 * Created by PhpStorm.
 * User: LevAle
 * Date: 25.02.2016
 * Time: 20:04
 */


// Процент жизни.
$hp_proc=(int)((($viewsData['user']->currentHitPoints)*100)/($viewsData['user']->maximumHitPoints));
// Линия жизни.
$lineOfLife="<center><table height='20' width='100%' cellpadding='0' cellspacing='0' border='0'><tr>";
$hitPointLine = (int)($hp_proc/5);
if ($hitPointLine<1) $hitPointLine=1;
for ($x=1; $x<=20; $x=$x+1)
{
    if ($x<=$hitPointLine) {$hpColor='green';} else {$hpColor='yellow';}
    $lineOfLife=$lineOfLife."<td bgcolor='".$hpColor."' width='9' height='9'>";
}
$lineOfLife=$lineOfLife."</tr></table></center>";

switch ($viewsData['user']->attackType) {
    case 1:
        $attackType = 'Воин (атакует мечом)';
        $attackStats = 'Физ атака: '.$viewsData['user']->currentSwordAttack;
        break;
    case 2:
        $attackType = 'Лучник (атакует луком)';
        $attackStats = 'Физ атака: '.$viewsData['user']->currentBowAttack;
        break;
    case 3:
        $attackType = 'Маг (атакует посохом)';
        $attackStats = 'Физ атака: '.$viewsData['user']->currentMagicAttack;
        break;
}

$experience ='Опыт: '.$viewsData['user']->experience.' ('.$viewsData['user']->spentExperience.')';
$hitPoints = 'Здоровье: '.$viewsData['user']->currentHitPoints.' ('.$viewsData['user']->maximumHitPoints.')';
$gold = 'Золото: '.$viewsData['user']->currentGold.' ('.$viewsData['user']->questGold.')';
$damage = 'Вред: '.$viewsData['user']->minimumDamage.' - '.$viewsData['user']->maximumDamage;
$shields = 'Физ. защита: '.$viewsData['user']->currentSwordShield.'<br> Лук защита: '.$viewsData['user']->currentBowShield.'<br> Маг защита: '.$viewsData['user']->currentMagicShield;

$itemBonus='';
if (($viewsData['itemAttack']['enhancement'])<>0)
{
    $itemBonus=' +'.$viewsData['itemAttack']['enhancement'];
};
$itemAttack=$viewsData['itemAttack']['name'].$itemBonus;

$itemBonus='';
if (($viewsData['itemShield']['enhancement'])<>0)
{
    $itemBonus=' +'.$viewsData['itemShield']['enhancement'];
};
$itemShield=$viewsData['itemShield']['name'].$itemBonus;

/*


*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Проект Гринд</title>
<link href="/css/bootstrap.css" rel="stylesheet">


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

                 <div class="col-md-3 col-lg-3" style ="border: 1px solid rgba(116, 23, 187, 0.19);">
                     <div style="font-family: Tahoma; font-size: 14pt; font-weight:bold; color: blue; ">
                        <?php echo $viewsData['user']->login;?>
                     </div>

                     <br>
                     <?php echo $lineOfLife;?><hr>
                     <?php echo $attackType;?><hr>
                     <?php echo $experience;?><br>
                     <?php echo $hitPoints;?><br>
                     <?php echo $gold;?><hr>
                     <?php echo $damage;?><br>
                     <?php echo $attackStats;?><hr>
                     <?php echo $shields;?><hr>
                     <?php echo $itemAttack;?><br>
                     <?php echo $itemShield;?><br><br>


                 </div>

                 <div class="col-md-9 col-lg-9" style ="border: 1px solid rgba(116, 23, 187, 0.19);">
                     <div style="font-family: Tahoma; font-size: 14pt; font-weight:bold; color: blue; ">
                         <br>
                         <A HREF='/Users/questSelect'>Начать приключение</A><br><br>
                         <A HREF='/Items/invent'>Инвентарь</A>
                         &nbsp;<A HREF='/Items/invent2'>+</A><br><br>
                         <A HREF='/Users/skills'>Умения</A><br><br>
                         <A HREF='/Items/itemShop'>Магазин оружия и доспехов</A><br><br>
                         <A HREF='/Items/potionShop'>Магазин Эликсиров</A><br><br>
                         <A HREF='/Users/rating'>Рейтинг игроков</A><br><br>
                         <A HREF='/Users/ratingPvp'>PVP Рейтинг</A><br>
                     </div>
                 </div>



             </div>
        </div>
    </main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
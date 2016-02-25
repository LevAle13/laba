<?php
/**
 * Created by PhpStorm.
 * User: LevAle
 * Date: 25.02.2016
 * Time: 20:04
 */


switch ($this->heroInfo->attackType) {
    case 1:
        $attackType = 'Воин (атакует мечом)';
        $attackStats = 'Физ атака: '.$this->heroInfo->currentSwordAttack;
        break;
    case 2:
        $attackType = 'Лучник (атакует луком)';
        $attackStats = 'Физ атака: '.$this->heroInfo->currentBowAttack;
        break;
    case 3:
        $attackType = 'Маг (атакует посохом)';
        $attackStats = 'Физ атака: '.$this->heroInfo->currentMagicAttack;
        break;
}

$experience ='Опыт: '.$this->heroInfo->experience.' ('.$this->heroInfo->spentExperience.')';
$hitPoints = 'Здоровье: '.$this->heroInfo->currentHitPoints.' ('.$this->heroInfo->maximumHitPoints.')';
$gold = 'Золото: '.$this->heroInfo->currentGold.' ('.$this->heroInfo->questGold.')';
$damage = 'Вред: '.$this->heroInfo->minimumDamage.' - '.$this->heroInfo->maximumDamage;
$shields = 'Физ. защита: '.$this->heroInfo->currentSwordShield.'<br> Лук защита: '.$this->heroInfo->currentBowShield.'<br> Маг защита: '.$this->heroInfo->currentMagicShield;

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
                        <?php echo $this->heroInfo->login;?>
                     </div>

                     <hr>
                     <?php echo $attackType;?><hr>
                     <?php echo $experience;?><br>
                     <?php echo $hitPoints;?><br>
                     <?php echo $gold;?><hr>
                     <?php echo $damage;?><br>
                     <?php echo $attackStats;?><hr>
                     <?php echo $shields;?><br>

                     <?php echo $user->login;?><br>


                 </div>

                 <div class="col-md-6 col-lg-6" style ="border: 1px solid rgba(116, 23, 187, 0.19);">
                     Основной экран
                 </div>

                 <div class="col-md-3 col-lg-3" style ="border: 1px solid rgba(116, 23, 187, 0.19);">
                     Описание противника
                 </div>


             </div>
        </div>
    </main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
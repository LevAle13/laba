<?php
/**
 * Created by PhpStorm.
 * User: LevAle
 * Date: 25.04.2016
 * Time: 23:15
 */

// Подключаем описание скилов;
include 'skillsList.php';

// Надпись с ошибкой;
if ($viewsData['errorMessage']<>'')
{
    $errorMessage =  "<div style='color: red; text-align: center'>".$viewsData['errorMessage']."</div><hr>";
}
else
{
    $errorMessage =  '';
}

//$skillCount=0;
$skillsView = '';
foreach($viewsData['skillsList'] as $mySkills)
{
    //$skillCount=$skillCount+1;
    $arraySkills[$mySkills['skillId']] = $mySkills['skillLevel'];
    $needExp = ($mySkills['skillLevel']+1)*10;

    // Выучить скил;
    if ($needExp<=$viewsData['user']->experience)
    {
        $learnSkillLink="<A HREF='/Skills/".$this->data['skillList'].'/'.($mySkills['skillId'])."'><center><font size=2 face='Verdana'>Улучшить</font></center></a>";
    }
    else
    {
        $learnSkillLink="<center>----</center>";
    }

    if ($mySkills['skillLevel'==100])
    {
        $learnSkillLink="<center>-MAX-</center>";
    }

    $skillText =
    "
    <tr>
        <td width='60%' bgcolor='white'><font size=2 face='Verdana'>".$SKILLS_LIST[($mySkills['skillId'])]."</font></td>
        <td ALIGN='center' bgcolor='white'>".($mySkills['skillLevel'])."</td>
        <td ALIGN='center' bgcolor='white'>".(($mySkills['skillLevel']+1)*10)."</td>
        <td width='10%' bgcolor='white'>".$learnSkillLink."</td>
    </tr>
    ";

    $skillsView .=  $skillText;
};

$unlearnedSkillsView = '';

if ($this->data['skillList'] == 'all')
{
    for ($i=1; $i<22; $i=$i+1)
    {

        if ($arraySkills[$i]==0)
        {

            $needExp = ($arraySkills[$i]+1)*10;
            if ($needExp<=$viewsData['user']->experience)
            {
                $learnSkillLink="<A HREF='/Skills/".$this->data['skillList'].'/'.($i)."'><center><font size=2 face='Verdana'>Улучшить</font></center></a>";
            }
            else
            {
                $buk='<center>----</center>';
            };


            $skillText =
            "
            <tr>
            <td width='60%' bgcolor='white'><font size=2 face='Verdana'>".$SKILLS_LIST[$i]."</font></td>
            <td ALIGN='center' bgcolor='white'>0</td>
            <td ALIGN='center' bgcolor='white'>".(($arraySkills['skillLevel']+1)*10)."</td>
            <td width='10%' bgcolor='white'>".$learnSkillLink."</td>
            </tr>
            ";

            $arraySkills[$i]=0;
            $unlearnedSkillsView .= $skillText;
        };

    };

        $unlearnedSkillsText = "
                <center><b>Не выученные скилы: </b></center>
                    <table border='1' width='100%' border=0 cellspacing='1' cellpadding='2' bgcolor='#AAAAAA'>
                        <tr>
                            <td ALIGN='center' width='60%' bgcolor='white'>Умение</td>
                            <td ALIGN='center' width='10%' bgcolor='white'>Уровень</td>
                            <td ALIGN='center' width='20%' bgcolor='white'>Цена улучшения</td>
                            <td ALIGN='center' width='10%' bgcolor='white'>Улучшение</td>
                        </tr>
                        ".$unlearnedSkillsView."
                </table>";

}
else
{
    // Отобразить все скилы;
    $unlearnedSkillsText =  "<center><A HREF='/Skills/list/all'>Отобразить не выученнные скилы</A></center>";
}


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

            <?php include 'userInfo.php';?>

            <div class="col-md-9 col-lg-9" style ="border: 1px solid rgba(116, 23, 187, 0.19);">
                <div style="font-family: Tahoma; padding: 3px; font-size: 11pt; color: black; ">

                    <?php echo $errorMessage ?>


                    <div style='text-align: center'><A HREF='/Users/main'>Вернуться назад</A></center><hr></div>
                    <center><b>Выученные скилы: </b></center>
                    <table border='1' width='100%' border=0 cellspacing='1' cellpadding='2' bgcolor='#AAAAAA'>
                        <tr>
                            <td ALIGN='center' width='60%' bgcolor='white'>Умение</td>
                            <td ALIGN='center' width='10%' bgcolor='white'>Уровень</td>
                            <td ALIGN='center' width='20%' bgcolor='white'>Цена улучшения</td>
                            <td ALIGN='center' width='10%' bgcolor='white'>Улучшение</td>
                        </tr>
                        <?php echo $skillsView ?>
                    </table>

                    <?php echo $unlearnedSkillsText ?>

                    <hr>
                    <div style='text-align: center'><A HREF='/Users/main'>Вернуться назад</A></center></div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
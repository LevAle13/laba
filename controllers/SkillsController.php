<?php
/**
 * Created by PhpStorm.
 * User: LevAle
 * Date: 26.01.2016
 * Time: 20:05
 */
class skillsController
{
    public $userId;
    public $skill;
    public $skillLevel;
    public $experienceSpent = 0;

    // Данные для возврата;
    public $data;
    public $skillFilter = true;

    public function listAction($requestData)
    {
        // Используем модель Skills;
        include_once '/models/Skills.php';
        $skills = new Skills();
        // Вызываем контроллер пользователя для получения данных;
        include "/controllers/UsersController.php";
        $myUser = new UsersController();
        $myUser->readUser();
        $this->data = $myUser->data;

        // В бою нельзя учить скилы;
        if ($this->data['user']->questId <>0)
        {
            $this->data['returnPage'] = 'main';
            $this->data['errorMessage'] = 'В бою нельзя учить скилы!<br>Вернитесь в бой!';
        }
        else
        {
            // Определяем будут ли выводиться только выученные или все скилы;
            if ($requestData['parseValue1']=='learned')
            {
                $this->data['skillList'] = 'learned';
            }

            if ($requestData['parseValue1']=='all')
            {
                $this->data['skillList'] = 'all';
            }

            // Проверка на то, чтобы скил не был выше 21 (предел);
            if (($requestData['parseValue2']>21) or ($requestData['parseValue2']<1))
            {
                //$this->data['errorMessage'] = 'Указан не существующий скил!';
                $this->skillFilter = false;
            }
            else
            {
                // Флаг определяющий был выучен скил или нет;
                $skillLearn = false;

                // Пытаемся учить скил если его нам прислали;
                $learnSkillId = $requestData['parseValue2'];
                $skillInfo = $skills->readSkillById($_SESSION['userId'],$learnSkillId);

                // Скил еще не выучен;
                if ($skillInfo['skillCount'] == 0)
                {
                    $skillCost=10;
                    $newSkillLevel=1;

                    //Не хватает экспы на выучивание
                    if ($skillCost > $this->data['user']->expirience)
                    {
                        $this->data['errorMessage'] = "<center><font size=3 face='Verdana' color='red'>Не хватает опыта для выучивания нового скила!<br></font></center>";
                    }
                    else
                    {
                        // Инсертим новый скил в БД;
                        $skillLearn = true;
                        $skills->addNewSkill($_SESSION['userId'],$learnSkillId);
                        $this->data['errorMessage'] = "<center><font size=3 face='Verdana' color='red'>Новый скил успешно выучен!<br></font></center>";
                    };
                }
                // Скил уже выучен;
                else
                {
                    $newSkillLevel = $skillInfo['skillLevel']+1;
                    $skillCost = $newSkillLevel*10;

                    //Не хватает экспы на выучивание
                    if ($skillCost > $this->data['user']->expirience)
                    {
                        $this->data['errorMessage'] = "<center><font size=3 face='Verdana' color='red'>Не хватает опыта для улучшения данного скила!<br></font></center>";
                    }
                    else
                    {
                        // Проверка на максимально допустимый уровень скила;
                        if ($newSkillLevel>100)
                        {
                            $this->data['errorMessage'] = "<center><font size=3 face='Verdana' color='red'>Вы прокачали максимальный уровень скила!<br></font></center>";
                        }
                        else
                        {
                            // Апдейтим существующий;
                            $skillLearn = true;
                            $skills->updateSkill($_SESSION['userId'],$learnSkillId,$newSkillLevel);
                            $this->data['errorMessage'] = "<center><font size=3 face='Verdana' color='red'>Скил успешно выучен!<br></font></center>";
                        }
                    };

                }

                // Скил был выучен и нам необходимо обновить параметры;
                if ($skillLearn == true)
                {
                    $newSpentExperience = $this->data['user']->spentExperience + $skillCost;
                    $newUserExperience =  $this->data['user']->experience - $skillCost;

                    if ($learnSkillId = 1)

                    if ($skill_id==1) $at1=$at1+1;
                    if ($skill_id==2) $at2=$at2+1;
                    if ($skill_id==3) $at3=$at3+1;
                    if ($skill_id==4) $sh1=$sh1+1;
                    if ($skill_id==5) $sh2=$sh2+1;
                    if ($skill_id==6) $sh3=$sh3+1;
                    if ($skill_id==13)
                    {
                        $hp_max=$hp_max+5;
                        $hp_tek=$hp_max;

//			echo "Новое здоровье: ".$hp_max;
                    };

                    $sql=xquery('update users set at_s="'.$at1.'",at_b="'.$at2.'",at_m="'.$at3.'",sh_s="'.$sh1.'",sh_b="'.$sh2.'",sh_m="'.$sh3.'",hp_tek="'.$hp_tek.'",hp_max="'.$hp_max.'",xp="'.$xp.'",spend_xp="'.$spend_xp.'" where id="'.$_SESSION['id'].'" ');
                    $rs = xquery($sql);




                    $_SESSION['userId']= $user->userId;

                    $fields = array(
                        'lastLoginTime' => $currentTime,
                        'lastLoginIp' => $_SERVER['REMOTE_ADDR'],
                    );

                    $condition = array(
                        'userId' => $user->userId,
                    );

                    $user->updateFields($fields,$condition);
                }

            }

            // Проверка на наличие опыта и прочего;

            // Получаем все скилы пользователя;
            $this->data['skillsList'] = $skills->readAllSkills($_SESSION['userId']);


            $this->data['returnPage'] = 'skills';
            return $this->data;

        }

    }

    public function skillFilter()
    {

    }


}

?>
<?php
/**
 * Created by PhpStorm.
 * User: LevAle
 * Date: 26.01.2016
 * Time: 12:32
 */

class UsersController
{

    // �����������.
    public function __construct()
    {
    }


    // ������� ���������� �� ��������� � ��� ���������.
    public function userInfo($userId)
    {
        $user = new UsersModel();
        $user->readUser($userId);
        // ...����� ������ ���������� ��������...
        // ----
        // ----
        return ($user->login);
    }

    // ���������� �����.
    public function addExperience($experience)
    {

    }

    // ���������� ������.
    public function addGold($experience)
    {
        // ��������� � ������� ��������� ���������.
    }

    // ���������� �������� � ���������.
    public function pickupItem($idItem)
    {

    }

    // �������� ��������.
    public function useItem($idItem)
    {
        // ����������� ���� ��������.
    }

    // ����� ������.
    public function questStart()
    {

    }

    // ���.
    public function battleAction()
    {

    }

    // �������.
    public function runTry()
    {

    }

    // ������������� ��������.
    public function usePotion()
    {

    }

    // �������� ������� = ��������� ���� ������.
    public function killMonster()
    {
        // ���������� �������� ����+1;
        // ��������� �����.
        // ��������� �����.
    }

    // ��������� ������ = ���������� ������, ������� ������ � ���������. ���������� �������� � ��������. ���������� ������ ������.
    public function endQuest()
    {
        // ������� ������ � ���������� ���������.
        // ��������� �������� � ���������� ��� � ���������.
        // ���������� ������ ������.
    }

    // ������� ��������.
    public function buyItem()
    {

    }

    // ���� ����.
    public function skillLearn($skillId)
    {
        // �������� �� ������� �����.
        // ���������� ������ �����.
        // ��������� �����, ���������� �������� � ����������� ����.
    }
}

?>
<?php
/**
 * Created by PhpStorm.
 * User: Dmitry^
 */

require_once "hh/ResumeUpdate.php";

use HHUpdate\ResumeUpdate as ResumeUpdate;

/* Config */
$HHResume = ""; // ID Резюме
$HHToken = ""; // Токен для доступа на HeadHunter
$SMSToken = ""; //SMS.ru Токен для отправки смс
$Phone = ""; //Ваш номер телефона

/* Обновление резюме */
$Update = new ResumeUpdate($HHResume, $HHToken, $SMSToken, $Phone); //Входные параметры
$Update->UpdateResume(); // Вызов функции обновления

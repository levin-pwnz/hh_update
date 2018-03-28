<?php
/**
 * Created by PhpStorm.
 * User: Dmitry^
 */

require_once "hh/ResumeUpdate.php";

use HHUpdate\ResumeUpdate as ResumeUpdate;

/* Config */
$HHResume = ""; // id resume
$HHToken = ""; // token for access to hh.ru
$SMSToken = ""; //SMS.ru token for send notification sms
$Phone = ""; //Phone
/* Обновление резюме */
$Update = new ResumeUpdate($HHResume, $HHToken, $SMSToken, $Phone); //Input parametrs
$Update->UpdateResume(); // Call update function

<?php
/**
 * Created by PhpStorm.
 * User: Dmitry^
 */

namespace HHUpdate;

class ResumeUpdate
{
    private $resume;
    private $token;
    private $smstoken;
    private $phone;


    function __construct($resume, $token, $smstoken, $phone)
    {
        $this->resume = $resume;
        $this->token = $token;
        $this->smstoken = $smstoken;
        $this->phone = $phone;

        if (!$resume || !$token || !$smstoken || !$phone) {

            exit("Some input parameters are incorrect. Please check index.php");
        }
    }

    private function SendSms($msg)
    {
        $ch = curl_init("https://sms.ru/sms/send");
        $data =
            [
                "to" => $this->phone,
                "msg" => $msg,
                "api_id" => $this->smstoken
            ];

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        return curl_exec($ch);


    }

    public function UpdateResume()
    {
        $ch = curl_init("https://api.hh.ru/resumes/" . $this->resume . "/publish");

        $data =
            [
                "resume_id" => $this->resume
            ];

        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $this->token));

        $result = curl_exec($ch);
        $result = json_decode($result, true);

        if (empty($result)) {
            $status = "Resume update complete!";
        } else {
            $status = $result['description'];
        }

        curl_close($ch);

        return $this->SendSms($status);
    }
}
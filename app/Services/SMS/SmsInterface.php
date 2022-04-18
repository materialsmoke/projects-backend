<?php
namespace App\Services\SMS;

interface SmsInterface {

    public function send($text);

}
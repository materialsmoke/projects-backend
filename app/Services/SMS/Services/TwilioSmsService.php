<?php
namespace App\Services\SMS\Services;

use App\Services\SMS\SmsInterface;
use Illuminate\Support\Facades\Log;

class TwilioSmsService implements SmsInterface
{
    public function send($text)
    {
        Log::info('here is send sms service');
        Log::info($text);
    }
}
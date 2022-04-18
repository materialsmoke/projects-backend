<?php

namespace App\Listeners;

use App\Jobs\SendSmsNotificationJob;
use App\Services\SMS\SmsInterface;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendStoppedProjectNotificationListener
{
    private $sms;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(SmsInterface $sms)
    {
        $this->sms = $sms;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        SendSmsNotificationJob::dispatch( $event->project,$this->sms);
    }
}

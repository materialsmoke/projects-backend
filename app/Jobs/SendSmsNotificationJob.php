<?php

namespace App\Jobs;

use App\Project;
use App\Services\SMS\SmsInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendSmsNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $project;
    private $sms;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    // public function __construct(SmsInterface $sms, Project $project)
    public function __construct( Project $project, $sms)
    {
        $this->project = $project;
        $this->sms = $sms;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if($this->project->is_stopped == 0){
            // call sms service
            //send project started sms... started time...
            Log::info('Project ' . $this->project->id . ' started');
            
            $this->sms->send('SMS Project ' . $this->project->id . ' started');
        }else{
            // call sms service
            //send project stopped sms... stopped time and summary and...
            Log::info('Project ' . $this->project->id . ' stopped');

            $this->sms->send('SMS Project ' . $this->project->id . ' stopped');
        }

        
    }
}

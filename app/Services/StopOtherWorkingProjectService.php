<?php
namespace App\Services;

use App\Entry;

class StopOtherWorkingProjectService
{
    public function __construct($user)
    {
        $this->user = $user;
    }

    public function handle()
    {
        $projectIds = [];
        foreach($this->user->projects as $projectItem){
            $projectIds[] = $projectItem->id;
        }

        $unStoppedEntry = Entry::whereIn('project_id', $projectIds)->where('end', null)->first();
        if($unStoppedEntry){
            $unStoppedEntry->end = now();
            $unStoppedEntry->save();
    
            // $unStoppedEntry->project->working_time_seconds = $unStoppedEntry->project->working_time_seconds + now()->diffInSeconds($unStoppedEntry->start);
            // $unStoppedEntry->project->save();
        }
        
    }
}
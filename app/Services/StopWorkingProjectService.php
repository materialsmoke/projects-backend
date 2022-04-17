<?php
namespace App\Services;

use App\Entry;

class StopWorkingProjectService
{
    public function __construct(Entry $entry)
    {
        $this->entry = $entry;
    }

    public function stop()
    {
        $this->entry->end = now();
        $this->entry->save();

        $this->entry->project->working_time_seconds = $this->entry->project->working_time_seconds + now()->diffInSeconds($this->entry->start);
        $this->entry->project->save();
    }
}
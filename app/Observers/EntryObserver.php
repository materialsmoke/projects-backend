<?php

namespace App\Observers;

use App\Entry;
use App\Events\ProjectStartedEvent;
use App\Events\ProjectStoppedEvent;
use Illuminate\Support\Facades\Log;

class EntryObserver
{
    /**
     * Handle the entry "created" event.
     *
     * @param  \App\Entry  $entry
     * @return void
     */
    public function created(Entry $entry)
    {
        $entry->project->total_entries = count($entry->project->entries);
        $entry->project->is_stopped = false;
        $entry->project->save();

        Log::info($entry);

        ProjectStartedEvent::dispatch($entry->project);
    }

    /**
     * Handle the entry "updated" event.
     *
     * @param  \App\Entry  $entry
     * @return void
     */
    public function updated(Entry $entry)
    {
        $entry->project->working_time_seconds = $entry->project->working_time_seconds + now()->diffInSeconds($entry->start);
        $entry->project->is_stopped = true;
        $entry->project->save();

        ProjectStoppedEvent::dispatch($entry->project);
    }

    /**
     * Handle the entry "deleted" event.
     *
     * @param  \App\Entry  $entry
     * @return void
     */
    public function deleted(Entry $entry)
    {
        //
    }

    /**
     * Handle the entry "restored" event.
     *
     * @param  \App\Entry  $entry
     * @return void
     */
    public function restored(Entry $entry)
    {
        //
    }

    /**
     * Handle the entry "force deleted" event.
     *
     * @param  \App\Entry  $entry
     * @return void
     */
    public function forceDeleted(Entry $entry)
    {
        //
    }
}

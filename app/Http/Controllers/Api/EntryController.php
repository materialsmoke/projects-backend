<?php

namespace App\Http\Controllers\Api;

use App\Entry;
use App\Http\Controllers\Controller;
use App\Project;
use App\Services\StopWorkingProjectService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntryController extends Controller
{

    public function start(Project $project)
    {
        // if user is not project owner return error
        $this->authorize('update', $project);

        // check if project is already started:
        $entry = Entry::where('project_id', $project->id)->where('end', null)->first();
        if($entry){
            
            return response()->json(['status' => 'success' ,'message' => 'Project is already started']);
        }

        // stop other started projects before start a new project:
        $projectIds = [];
        foreach(Auth::user()->projects as $projectItem){
            $projectIds[] = $projectItem->id;
        }

        // it should be always 0 or 1 but just to fix bugs we use get();
        $unStoppedEntries = Entry::whereIn('project_id', $projectIds)->where('end', null)->get();
        foreach($unStoppedEntries as $unStoppedEntry){
            $service = new StopWorkingProjectService($unStoppedEntry);
            $service->stop();
        }

        $entry = Entry::create([
            'start' => now(),
            'project_id' => $project->id,
            'created_at' => now(), 
            'updated_at' => now(),
        ]);

        // TODO: can replace with the Entry observer
        $entry->project->total_entries = count($entry->project->entries);
        $entry->project->save();
        
        return response()->json(['status' => 'success' ,'message' => 'Project started successfully']);
    }

    public function stop(Project $project)
    {
        $this->authorize('update', $project);

        $entry = Entry::orderBy('created_at', 'desc')->where('project_id', $project->id)->where('end', null)->first();//    
        if($entry){
            $service = new StopWorkingProjectService($entry);
            $service->stop();
    
            return response()->json(['status' => 'success' ,'message' => 'Project stopped successfully']);
        }
        
        return response()->json(['status' => 'success' ,'message' => 'Project is already stopped']);
    }
}

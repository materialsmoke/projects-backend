<?php

namespace App\Http\Controllers\Api;

use App\Entry;
use App\Http\Controllers\Controller;
use App\Project;
use App\Services\StopOtherWorkingProjectService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntryController extends Controller
{

    public function start(Project $project)
    {
        // if user is not project owner return error
        $this->authorize('view', $project);

        // check if project is already started:
        $entry = Entry::where('project_id', $project->id)->where('end', null)->first();
        if($entry){
            
            return response()->json(['status' => 'success' ,'message' => 'Project is already started']);
        }

        // stop other started projects before start a new project:
        $service = new StopOtherWorkingProjectService(Auth::user());
        $service->handle();
        
        $entry = Entry::create([
            'start' => now(),
            'project_id' => $project->id,
            'created_at' => now(), 
            'updated_at' => now(),
        ]);

        // TODO: can replace with the Entry observer
        // replaced
        
        return response()->json(['status' => 'success' ,'message' => 'Project started successfully']);
    }

    public function stop(Project $project)
    {
        $this->authorize('update', $project);

        $entry = Entry::orderBy('created_at', 'desc')->where('project_id', $project->id)->where('end', null)->first();//    
        if($entry){
            $entry->end = now();
            $entry->save();
    
            return response()->json(['status' => 'success' ,'message' => 'Project stopped successfully']);
        }
        
        return response()->json(['status' => 'success' ,'message' => 'Project is already stopped']);
    }
}

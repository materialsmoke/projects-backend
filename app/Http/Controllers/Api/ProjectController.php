<?php

namespace App\Http\Controllers\Api;

use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\ProjectResource;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectIndexResource;

class ProjectController extends Controller
{

    public function index()
    {
        $projects = Project::where('user_id', Auth::user()->id)->get();

        return ProjectIndexResource::collection($projects);
    }

    public function show(int $projectID)
    {
        $this->authorize('view', Project::find($projectID));

        $project = Project::with('entries', 'user')->findOrFail($projectID);        

        return response()->json(new ProjectResource($project));
    }

    public function store(StoreProjectRequest $request)
    {
        Project::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name
        ]);

        return response()->json(['status' => 'success', 'message' => 'Project added successfully']);
    }

    public function update(UpdateProjectRequest $request, $projectID)
    {
        $this->authorize('update', Project::find($projectID));

        $project = Project::findOrFail($projectID);

        if($project->user_id != Auth::user()->id){
            return response()->json(['status'=>'error', 'message'=> 'This project is not yours to edit it'] , 403);
        }

        $project->name = $request->name;
        $project->save();

        return response()->json(['status' => 'success', 'message' => 'Project updated successfully']);
    }
    
    public function destroy($projectID)
    {
        $this->authorize('delete', Project::find($projectID));

        $project = Project::where('user_id', Auth::user()->id)->where('id', $projectID)->delete();

        return response()->json(['status' => 'success', 'message' => 'Project deleted successfully']);
    }
}

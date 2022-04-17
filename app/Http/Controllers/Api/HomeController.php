<?php

namespace App\Http\Controllers\Api;

use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    // public function __construct()
    // {
    //     // $this->middleware('auth');
    //     // we have it in api.php :)
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function __invoke()
    {
        $projects = Project::with('entries')->get();

        return response()->json($projects);
    }
}

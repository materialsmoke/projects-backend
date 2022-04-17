<?php

namespace App\Http\Controllers;

class EntryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function start()
    {
        // TODO: Implement starting new entry
    }

    public function stop()
    {
        // TODO: Implement stopping entry
    }
}

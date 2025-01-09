<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ClientController extends Controller
{
    public function index()
    {
        $projects = Project::take(4)->get();
        return view('clients.index', compact('projects'));
    }
}


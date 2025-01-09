<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class DashboardController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('dashboard', compact('projects'));
    }
}

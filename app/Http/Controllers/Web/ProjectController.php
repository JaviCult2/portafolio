<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::with('developers')->where('active',true)->orderBy('id', 'asc')->get();

        return response()->json(['projects' => $projects]);
    }
}

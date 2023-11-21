<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'Success',
            'result' => Project::with('type', 'technologies')->orderByDesc('created_at')->paginate(6)
        ]);
    }
    /**
     * Display the specified resource.
     */
    public function show($slug)
    {


        $project = Project::with('technologies', 'type')->where('slug', $slug)->first();
        if ($project) {
            return response()->json([
                'success' => true,
                'result' => $project
            ]);
        } else {
            return response()->json([
                'success' => false,
                'result' => 'Ops! Page not found'
            ]);
        }
    }
}

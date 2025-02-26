<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // public function index()
    // {
    //     $projects = Auth::user()->projects;
    //     return view('profile.view', compact('projects'));
    // }
    public function create()
    {
        return view('profile.project.add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'repo_link' =>'nullable|url',
        ]);
        Auth::user()->projects()->create($request->all());
        return redirect()->route('profile.view')->with('success', 'Project created successfully');
    }
}

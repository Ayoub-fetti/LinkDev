<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job_offers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function create(){
        return view('profile.jobs.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'nullable|string',
            'contract_type' => 'required|in:CDI,CDD,Freelance',
            'offer_link' => 'nullable|string',
            'date_published' => 'nullable|date',

            
        ]);
        Auth::user()->job_offers()->create($request->all());
        return redirect()->route('profile.view')->with('success', 'Job created successfully');
    }

    public function destroy($id)
    {
        $job_offers = Job_offers::findOrFail($id);
        $job_offers->delete();
        return redirect()->route('profile.view')->with('success', 'Job deleted successfully');
    }

    public function edit($id)
    {
        $job_offers = Job_offers::findOrFail($id);
        return view('profile.jobs.edit', compact('job_offers'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'nullable|string',
            'contract_type' => 'required|in:CDI,CDD,Freelance',
            'offer_link' => 'nullable|string',
            'date_published' => 'nullable|date',
        ]);
        $job_offers = Job_offers::findOrFail($id);
        $job_offers->update($request->all());
        return redirect()->route('profile.view')->with('success', 'Job updated successfully');
    }
}

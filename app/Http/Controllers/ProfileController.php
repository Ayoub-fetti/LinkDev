<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Skills;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function view()
    {
        $user = Auth::user();
       
        return view('profile.view', compact('user'));
    }
    public function edit(Request $request): View
    {
        $skills = Skills::all();
        return view('profile.edit',compact('skills'), [
            'user' => $request->user(),
        ]);
    }

 
    // public function update(ProfileUpdateRequest $request): RedirectResponse
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255',
    //         'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //         'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //     ]);

    //     $user = Auth::user();
    //     if (!($user instanceof \Illuminate\Database\Eloquent\Model)) {
    //         throw new \Exception('User is not an instance of Eloquent Model');
    //     }

    //     if ($request->hasFile('profile_picture')) {
    //         $profilePhotoPath = $request->file('profile_picture')->store('profile_pictures', 'public');
    //         $user->profile_picture = $profilePhotoPath;
    //     }
    //     if ($request->hasFile('cover')) {
    //         $coverPhotoPath = $request->file('cover')->store('cover_pictures', 'public');
    //         $user->cover = $coverPhotoPath;
    //     }

    //     $user->fill($request->validated());

    //     if ($user->isDirty('email')) {
    //         $user->email_verified_at = null;
    //     }

    //     $user->name = $request->input('name');
    //     $user->email = $request->input('email');
    //     $user->bio = $request->input('bio');
    //     $user->website = $request->input('website');
    //     $user->github_url = $request->input('github_url');
    //     $user->linkedin_url = $request->input('linkedin_url');

    //     $user->save();

    //     return Redirect::route('profile.edit', compact('skills', 'user'))->with('status', 'profile-updated');
    // }
public function update(ProfileUpdateRequest $request): RedirectResponse
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'skills' => 'array',
        'skills.*' => 'exists:skills,id',
    ]);

    $user = Auth::user();
    if (!($user instanceof \Illuminate\Database\Eloquent\Model)) {
        throw new \Exception('User is not an instance of Eloquent Model');
    }

    if ($request->hasFile('profile_picture')) {
        $profilePhotoPath = $request->file('profile_picture')->store('profile_pictures', 'public');
        $user->profile_picture = $profilePhotoPath;
    }
    if ($request->hasFile('cover')) {
        $coverPhotoPath = $request->file('cover')->store('cover_pictures', 'public');
        $user->cover = $coverPhotoPath;
    }

    $user->fill($request->validated());

    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }

    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->bio = $request->input('bio');
    $user->website = $request->input('website');
    $user->github_url = $request->input('github_url');
    $user->linkedin_url = $request->input('linkedin_url');

    $user->save();

    // Sync the selected skills
    $user->skills()->sync($request->input('skills', []));
    $skills = Skills::all();

    return Redirect::route('profile.edit', compact('skills', 'user'))->with('status', 'profile-updated');
}

 
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

}

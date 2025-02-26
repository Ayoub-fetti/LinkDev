<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    
    public function index()
    {
        return view('dashboard'); 
    }

    
    public function create()
    {
       return view('profile.post.add'); 
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'title' =>'required|string|max:255',
            'content'=> 'required|string|',
            'image' =>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5000'
        ]);
        $post = new Posts();
        $post->user_id = Auth::id();
        $post->title = $request->input('title');
        $post->content = $request->input('content');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('post_images', 'public');
            $post->image = $imagePath;
        }
        $post->save();
        return redirect()->route('dashboard')->with('success', 'Post created successfully.');
    }

    public function show()
    {
        //
    }

    public function edit()
    {
        //
    }

   
    public function update()
    {
        //
    }

    
   
    public function destroy($id) {
   
        Posts::where('id', $id)->delete();
        return redirect()->route('profile.view')->with('success', 'post deleted successfully');
    }
}

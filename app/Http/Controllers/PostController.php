<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function create()
    {
        return view('admin.posts');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'long_text' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // adjust max file size as needed
        ]);

        // Store the image in the public directory
        $imagePath = $request->file('image')->store('images', 'public');

        $post = new Post([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'long_text' => $request->get('long_text'),
            'image_path' => $imagePath,
        ]);

        $post->save();

        return redirect()->route('posts.create')->with('success', 'Post created successfully');
    }

    public function index()
    {
        $posts = Post::all();
        return response()->json($posts);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('etudiant.posts.posts',compact('posts'));
    }

    public function show(string $id)
    {
        $post = Post::findOrFail($id);
        return view('etudiant.posts.post_show',compact('post'));
    }

    // public function createPost()
    // {
    //     return view('etudiant.posts.post_create');
    // }



    public function store(Request $request,Post $post)
    {
        
        $imagePath = '';

        $data = $request->validate([
            'title' => 'required|max:100',
            'body' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')){
            $request->validate(['image'=>'image|mimes:jpeg,png,jpg,gif|max:2048']);
            $image = $request->file('image');
            $imagePath = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images_posts'),$imagePath);
        }
        $post::create([
           'utilisateure_id' => Auth::user()->id,
            'image' => $imagePath,
            'title' => $data['title'],
            'body' => $request->body,
            'status' => 'attend'
        ]);
        return to_route('Post.index')->with(['success' => 'votre post est en attend de confirmation ']);
    }
    public function edit($id)
    {
        $post = Post::find($id);
        return view('etudiant.posts.post_update',compact('post'));
    }
    public function update(Request $request,$id)
    {
        $post = Post::find($id);
        $data = $request->validate([
            'title' => 'required|max:100',
            'body' => 'required',
            'image'=>'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        if ($request->hasFile('image')){
            $request->validate(['image'=>'image|mimes:jpeg,png,jpg,gif|max:2048']);
            $image = $request->file('image');
            $imagePath = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images_posts'),$imagePath);
            $post->image = $image;
        }
        $post->update([
            'title' => $data['title'],
            'body' => $data['body'],
        ]);
        return to_route('Post.index')->with(['success' => 'votre post est modified ']);
    }
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return to_route('Post.index')->with(['success' => 'votre post est suprime ']);
    }
}

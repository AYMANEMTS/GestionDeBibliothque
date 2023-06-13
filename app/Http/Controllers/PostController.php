<?php

namespace App\Http\Controllers;

use App\Models\Coment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('status','accepter')->latest()->paginate(8);

        return view('etudiant.posts.posts',compact('posts'));
    }

    public function show(string $id)
    {
        $post = Post::findOrFail($id);
        $cmt = Coment::where('post_id',$id)->where('parent_id',null)->get();
        $post->viewsCount();
        return view('etudiant.posts.post_show',compact('post','cmt'));
    }

    public function store(Request $request, Post $post)
    {
        $imagePath = '';

        $data = $request->validate([
            'title' => 'required|max:100',
            'body' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $request->validate(['image' => 'image|mimes:jpeg,png,jpg,gif|max:2048']);
            $image = $request->file('image');
            $imagePath = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images_posts'), $imagePath);
        }

        $post::create([
            'utilisateure_id' => Auth::user()->id,
            'image' => $imagePath,
            'title' => $data['title'],
            'body' => $request->body,
            'status' => 'attend'
        ]);

        return redirect()->route('Post.index')->with(['success' => 'Votre post est en attente de confirmation.']);
    }





    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('media'), $fileName);

            $url = asset('media/' . $fileName);

            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);
        }

        return response()->json(['uploaded' => false]);
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

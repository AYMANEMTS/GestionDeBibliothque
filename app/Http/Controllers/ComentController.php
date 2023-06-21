<?php

namespace App\Http\Controllers;

use App\Models\Coment;
use App\Models\Deslike;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComentController extends Controller
{

    public function store(Request $request)
    {
        $coment = $request->validate(['body'=>'required']);
        Coment::create([
            'user_id' => Auth::user()->id,
            'post_id' => $request->post_id,
            'body' => $coment['body']
        ]);
        return back();
    }
    public function storeChild(Request $request)
    {
        $coment = $request->validate(['body'=>'required']);
        Coment::create([
            'user_id' => Auth::user()->id,
            'post_id' => $request->post_id,
            'parent_id' => $request->parent_id,
            'body' => $coment['body']
        ]);
        return back();
    }

    public function update(Request $request, string $id)
    {
        $cmnt = Coment::findOrFail($id);
        $cmnt->update(['body'=>$request->body_update]);
        return back();
    }

    public function destroy(string $id)
    {
        $cmnt = Coment::findOrFail($id);
        $cmnt->replies()->delete();
        $cmnt->delete();
        return back();
    }
    public function likeComment()
    {
        $cmnt = Coment::find(request()->id);
        $user_id = Auth::user()->id;
        $like = Like::where('user_id',$user_id)->where('cmnt_id',$cmnt->id)->first();
        if ($like){
            $like->delete();
            return response()->json([
                'statusComment'=>'grey',
                'count' => Like::where('cmnt_id',$cmnt->id)->get()->count(),
            ]);
        }else{
            $lk = Like::create([
                'user_id' => $user_id,
                'cmnt_id' => $cmnt->id
            ]);
            return response()->json([
                'statusComment'=>'green',
                'count' => Like::where('cmnt_id',$cmnt->id)->get()->count(),
            ]);
        }
    }
    public function dislikeComment()
    {
        $cmnt = Coment::find(request()->id);
        $user_id = Auth::user()->id;
        $dislike = Deslike::where('user_id',$user_id)->where('cmnt_id',$cmnt->id)->first();
        if ($dislike){
            $dislike->delete();
            return response()->json(['count' => Deslike::where('cmnt_id',$cmnt->id)->get()->count(),
                                     'statusC'=>'grey']);
        }else{
            $lk = Deslike::create([
                'user_id' => $user_id,
                'cmnt_id' => $cmnt->id
            ]);
            return response()->json([
                'statusC'=>'red',
                'count' => Deslike::where('cmnt_id',$cmnt->id)->get()->count(),
            ]);
        }
    }



}

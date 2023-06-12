<?php

namespace App\Http\Controllers;

use App\Models\Coment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cmnt = Coment::findOrFail($id);
        $cmnt->replies()->delete();
        $cmnt->delete();
        return back();
    }
}

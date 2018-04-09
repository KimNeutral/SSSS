<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App;

class CommentsController extends Controller
{
    //
    public function savecomment(Request $request, $id)
    {
        //
        request()->validate([
            'content' => 'required',
        ]);

        if(!isset(\Auth::user()->id)){
    		return back()->withErrors(['로그인을 해주세요!']);
        }
        $all = $request->all();
        $comment = new \App\Comment;
		$comment->content = $all['content'];
		$comment->user()->associate(\Auth::user());
		$comment->article()->associate(\App\Article::find($id));
		$comment->save();

        return back();
    }
}

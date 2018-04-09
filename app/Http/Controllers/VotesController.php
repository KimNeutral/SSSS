<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VotesController extends Controller
{
    //
	public function vote(Request $request, $id){
		$request->validate([
			'pm'=>'required'
		]);

		if(!isset(\Auth::user()->id)){
			return response()->json(['error' => 'not loggined'], 400);
		}
		$article = \App\Article::find($id);
		if(!$article){
			return response()->json(['error' => 'none existing article'], 400);
		}
		$exist = \App\Vote::where([['article_id', '=', $id], ['user_id', '=', \Auth::user()->id]])->first();
		$pm = ($request->input('pm') == 'true')?1:0;
		error_log($request->input('pm'));
		error_log($pm);
		$vote = new \App\Vote;
		$vote->user()->associate(\Auth::user());
		$vote->article()->associate($article);
		$vote->pm = $pm;
		if(!$exist || $exist->pm != $pm){
			if($exist){
				\App\Vote::where([['article_id', '=', $id], ['user_id', '=', \Auth::user()->id]])->delete();
			}
			$vote->save();
			return response()->json(['success' => true], 200);
		} else {
			\App\Vote::where([['article_id', '=', $id], ['user_id', '=', \Auth::user()->id]])->delete();
			return response()->json(['success' => true], 201);
		}
	}
}

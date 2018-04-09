<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function update(Request $request) {

    }

    public function show($id) {
    	$user = \App\User::find($id);
    	if(!$user){
    		return view('errors.notfound');
    	}
    	if(\Auth::user()){
	    	if($user->id !== \Auth::user()->id){
	        	\DB::table('users')->where('id', $id)->update(['seen' => $user->seen + 1]);
	    	}
	    }
    	$user = \App\User::find($id);
    	return view('profiles.profile', compact('user'));
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    	$user = \App\User::find($id);
    	if(\Auth::user()){
    		if(\Auth::user()->id === $user->id){
    			\App\User::find($id)->update($request->all());
    			error_log("y");
				return back()->with('success','성공적으로 업데이트 되었습니다.');
    		} else {
    			error_log("y1");
				return back()->withError('error', 'Not permissioned to do this operation');
    		}
    	}
    			error_log("y2");
    	return back()->withError('error', 'Not permissioned to do this operation');
    }
}

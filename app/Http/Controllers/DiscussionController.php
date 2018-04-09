<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiscussionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $discussions = \App\Article::latest()->where('isDiscussion',1)->paginate(5);
        return view('discuss.index',compact('discussions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if(\Auth::check()){
            return view('discuss.create');
        }
        else{
            return view('auth.login');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        request()->validate([
            'title' => 'required',
            'content' => 'required',
            'desc' => 'required',
        ]);
        $all = $request->all();
        $all['isDiscussion'] = true;
        auth()->user()->articles()->create($all);
        return redirect(route('discuss.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $discussion = \App\Article::find($id);
        if(\Auth::user()){
            if($discussion->user->id !== \Auth::user()->id){
                \DB::table('articles')->where('id', $id)->update(['seen' => $discussion->seen + 1]);
            }
        }
        if(!$discussion){
            return redirect(route('errors.notfound'));
        }

        return view('discuss.show', compact('discussion'));    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $discussion = \App\Article::find($id);
        if(!$discussion){
            return redirect(route('errors.notfound'));
        }
        return view('discuss.edit', compact('discussion'));   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'title' => 'required',
            'content' => 'required',
            'desc' => 'required'
        ]);
        $discussion = \App\Article::find($id);
        if(\Auth::user()->id === $discussion->user_id)
        {
            \App\Article::find($id)->update($request->all());
            return redirect()->route('discuss.index')
                             ->with('success','성공적으로 업데이트 되었습니다.');
        } else {
            return redirect()->route('discuss.index')
                             ->with('error', 'Not permissioned to do this operation');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $discussion = \App\Article::find($id);
        if(\Auth::user()->id === $discussion->user_id){
            $discussion->delete();
            return redirect(route('discuss.index'));
        } else {
            return redirect()->route('discuss.index')
                             ->with('error', 'Not permissioned to do this operation');
        }
    }
}

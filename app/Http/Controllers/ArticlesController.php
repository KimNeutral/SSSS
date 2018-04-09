<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(explode('.',Route::current()->getName())[0] == 'articles'){
            $articles = \App\Article::latest()->where('articlecategory_id', 1)->paginate(10);
            return view('index', compact('articles'));
        } else {
            $discussions = \App\Article::latest()->where('articlecategory_id', 2)->paginate(15);
            return view('discuss.index', compact('discussions'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        error_log(request()->is('discuss'));
        if(\Auth::check()){
            if(explode('.',Route::current()->getName())[0] == 'articles'){
                $categories = \App\Category::get();
                return view('articles.create', compact('categories'));
            } else {
                return view('discuss.create');
            }
        } else{
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
            'articlecategory_id' => 'required'
        ]);
        if(explode('.',Route::current()->getName())[0] == 'articles'){
            if(request()->input('category_id')){
                $article = auth()->user()->articles()->create($request->all());
            }
        } else {
            $article = auth()->user()->articles()->create($request->all());
        }
        return redirect(route(explode('.',Route::current()->getName())[0].'.index'));
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $article = \App\Article::find($id);
        if(!$article){
            return view('errors.notfound');
        }
        if(\Auth::user()){
            if($article->user->id !== \Auth::user()->id){
                \DB::table('articles')->where('id', $id)->update(['seen' => $article->seen + 1]);
            }
        }
        // echo $article->content;

        return view(explode('.',Route::current()->getName())[0].'.show', compact('article'));    
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

        $article = \App\Article::find($id);
        if(!$article){
            return redirect(route('errors.notfound'));
        }
        // echo $article->content;
        if(explode('.',Route::current()->getName())[0] == 'articles'){
            $categories = \App\Category::get();
            return view('articles.edit', compact('article', 'categories'));   
        } else {
            return view('discuss.edit', compact('article'));   
        }
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
        //
        request()->validate([
            'title' => 'required',
            'content' => 'required',
            'desc' => 'required'
        ]);
        $article = \App\Article::find($id);
        if(\Auth::user()->id === $article->user_id)
        {
            \App\Article::find($id)->update($request->all());
            return redirect()->route(explode('/',Route::current()->uri())[0].'.index')
                             ->with('success','성공적으로 업데이트 되었습니다.');
        } else {
            return redirect()->route(explode('/',Route::current()->uri())[0].'.index')
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
        error_log(Route::current()->uri());
        $article = \App\Article::find($id);
        if(\Auth::user()->id === $article->user_id){
            \App\Article::find($id)->delete();
            return redirect()->route(explode('/',Route::current()->uri())[0].'.index');
        } else {
            return redirect()->route(explode('/',Route::current()->uri())[0].'.index')
                             ->with('error', 'Not permissioned to do this operation');
        }
    }
}

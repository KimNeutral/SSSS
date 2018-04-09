@extends('layouts.app')

<style>
	.pagination li {
		margin: 5px;
	}
</style>
@section('content')
		<div class="starter-template">
			<h1>ㅆㅆㅆㅆ, 짜증없는 학교를 위한.</h1>
			<p class="lead">면전에 대고 욕하지 않아도된다.<br>눈치보지말고 써보아라</p>
		</div>

		<div id="writeAt" onclick="window.location.href='{{ route("articles.create") }}';">
			<p>생각을 싸질러봅시다.</p>
		</div>

		<div>
			<button class="btn btn-outline-secondary active" style="border-radius: 50px">New</button>
			<button class="btn btn-outline-secondary" style="border-radius: 50px">Hot</button>
		</div>

		@forelse($articles as $article)
		<div class="stArticle stArticle-light" style="background: url('{{ $article->thumbImage }}') no-repeat center center fixed; background-size: cover;" onclick="window.location.href='{{ route("articles.show", $article->id) }}';">
			<div class="category">
				&#64;{{ \App\Category::find($article->category_id)->title }}
			</div>
			<div class="title">
				{{ $article->title }}
			</div>
			<div class="content"> 
				{{ $article->desc }}
			</div>
			<div class="author">
				by <a href="/profile/{{ $article->user->id }}" style="color: white">{{ $article->user->name }}</a> · {{ $article->created_at->diffForHumans() }}
			</div>
			<div class="thumb">
				<p class="up">+ {{ $article->votes->where('pm', 1)->count() }}</p><p class="content"> / </p><p class="down">- {{ $article->votes->where('pm', 0)->count() }}</p><p class="content"> · 조회수 {{ $article->seen }}회 · 댓글 {{ $article->comments->count() }}개</p>
			</div>
		</div>
		@empty
			<p style="font-size: 30px; margin-top: 10px " onclick="window.location.href='{{ route("articles.create") }}';" style="cursor: pointer;">글이 없습니다. 첫 글을 싸질러 보세요!</p>
		@endforelse
		@if($articles->count())
			{!! $articles->render() !!}
		@endif

@endsection


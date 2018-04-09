@extends('layouts.app')

@section('content')
<!-- 		<div class="starter-template">
			<h1>10월 4주차 주제</h1>
			<p class="lead">학생들이 게임을 너무 많이한다.<br>완화시킬 수 있는 방법이 없을까.</p>
		</div> -->

		<div id="writeAt" onclick="window.location.href='{{ route("discuss.create") }}';">
			<p>생각을 싸질러봅시다.</p>
		</div>

		<div>
			<button class="btn btn-outline-secondary active" style="border-radius: 50px">New</button>
			<button class="btn btn-outline-secondary" style="border-radius: 50px">Hot</button>
		</div>


		@forelse($discussions as $discussion)
		<div class="stArticle stArticle-light" style="background: url('{{ $discussion->thumbImage }}') no-repeat center center fixed; background-size: cover;" onclick="window.location.href='{{ route("discuss.show", $discussion->id) }}';">
			<div class="title">
				{{ $discussion->title }}
			</div>
			<div class="author">
				by <a href="/profile/{{ $discussion->user->id }}" style="color: white">{{ $discussion->user->name }}</a> · {{ $discussion->created_at->diffForHumans() }}
			</div>
			<div class="thumb">
				<p class="up">+ {{ $discussion->votes->where('pm', 1)->count() }}</p><p class="content"> / </p><p class="down">- {{ $discussion->votes->where('pm', 0)->count() }}</p><p class="content"> · 조회수 {{ $discussion->seen }}회 · 댓글 {{ $discussion->comments->count() }}개</p>
			</div>
		</div>
		@empty
			<p style="font-size: 30px; margin-top: 10px " onclick="window.location.href='{{ route("discuss.create") }}';" style="cursor: pointer;">글이 없습니다. 첫 글을 싸질러 보세요!</p>
		@endforelse
		@if($discussions->count())
			{!! $discussions->render() !!}
		@endif

@endsection

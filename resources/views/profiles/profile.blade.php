@extends('layouts.app')

<style type="text/css">
.profile {
}
.profile .head {
	margin-top: 100px;
	margin-left: 30px;
	float: left;
}
.profile .head {
	height: 100px;
	font-size: 30px;
}
.profile .desc {
	font-size: 17px;
	clear: both;
	float: left;
}
.profile .desc .image {
	width: 20px;
	margin-left: 2px;
	float: left;
}
.profile .contents {
	clear: both;
	padding-top: 20px;
}
.profile .analysis {
	clear: both;
	padding-top: 20px;
}
.profile .analysis .a-card {
	width: 130px;
	border: 1px solid lightgray;
	float: left;
	margin-right: 10px;
	padding: 3px 6px;
	border-radius: 5px;
	box-shadow: 0px 1px 1px rgba(0, 0, 0, .3);
	text-align: center;
}
.profile .analysis .a-card .title {

}
.profile .analysis .a-card .content {
}
.hidden {
	display: none;
}
</style>
@section('content')
<script type="text/javascript">
	$(document).ready(function(e) {   
		$("#btnArticles").click(function(){
			toggleActive(this);
			$("#comments").addClass("hidden");
			$("#discussion").addClass("hidden");
			$("#articles").removeClass("hidden");
		});

		$("#btnComments").click(function(){
			toggleActive(this);
			$("#discussion").addClass("hidden");
			$("#articles").addClass("hidden");
			$("#comments").removeClass("hidden");
		});

		$("#btnDiscussion").click(function(){
			toggleActive(this);
			$("#comments").addClass("hidden");
			$("#articles").addClass("hidden");
			$("#discussion").removeClass("hidden");
		});
	});
	function addActive(btn)
	{
		$(btn).addClass("active");
	}
	function toggleActive(btn)
	{
		$("#btnComments").removeClass("active");
		$("#btnArticles").removeClass("active");
		$("#btnDiscussion").removeClass("active");
		addActive(btn);
	}
	function addHidden(theForm, key, value) {
	    // Create a hidden input element, and append it to the form:
	    var input = document.createElement('input');
	    input.type = 'hidden';
	    input.name = key; // 'the key/name of the attribute/field that is sent to the server
	    input.value = value;
	    theForm.appendChild(input);
	}
	function writeDesc(){
		var desc = prompt("한줄 소개을 입력하세요", "");
		var descForm = document.getElementById("descForm");
		addHidden(descForm, "desc", desc);
		descForm.submit();
	}
</script>

<div class="profile">
	<img src="{{ $user->profile }}" alt="" class="user-img-big" style="float: left" />
	<div class="head">
		<div class="name">
			{{ $user->name }}
		</div>
		<div class="desc">
			<p style="float:left; text-align: left;">
				@if($user->desc)
				{{ $user->desc }}
				@else
				@auth
				@if($user->id == \Auth::user()->id)
				소개글을 작성해주세요. 
				@endif
				@endauth
				@endif
			</p>
			@auth
			@if($user->id == \Auth::user()->id)
			<img class="image" style="cursor: pointer;" onclick="writeDesc()" src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/Black_pencil.svg/600px-Black_pencil.svg.png">
			<form id="descForm" method="POST" action="/users/{{ $user->id }}">
			</form>
			@endif
			@endauth
		</div>
	</div>
	<div class="analysis">
		<div class="a-card">
			<div class="title">
				프로필 방문 수
			</div>
			<div class="content">
				{{ $user->seen }}
			</div>
		</div>

		<div class="a-card">
			<div class="title">
				작성한 게시물 수
			</div>
			<div class="content">
				{{ $user->articles->where('isDiscussion',0)->count() }}
			</div>
		</div>

		<div class="a-card">
			<div class="title">
				토론 게시물 수
			</div>
			<div class="content">
				{{ $user->articles->where('isDiscussion',1)->count() }}
			</div>
		</div>

		<div class="a-card">
			<div class="title">
				작성한 댓글 수
			</div>
			<div class="content">
				{{ $user->comments->count() }}
			</div>
		</div>
	</div>
	<div class="contents">
		<div>
			<button id="btnArticles" class="btn btn-outline-secondary active" style="border-radius: 50px">게시물</button>
			<button id="btnDiscussion" class="btn btn-outline-secondary" style="border-radius: 50px">토론</button>
			<button id="btnComments" class="btn btn-outline-secondary" style="border-radius: 50px">댓글</button>
		</div>
		<div id="articles">
			@forelse($user->articles->where('articlecategory_id', 1) as $article)
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
					by {{ $article->user->name }} · {{ $article->created_at->diffForHumans() }}
				</div>
				<div class="thumb">
					<p class="up">+ {{ $article->votes->where('pm', 1)->count() }}</p><p class="content"> / </p><p class="down">- {{ $article->votes->where('pm', 0)->count() }}</p><p class="content"> · 조회수 {{ $article->seen }}회 · 댓글 {{ $article->comments->count() }}개</p>
				</div>
			</div>
			@empty
			@endforelse
		</div>
		<div id="discussion" class="hidden">
			@forelse($user->articles->where('articlecategory_id', 2) as $article)
			<div class="stArticle stArticle-light" style="background: url('{{ $article->thumbImage }}') no-repeat center center fixed; background-size: cover;" onclick="window.location.href='{{ route("discuss.show", $article->id) }}';">
				<div class="title">
					{{ $article->title }}
				</div>
				<div class="content"> 
					{{ $article->desc }}
				</div>
				<div class="author">
					by {{ $article->user->name }} · {{ $article->created_at->diffForHumans() }}
				</div>
				<div class="thumb">
					<p class="up">+ {{ $article->votes->where('pm', 1)->count() }}</p><p class="content"> / </p><p class="down">- {{ $article->votes->where('pm', 0)->count() }}</p><p class="content"> · 조회수 {{ $article->seen }}회 · 댓글 {{ $article->comments->count() }}개</p>
				</div>
			</div>
			@empty
			@endforelse
		</div>
		<div id="comments" class="hidden">
			@forelse($user->comments as $comment)
			<div class="stArticle stArticle-light" onclick="window.location.href='@if($article->articlecategory_id == 1) {{route("articles.show", $comment->article->id) }} @else {{route("discuss.show", $comment->article->id)}} @endif';">
				<div class="category">
					@if($comment->article->articlecategory_id == 1)
					&#64;{{ \App\Category::find($comment->article->category_id)->title }} - {{ $comment->article->title }}
					@else
					{{ $comment->article->title }}
					@endif
				</div>
				<div class="content"> 
					{{ $comment->content }}
				</div>
				<div class="author">
					{{ $comment->created_at->diffForHumans() }}
				</div>
			</div>
			@empty
			@endforelse
		</div>
	</div>
</div>
@endsection

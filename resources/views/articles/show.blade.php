@extends('layouts.app')
<style type="text/css">
@import  url(http://fonts.googleapis.com/earlyaccess/notosanskr.css);
* {
	font-family: 'Noto Sans KR';
	font-weight: 100;
}
.navbar {
	padding: 15px;
}
.navbar-brand {
	outline: none;
}
.lead, h1 {
	font-family: 'Nanum Myeongjo';
}
.lead {
	font-size: 30px;
	color: gray;
}

#writeAt{
	margin: 5px 5px 30px 5px;
	font-size: 18px;
	background-color: #fff;
	padding-left: 13px;
	height: 50px;
	line-height: 50px;
	box-shadow: 0px 1px 3px rgba(0, 0, 0, .3);
	color: gray;
	border-radius: 2px;
}
.stArticle {
	margin: 10px 5px 15px 5px;
	padding: 15px;
	background-color: #fff;
	box-shadow: 0px 1px 3px rgba(0, 0, 0, .3);
	border-radius: 2px;

	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;
	/*color: white;*/
}
.stArticle .title, .stArticle .content, .stArticle .author, .stArticle .thumb .content {
	/*background-color: black;*/
	/*display: inline;*/
	color: white;
	mix-blend-mode: exclusion;
	font-weight: 100;
}
.stArticle .title {
	font-size: 25px;
}
.stArticle .content {
	font-size: 20px;
}
.stArticle .thumb, .stArticle .author {
	font-size: 15px;
	/*color: white;*/
}
.stArticle .thumb .up {
	color: dodgerblue;
	display: inline;
}
.stArticle .thumb .down {
	color: red;
	display: inline;
}
.stArticle .thumb .content {
	font-size: 15px;
	display: inline;
}
.stArticle-light {

}
.btn-user{
	background-color: transparent;
	border-color: transparent;
	color: black;
}
.btn-user:focus {
	box-shadow: none;
}

</style>

<style type="text/css">blockquote{border-left:5px solid #ccc;padding-left:20px;margin-left:0;font-style:italic;overflow:hidden}</style>
<style type="text/css"> .image{text-align:center;clear:both} .image.image-style-align-center, .image.image-style-align-left, .image.image-style-align-right, .image.image-style-side{max-width:50%} .image.image-style-side{float:right;margin-left:2em} .image.image-style-align-left{float:left;margin-right:2em}.image.image-style-align-center{margin-left:auto;margin-right:auto}.image.image-style-align-right{float:right;margin-left:2em}.image>img{display:block;margin:0 auto;max-width:100%}</style>
<style type="text/css">figure.image{position:relative;overflow:hidden}figure.image.ck-appear{animation:fadeIn .7s}figure.image.ck-infinite-progress:before{content:"";width:30px;height:2px;position:absolute;top:0;right:0;background:rgba(0,0,0,.1);animation-name:readingProgressAnimation;animation-duration:1.5s;animation-iteration-count:infinite;transition-timing-function:linear}figure.image.ck-image-upload-placeholder>img{width:100%}figure.image .ck-progress-bar{height:2px;width:0;position:absolute;top:0;left:0;background:#6ab5f9;transition:width .1s}@keyframes fadeIn{0%{opacity:0}to{opacity:1}}@keyframes readingProgressAnimation{0%{width:30px;right:0}50%{width:45px}to{right:100%}}</style>
<style type="text/css">.image>figcaption{color:#333;background-color:#f7f7f7;padding:.8em;font-size:.75em;outline-offset:-1px}</style>
<style>
.btn-circle{
	margin: 5px;
	padding: 5px;
	background-color: #fff;
	box-shadow: 0px 1px 3px rgba(0, 0, 0, .3);
	border-radius: 50px;
	font-size: 20px;
	line-height: 40px;
	text-align: center;
	width: 50px;
	height: 50px;
	float: left;
	cursor: pointer;
	-webkit-user-select: none; /* Safari */        
	-moz-user-select: none; /* Firefox */
	-ms-user-select: none; /* IE10+/Edge */
	user-select: none; /* Standard */
}
.btn-circle:hover {
	color: white;
	transition: 0.3s;
}

.btn-circle-plus:hover {
	background-color: #1E90FF;
}

.btn-circle-minus:hover {
	background-color: #ff6961;
}

.btn-circle-plus:active {
	box-shadow: 0px 0px 10px rgba(27, 128, 227, .8);
	transition: 0.1s;
}

.btn-circle-minus:active {
	box-shadow: 0px 0px 10px rgba(227, 95, 88, .8);
	transition: 0.1s;
}

.btn-circle-plus-active {
	background-color: #1E90FF;
	color: white;
}

.btn-circle-minus-active {
	background-color: #ff6961;
	color: white;
}
</style>
@section('content')
<script>
	
	var up = {{ $article->votes->where('pm', 1)->count() }};
	var down = {{ $article->votes->where('pm', 0)->count() }};

	var upTemp = up;
	var downTemp = down;

	var upT = false;
	var downT = false;

	function vote(pm){
		$.ajax({
			url: "/articles/{{ $article->id }}/votes",
			type: "post",
			data: "pm=" + pm,
			success: function(data, textStatus){
				// alert('success');
				return true;
			},
			error:function(){
				// alert('fail2');
			}
		}); 
	}

	function voteDelete(){
		$.ajax({
			url: "/articles/{{ $article->id }}/votes",
			type: "delete",
			success: function(data, textStatus){
				// alert('success');
				return true;
			},
			error:function(){
				// alert('fail2');
			}
		}); 
	}

	function toggle(){
		if(upT){
			upTemp = up + 1;
			$("#plus").addClass("btn-circle-plus-active");
		} else {
			upTemp = up;
			$("#plus").removeClass("btn-circle-plus-active");
		}

		if(downT){
			downTemp = down + 1;
			$("#minus").addClass("btn-circle-minus-active");
		} else {
			downTemp = down;
			$("#minus").removeClass("btn-circle-minus-active");
		}
	}

	$(document).ready(function(e) {   
		@auth
		if({{ $article->votes->where('user_id', Auth::user()->id)->where('pm', 1)->count() }} == 1){
			$("#plus").addClass("btn-circle-plus-active");
			up--;
			upT = true;
		} else if({{ $article->votes->where('user_id', Auth::user()->id)->where('pm', 0)->count() }} == 1){
			$("#minus").addClass("btn-circle-minus-active");
			down--;
			downT = true;
		}
		@endauth

		$("#plus").hover(
			function() {
				$(this).html(upTemp);
			},
			function() {
				$(this).html('+');
			}
			);
		$("#minus").hover(
			function() {
				$(this).html(downTemp);
			},
			function() {
				$(this).html('-');
			}
			);
		@auth
		$("#plus").click(function(){
			upT = !upT;
			downT = false;
			vote(true);
			toggle();
			$(this).html(upTemp);
		});
		$("#minus").click(function(){
			upT = false;
			downT = !downT;
			vote(false);
			toggle();
			$(this).html(downTemp);
		});
		@else
		$("#plus").click(function(){
			alert('로그인 후 이용해주세요!');
			window.location.href = '/login';
		});
		$("#minus").click(function(){
			alert('로그인 후 이용해주세요!');
			window.location.href = '/login';
		});
		@endauth
	});
</script>
<div style="padding: 0px 10% 0px 10%; width: 100%;">
	<div>
		<div>
			<h1 style="font-family: 'Noto Sans KR'; font-weight: 100;">{{ $article->title }}</h1>
			<div>&#64;{{ \App\Category::find($article->category_id)->title }} · by <a href="/profile/{{ $article->user->id }}" style="color:black; outline: none;">{{ $article->user->name }}</a>  · {{ $article->created_at->diffForHumans() }}</div>
			<hr>
			<br>
			<div>
				{!! $article->content !!}
			</div>
		</div>
	</div>
	<div style="clear: both; display: block; position: relative;">
		<hr>
		<div style="margin-bottom: -15px;">
			<div style="height: 50px; clear: all;">
				<div id="plus" class="btn-circle btn-circle-plus">+</div>
				<div id="minus" class="btn-circle btn-circle-minus">-</div>
			</div>
		</div>
		@auth
		@if(Auth::user()->id === $article->user_id)
		<a href="/articles/{{ $article->id }}/edit">수정</a>
		<a href="/articles/{{ $article->id }}/destroy">삭제</a>
		@endif
		@endauth
	</div>
	<div style="clear:both; padding-top: 10px;">
		@auth
		<form method="POST" action ="/articles/{{ $article->id }}/comments" >
			<input type="text" name="content"/>
			<input type="submit" value="submit" />
		</form>
		@endauth
	</div>
	@forelse($article->comments as $comment)
	<div>
		{{ $comment->user->name }} | {{ $comment->content }} | {{ $comment->created_at->diffForHumans() }}
	</div>
	@empty
	<div>
		댓글이 없습니다.
	</div>
	@endforelse
</div>



@endsection

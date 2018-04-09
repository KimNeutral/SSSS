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
<style>
	.discuss{
		display: flex; margin-left: 20px;
	}
	.discuss .discuss-head {
		flex: 0 0 auto; order: 1; margin-right: 30px;
		width: 250px;
	}
	.discuss .discuss-head .discuss-head-content {
		display: flex;
	}
	.discuss .discuss-head .discuss-head-content .discusss-head-content-con {
		display: flex; flex: 1 1 auto; flex-direction: column; margin-left: 15px;
	}
	.discuss .discuss-content {
		flex: 0 0 auto; order: 2; word-wrap: break-word; width: calc(100% - 300px);
	}
</style>
<div style="width: 100%;">
	<div>
		<div>
			<h1 style="font-family: 'Noto Sans KR'; font-weight: 100;">{{ $article->title }}</h1>
		</div>
		<hr>
		<div class="discuss">
			<div class="discuss-head">
				<div class="discuss-head-content">
					<img src="{{ $article->user->profile }}" width="100" height="100" style="border: 1px solid #AAA">
					<div class="discusss-head-content-con">
						<a href="/profile/{{ $article->user->id }}" style="color:black; outline: none;">{{ $article->user->name }}</a>
						{{ $article->created_at->diffForHumans() }}
						@auth
						@if(Auth::user()->id === $article->user_id)
						<a href="{{ route('discuss.edit',$article->id) }}">수정</a>
						<a href="/discuss/{{ $article->id }}/destroy">삭제</a>
						@endif
						@endauth	
					</div>
				</div>
			</div>
			<br>
			<div class="discuss-content">
				{!! $article->content !!}
			</div>
		</div>
	</div>
	<div style="clear: both; display: block; position: relative;">
		<div >
			<div style="height: 50px; clear: all;">
				<div id="plus" class="btn-circle btn-circle-plus">+</div>
				<div id="minus" class="btn-circle btn-circle-minus">-</div>
			</div>
		</div>
		<hr style="clear: both;">
	</div>
	<div style="clear: both;">
		@forelse($article->comments as $comment)
		<div class="discuss">
			<div class="discuss-head">
				<div class="discuss-head-content">
					<img src="{{ $comment->user->profile }}" width="100" height="100" style="border: 1px solid #AAA">
					<div class="discusss-head-content-con">
						<a href="/profile/{{ $comment->user->id }}" style="color:black; outline: none;">{{ $comment->user->name }}</a>
						{{ $comment->created_at->diffForHumans() }}
						@auth
						@if(Auth::user()->id === $comment->user_id)
						<a href="#">수정</a>
						<a href="#">삭제</a>
						@endif
						@endauth	
					</div>
				</div>
			</div>
			<br>
			<div class="discuss-content">
				{!! $comment->content !!}
			</div>
		</div>		
		<hr>
		@empty
		@endforelse
	</div>
	<div style="padding-top: 10px;">
		@auth
		<div>
			<div class="discuss">
				<div class="discuss-head">
					<div class="discuss-head-content">
						<img src="{{ Auth::user()->profile }}" width="100" height="100" style="border: 1px solid #AAA">
						<div class="discusss-head-content-con">
							<a href="/profile/{{ Auth::user()->id }}" style="color:black; outline: none;">{{ Auth::user()->name }}</a>
						</div>
					</div>
				</div>				
				<br>
				<div class="discuss-content">
					<form id="write-form" action ="/articles/{{ $article->id }}/comments" method="POST">
						<textarea id="editor">
						</textarea>
					</form>
					<button type="button" onclick="submit(); return false;" class="btn btn-outline-primary" style="">작성</button>
				</div>
			</div>	
			<hr>	
		</div>			

		@endauth
	</div>	
</div>


<script src="/ckeditor5-build-classic/build/ckeditor.js"></script>
<script>
	var ed;
	ClassicEditor
	.create( document.querySelector( '#editor' ), {
		ckfinder: {
			uploadUrl: '/upload_image'
		}
	} )
	.then( editor => {
		console.log( editor );
		ed = editor;
	} )
	.catch( error => {
		console.error( error );
	} );

	function addHidden(theForm, key, value) {
	    // Create a hidden input element, and append it to the form:
	    var input = document.createElement('input');
	    input.type = 'hidden';
	    input.name = key; // 'the key/name of the attribute/field that is sent to the server
	    input.value = value;
	    theForm.appendChild(input);
	}

	function submit(){
		const data = ed.getData();
		if(data == ""){
			alert('빈칸을 채워주세요.');
			return;
		}
		var fm = document.getElementById('write-form');
		addHidden(fm, 'content', data);
		fm.submit();
	}
</script>
@endsection

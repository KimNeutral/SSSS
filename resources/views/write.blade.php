@extends('layouts.app')

<style type="text/css">
.ck-editor__editable {
	min-height: 400px;
}
</style>

@section('content')
	<h1>싸질러보세요.</h1>
	<input type="text" class="form-control" style="margin-bottom: 10px; border-radius: 0px;"></input>
	<textarea name="content" id="editor">
		<p>Here goes the initial content of the editor.</p>
	</textarea>
	<button class="btn btn-outline-primary" style="margin-top: 10px;">등록</button>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
	<script src="/ckeditor5-build-classic/build/ckeditor.js"></script>
	<script type="text/javascript">

		ClassicEditor
		.create( document.querySelector( '#editor' ), {
			ckfinder: {
				uploadUrl: '/upload_image'
			}
		} )
		.then( editor => {
			console.log( editor );
		} )
		.catch( error => {
			console.error( error );
		} );
	</script>
@endsection

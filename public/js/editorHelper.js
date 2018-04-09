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

function findFirstPictureAndAddForm(){
	var fTags = document.getElementsByTagName('img');
	var pic = "";
	if(fTags.length > 3){
		pic = fTags[3].getAttribute('src');
	}
	addHidden(document.getElementById('write-form'), 'thumbImage', pic);
}

function findFirstDescAndAddForm(){
	var desc = "";
	var arr = ["p", "h2", "h3", "h4"];
	for (var i = 0, len = arr.length; i < len; i++) {
		desc = $(arr[i]).first().text();
		if(desc) break;
	}
	addHidden(document.getElementById('write-form'), 'desc', desc);
}

function submitWithCK(value){
	const data = ed.getData();
	if(data == "" || !document.getElementById('title').value.trim()){
		alert('빈칸을 채워주세요.');
		return;
	}
	var fm = document.getElementById('write-form');
	addHidden(fm, 'content', data);
	if(value)
		addHidden(fm, 'articlecategory_id', value);
	findFirstPictureAndAddForm();
	findFirstDescAndAddForm();
	// document.getElementById('ct').value = data;
	fm.submit();
}
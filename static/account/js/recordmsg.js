function PreviewImage(event) {

	var reader = new FileReader();
	reader.onload = function()
	{
	    var output = document.querySelector('.view');
	    output.style.height="40px";
	    output.src = reader.result;
	}
	reader.readAsDataURL(event.target.files[0]);
}
function CheckMessageInput(event) {
	var input=document.getElementById('message');
	var send=document.getElementById('send');
	var like=document.getElementById('likebut');
	var file=document.getElementById('file');
	var image=document.getElementById('image');

	if (/\S/.test(input.value) || file.value != "" || image.value != "") {
		send.style.display="inline";
		like.style.display="none";
	}
	if (image.value!="") {
		document.getElementById('message').placeholder="Image Selected.";
		PreviewImage(event);
		var cancel=document.querySelector('.cancel');
	    cancel.style.display="inline-block";
	}
	if (file.value!="") {
		document.getElementById('message').placeholder="File Selected.";
	}
	
}
function CheckMessage() {
	var input=document.getElementById('message');
	var file=document.getElementById('file');
	var image=document.getElementById('image');

	if (/\S/.test(input.value) || file.value != "" || image.value != "") {
		return true;
	}
	else{
		return false;
	}
	return false;
}
function ThumbClicked() {
	document.getElementById('message').value="&#128077;";
	document.getElementById('like').value="thumb";
	document.getElementById('msgform').submit();
}
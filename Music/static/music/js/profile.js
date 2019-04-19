var count=0;
function ShowInfo() {
	show=document.getElementById('info');
	hide=document.getElementById('menu-option');

	if (count==0) {
		show.style.display="block";
		count=count+1;
	}
	else{
		show.style.display="none";
		count=0;
	}
}

function MenuClicked(argument) {
	album=document.getElementById('album');
	likedsong=document.getElementById('likedsong');
	playlist=document.getElementById('playlist');

	if (argument=="album") {
		album.style.display="block";
		likedsong.style.display="none";
		playlist.style.display="none";

		album.contentWindow.location.reload();
	}
	if (argument=="likedsong") {
		album.style.display="none";
		likedsong.style.display="block";
		playlist.style.display="none";
		//var info=document.getElementById('info');
		//info.style.color="crimson";
		//info.innerHTML="Section under developement";

		likedsong.contentWindow.location.reload();
	}
	if (argument=="playlist") {
		album.style.display="none";
		likedsong.style.display="none";
		playlist.style.display="block";

		playlist.contentWindow.location.reload();	
	}
}
function RefreshFrame(){
	document.getElementById('album').contentWindow.location.reload();
	document.getElementById('likedsong').contentWindow.location.reload();
	document.getElementById('playlist').contentWindow.location.reload();
}
function PreviewCoverImage(event) {
	var savebutton=document.getElementById('savebutton');
	var cancelbutton=document.getElementById('cancelbutton');
	var editbutton=document.getElementById('editbutton');
	var changecp=document.getElementById('changecp');
	var changepp=document.getElementById('changepp');
	var pp=document.querySelector(".pp");

	var reader = new FileReader();
	reader.onload = function()
	{
	    var output = document.querySelector('.cp');
	    output.src = reader.result;
	    savebutton.style.display="inline-block";
	    cancelbutton.style.display="inline-block";
	    editbutton.style.display="inline-block";
	    changecp.style.display="none";
	    changepp.style.display="none";
	    pp.style.display="none";
	}
	reader.readAsDataURL(event.target.files[0]);
}
function PreviewProfileImage(event) {
	var savebutton=document.getElementById('savebutton');
	var cancelbutton=document.getElementById('cancelbutton');
	var editbutton=document.getElementById('editbutton');
	var changecp=document.getElementById('changecp');
	var changepp=document.getElementById('changepp');
	var pp=document.querySelector(".pp");
	var cp=document.querySelector(".cp");

	var reader = new FileReader();
	reader.onload = function()
	{
	    var output = document.querySelector('.pp');
	    output.src = reader.result;
	    savebutton.style.display="inline-block";
	    cancelbutton.style.display="inline-block";
	    editbutton.style.display="inline-block";
	    changecp.style.display="none";
	    changepp.style.display="none";
	    
	    /*cp.style.display="none";
	    pp.style.position="relative";
	    pp.style.width="200px";
	    pp.style.height="200px";*/
	}
	reader.readAsDataURL(event.target.files[0]);
}
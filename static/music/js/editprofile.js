function PreviewCoverImage(event) {
	var savebutton=document.getElementById('savebutton');
	var cancelbutton=document.getElementById('cancelbutton');
	var editbutton=document.getElementById('editbutton');
	var changecp=document.getElementById('changecp');
	var changepp=document.getElementById('changepp');
	var pp=document.querySelector(".prp");

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
	var pp=document.querySelector(".prp");
	var cp=document.querySelector(".cp");

	var reader = new FileReader();
	reader.onload = function()
	{
	    var output = document.querySelector('.prp');
	    output.src = reader.result;
	    savebutton.style.display="inline-block";
	    cancelbutton.style.display="inline-block";
	    editbutton.style.display="inline-block";
	    changecp.style.display="none";
	    changepp.style.display="none";
	    
	    cp.style.display="none";
	    pp.style.position="relative";
	    pp.style.display="block";
	    pp.style.width="200px";
	    pp.style.height="200px";
	}
	reader.readAsDataURL(event.target.files[0]);
}
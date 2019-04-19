function FileSelected(imagefile) {
	var imagefilename=imagefile.files[0].name;
	var myfile=document.getElementById('imagefilename');

	var fileName = document.getElementById("imagefile").value;
    var idxDot = fileName.lastIndexOf(".") + 1;
    var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();

    if (extFile=="jpg" || extFile=="png" || extFile=="jpeg" || extFile=="svg" || extFile=="gif"){
        myfile.style.color="green";
        myfile.innerHTML="&#x2714; Image Selected. " + imagefilename;
    }else{
        myfile.style.color="crimson";
        myfile.innerHTML="&#9888; Opps!! Image file not supported.";
        fileName="";
    }
}
function DateSelected() {
	var date=document.getElementById('date');
	var dateinfo= document.getElementById("dateinfo");
	var array=date.value.split("-");

	dateinfo.innerHTML="<b>"+date.value+"</b>";
}
function AlbumCreated() {
    var title= document.getElementById("title");
    var artist= document.getElementById("artist");
    var genre= document.getElementById("genre");
    var addalbum= document.getElementById("addalbumbutton");

    if (!(/\S/.test(genre.value))) {
        genre.value="Unknown";
    }

    if (!(/\S/.test(title.value))) {
        title.style.color="green";
        title.style.border="1px solid crimson";
        if (!(/\S/.test(artist.value))) {
            artist.style.color="green";
            artist.style.border="1px solid crimson";
        }
        return false
    }
    if (!(/\S/.test(artist.value))) {
        artist.style.color="green";
        artist.style.border="1px solid crimson";
        return false
    }
    addalbum.disabled=true;
    return true;
}
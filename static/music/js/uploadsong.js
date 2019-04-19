var songfileokay=false;
var lyricsfileokay=false;
var songtitle;

function FileSelected(songfile) {
	var songfilename=songfile.files[0].name;
	var myfile=document.getElementById('songfilename');

	var fileName = document.getElementById("songfile").value;
    var idxDot = fileName.lastIndexOf(".") + 1;
    var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();

    if (extFile=="mp3" || extFile=="m4a" || extFile=="mpeg" || extFile=="aac"){
        myfile.style.color="green";
        myfile.innerHTML="&#x2714; Song File Selected. " + songfilename;
        songfileokay=true;
        songtitle=songfilename;
    }else{
        myfile.style.color="crimson";
        myfile.innerHTML="&#9888; Opps!! Audio file not supported.";
        songfileokay=false;
    }
}
function LyricsSelected(lyricsfile) {
	var lyricsfilename=lyricsfile.files[0].name;
	var lyricsfileinfo=document.getElementById('lyricsfileinfo');

	var fileName = document.getElementById("lyrics").value;
    var idxDot = fileName.lastIndexOf(".") + 1;
    var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();

    if (extFile=="docx" || extFile=="pdf" || extFile=="txt" || extFile=="py"){
        lyricsfileinfo.style.color="green";
        lyricsfileinfo.innerHTML="&#x2714; Lyrics File Selected. " + lyricsfilename;
        lyricsfileokay=true;
    }else{
        lyricsfileinfo.style.color="crimson";
        lyricsfileinfo.innerHTML="&#9888; Opps!! file format not supported.";
        lyricsfileokay=false;
    }
}
function DateSelected() {
	var date=document.getElementById('date');
	var dateinfo= document.getElementById("dateinfo");
	var array=date.value.split("-");

	dateinfo.innerHTML="<b>"+date.value+"</b>";
}
function SongUpload() {
    var myfile=document.getElementById('songfilename');
    var lyricsfileinfo=document.getElementById('lyricsfileinfo');
    var lyric= document.getElementById("lyrics").value;
    var song= document.getElementById("songfile").value;

    var title= document.getElementById("title");
    var genre= document.getElementById("genre");
    var artist= document.getElementById("artist");
    var date= document.getElementById("date");
    var addsong= document.getElementById("addsongbutton");

    if (!(/\S/.test(title.value))) {
        title.value=(songtitle.split("."))[0];
    }
    if (!(/\S/.test(genre.value))) {
        genre.value='Unknown';
    }
    if (!(/\S/.test(artist.value))) {
        artist.value="Unknown Artist";
    }
    if (song!="" && lyric!="") {
        if (!songfileokay) {
            myfile.innerHTML="Please select a valid song file";
        }
        if (!lyricsfileokay) {
            lyricsfileinfo.innerHTML="Please select a valid file";
        }
        if (songfileokay && lyricsfileokay) {
            addsong.disabled=true;
            return true;
        }
    }
    if (song!="") {
        if (!songfileokay) {
            myfile.innerHTML="* Song file is required.";
        }
        if (songfileokay) {
            addsong.disabled=true;
            return true;
        }
    }
    return false;
}
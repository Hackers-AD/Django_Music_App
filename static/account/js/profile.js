function Show(argument) {
	var album=document.getElementById('albumdiv');
	var song=document.getElementById('songdiv');
	var photo=document.getElementById('photodiv');

	if (argument=="album") {
		album.style.display="block";
		song.style.display="none";
		photo.style.display="none";
	}
	if (argument=="song") {
		album.style.display="none";
		song.style.display="block";
		photo.style.display="none";
	}
	if (argument=="photo") {
		album.style.display="none";
		song.style.display="none";
		photo.style.display="block";
	}
}
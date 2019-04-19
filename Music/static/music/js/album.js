var sample_set=(nextPhoto,1000);
var sample_count=0;

function nextPhoto() {
	sampleone=document.getElementById('sampleone');
	samplenext=document.getElementById('samplenext');
	sample=document.getElementById('sample');

	if (sample_count==0) {
		sampleone.style.display="none";
		samplenext.style.display="flex";
		sample.contentWindow.location.reload();
		sample_count= 1;
	}
	else{
		sampleone.style.display="flex";
		samplenext.style.display="none";
		sample.contentWindow.location.reload();
		sample_count= 0;
	}
}
var audio_initialize;
var initialize_audio_length_counter;
var actualstop;
var counter=0;
var audiolengthcounter=0;
var functiontracker=new Object();
functiontracker.funcname="";
functiontracker.songid=0;
var defaultaudiovolume=0.5;
var audiocurrent_time=0;

function PlaySong(argument,songfile) {
	var targetlists=document.getElementsByTagName('li');

	if ((functiontracker.funcname=="pause" || functiontracker.funcname=="playpoint") && functiontracker.songid==argument) {
		console.log("Same Song Played");
	}
	else{
		for (var i = 0; i < targetlists.length; i++) {
			if (targetlists[i].id && targetlists[i].id!=argument) {
				StopSong(targetlists[i].id);
			}
		}
	}

	var targetlist=document.getElementById(argument);
	var audio=document.getElementById('audio');
	console.log(songfile)
	audio.src=songfile;
	var span=targetlist.getElementsByTagName('span');
	var div=targetlist.getElementsByTagName('div');
	var audiolength=document.getElementById('audiolength');
	audio.volume=defaultaudiovolume;
	audio.currentTime=audiocurrent_time;
	audio.play();
	duration=(audio.duration);

	span[1].style.display="none";
	span[2].style.display="inline";
	span[3].style.display="inline";
	span[4].style.display="inline";
	span[5].style.display="inline";
	span[6].style.display="none";
	span[7].style.display="none";

	functiontracker.funcname="play";
    functiontracker.songid=argument;
    console.log(functiontracker.funcname);
    console.log(functiontracker.songid);

	audio_initialize=setInterval(AnimateAudio,1000,argument);
	initialize_audio_length_counter=setInterval(AnimateAudioLength,1000,argument);

}
function PauseSong(argument) {
	var targetlist=document.getElementById(argument);
	var audio=document.getElementById('audio');
	var span=targetlist.getElementsByTagName('span');
	var div=targetlist.getElementsByTagName('div');
	audio.pause();
	audiocurrent_time=audio.currentTime;
	span[1].style.display="inline";
	span[2].style.display="none";
	span[3].style.display="none";
	span[4].style.display="none";
	span[5].style.display="none";
	span[6].style.display="inline";
	span[7].style.display="inline";

	clearInterval(audio_initialize);
	clearInterval(initialize_audio_length_counter);
	functiontracker.funcname="pause";
    functiontracker.songid=argument;
}
function StopSong(argument) {
	var targetlist=document.getElementById(argument);
	var audio=document.getElementById('audio');
	var span=targetlist.getElementsByTagName('span');
	var div=targetlist.getElementsByTagName('div');
	audio.load();
	span[1].style.display="inline";
	span[2].style.display="none";
	span[3].style.display="none";
	span[4].style.display="none";
	span[5].style.display="none";
	span[6].style.display="inline";
	span[7].style.display="inline";

	var scroller=div[3];
	div[2].style.display="none";
	div[4].style.display="none";
	scroller.style.left="0px";

	counter=0;
	audiolengthcounter=0;
	audiocurrent_time=0;
	clearInterval(audio_initialize);
	clearInterval(initialize_audio_length_counter);
	functiontracker.funcname="";
    functiontracker.songid=0;
}
function VolumeUp(argument) {
	var targetlist=document.getElementById(argument);
	var audio=document.getElementById('audio');
	defaultaudiovolume=defaultaudiovolume+0.1;
	audio.volume=defaultaudiovolume;
}
function VolumeDown(argument) {
	var targetlist=document.getElementById(argument);
	var audio=document.getElementById('audio');
	defaultaudiovolume=defaultaudiovolume-0.1;
	audio.volume=defaultaudiovolume;
}
function SetPlayPoint(argument,event) {
	var targetlist=document.getElementById(argument);
	var audio=document.getElementById('audio');
	var span=targetlist.getElementsByTagName('span');
	var div=targetlist.getElementsByTagName('div');
	var x=event.clientX-(0.1*document.body.clientWidth);
	var screenwidth=(document.body.clientWidth)*0.8;
	var audioduration=(audio.duration);
	var pixelforonesec=(screenwidth/audioduration);
	var timepoint=(x/pixelforonesec);
	counter=Math.floor(timepoint);

	var scroller=div[3];
	scroller.style.left=(counter*pixelforonesec)+"px";

	audio.currentTime=(timepoint);
	audiolengthcounter=timepoint;
	audiocurrent_time=audio.currentTime;
	console.log(counter);
	functiontracker.funcname="playpoint";
	functiontracker.songid=argument;
}
function AnimateAudio(argument){
	var targetlist=document.getElementById(argument);
	var audio=document.getElementById('audio');
	var span=targetlist.getElementsByTagName('span');
	var div=targetlist.getElementsByTagName('div');

	audioduration=(audio.duration);
	counter++;
	screenwidth=(document.body.clientWidth)*0.8;

	var pixelforonesec=(screenwidth/audioduration);
	var scroller=div[3];

	if ((counter*pixelforonesec)>=screenwidth) {
		StopSong(argument);
	}

	div[2].style.display="block";
	scroller.style.left=counter*pixelforonesec+"px";
	console.log(counter);
}
function AnimateAudioLength(argument){
	var targetlist=document.getElementById(argument);
	var audio=document.getElementById('audio');
	var div=targetlist.getElementsByTagName('div');

	audiolengthcounter++;

	audioduration=(audio.duration);

	if (audiolengthcounter >= audioduration) {
		audiolengthcounter=0;
		clearInterval(initialize_audio_length_counter);
	}
	newduration=audioduration-audiolengthcounter;

	
	div[4].innerHTML=Math.floor(newduration/60)+":"+Math.round(newduration%60);
	div[4].style.display="inline";
}
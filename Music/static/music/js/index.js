var notifycount=0;
console.log(navigator.userAgent);
var testMobile="iPhone|iPad|iPod|Android";
var isMobile=/testMobile/i.test(navigator.userAgent);
console.log(isMobile);
if (isMobile) {
	var body=document.getElementsByTagName('body')[0];
	body.setAttribute("font-size","20px");
}
for (var i = 0; i < Things.length; i++) {
	Things[i]
}
function nextCover(argument) {
	header=document.getElementById('header');

	headone=document.getElementById('head-one');
	headtwo=document.getElementById('head-two');
	headthree=document.getElementById('head-three');

	if (argument==1) {
		headone.style.display="block";
		headtwo.style.display="none";
		headthree.style.display="none";

		header.style.color="lime";
	}
	if (argument==2) {
		headone.style.display="none";
		headtwo.style.display="block";
		headthree.style.display="none";

		header.style.color="#333";
	}
	if (argument==3) {
		headone.style.display="none";
		headtwo.style.display="none";
		headthree.style.display="block";
		
		header.style.color="#fff";
	}
}
function RefreshFrame(){
	document.getElementById('album').contentWindow.location.reload();
	document.getElementById('artist').contentWindow.location.reload();
	document.getElementById('trending').contentWindow.location.reload();
	document.getElementById('song').contentWindow.location.reload();
	document.getElementById('lyric').contentWindow.location.reload();
	document.querySelector('.notify').contentWindow.location.reload();
}
function MenuClicked(arg) {
	album=document.getElementById('album');
	trend=document.getElementById('trending');
	artist=document.getElementById('artist');
	song=document.getElementById('song');
	lyric=document.getElementById('lyric');

	if (arg=="album") {
		album.style.display="block";
		trend.style.display="none";
		artist.style.display="none";
		song.style.display="none";
		lyric.style.display="none";

		album.contentWindow.location.reload();
	}
	if (arg=="trend") {
		album.style.display="none";
		trend.style.display="block";
		artist.style.display="none";
		song.style.display="none";
		lyric.style.display="none";

		trend.contentWindow.location.reload();
	}
	if (arg=="artist") {
		album.style.display="none";
		trend.style.display="none";
		artist.style.display="block";
		song.style.display="none";	
		lyric.style.display="none";

		artist.contentWindow.location.reload();	
	}
	if (arg=="song") {
		album.style.display="none";
		trend.style.display="none";
		artist.style.display="none";
		song.style.display="block";
		lyric.style.display="none";

		song.contentWindow.location.reload();		
	}
	if (arg=="lyric") {
		album.style.display="none";
		trend.style.display="none";
		artist.style.display="none";
		song.style.display="none";
		lyric.style.display="block";

		lyric.contentWindow.location.reload();		
	}
}
function ResetNotify() {
	
}

function ShowNotify(event) {
	screenwidth=document.body.scrollWidth;
	x=event.pageX;
	y=event.pageY;

	var notify=document.querySelector('.notify');
	var notifydiv=document.querySelector('.notifydiv');
	var body=document.getElementsByTagName('body')[0];

	//notify.style.right=(screenwidth-x)+"px";
	//notify.style.top=(y+30)+"px";
	var notifydivs=document.getElementsByTagName('note');
	var windowheight=window.scrollY;

	for (var i = 0; i < notifydivs.length; i++) {
		notifydivs[i].innerHTML="0";
	}

	notifydiv.style.display="block";
	notifydiv.style.top=windowheight+"px";
	body.style.overflow="hidden";

	notify.setAttribute("src","/account/notify/");
	notify.contentWindow.location.reload();

	console.log(x);
	console.log(y);
	console.log(notify);
}
function CloseNotify() {
	var notifydiv=document.querySelector('.notifydiv');
	var body=document.getElementsByTagName('body')[0];
	notifydiv.style.display="none";
	body.style.overflow="scroll";
}
function Display() {
	var msg=document.querySelector('.msg');
	var bell=document.querySelector('.bell');

	msg.style.display="flex";
	bell.style.display="flex";
}
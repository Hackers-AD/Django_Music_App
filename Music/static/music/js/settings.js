var x;
var y;
function RefreshFrame() {

	var general=document.getElementById('general');
	var messages=document.getElementById('messages');
	var musics=document.getElementById('musics');
	var notify=document.getElementById('notify');
	var profile=document.getElementById('profile');

	general.contentWindow.location.reload();
	messages.contentWindow.location.reload();
	musics.contentWindow.location.reload();
	notify.contentWindow.location.reload();
	profile.contentWindow.location.reload();
}
function ShowMenu() {
	var menu=document.getElementById('menu');
	var menudiv=document.getElementById('menudiv');

	menu.style.display="block";
	menudiv.style.display="none";
}
function HideMenu() {
	var menu=document.getElementById('menu');
	var menudiv=document.getElementById('menudiv');

	menu.style.display="none";
	menudiv.style.display="block";
}
function SettingsChoosen(argument) {
	var menu=document.getElementById('menu');
	var menudiv=document.getElementById('menudiv');

	menu.style.display="none";
	menudiv.style.display="block";

	var general=document.getElementById('general');
	var messages=document.getElementById('messages');
	var musics=document.getElementById('musics');
	var notify=document.getElementById('notify');
	var profile=document.getElementById('profile');

	if (argument=="general") {
		general.style.display="block";
		messages.style.display="none";
		musics.style.display="none";
		notify.style.display="none";
		profile.style.display="none";
	}
	if (argument=="messages") {
		general.style.display="none";
		messages.style.display="block";
		musics.style.display="none";
		notify.style.display="none";
		profile.style.display="none";
	}
	if (argument=="musics") {
		general.style.display="none";
		messages.style.display="none";
		musics.style.display="block";
		notify.style.display="none";
		profile.style.display="none";
	}
	if (argument=="notify") {
		general.style.display="none";
		messages.style.display="none";
		musics.style.display="none";
		notify.style.display="block";
		profile.style.display="none";
	}
	if (argument=="profile") {
		general.style.display="none";
		messages.style.display="none";
		musics.style.display="none";
		notify.style.display="none";
		profile.style.display="block";
	}
	general.contentWindow.location.reload();
	messages.contentWindow.location.reload();
	musics.contentWindow.location.reload();
	notify.contentWindow.location.reload();
	profile.contentWindow.location.reload();
}
function DeleteAccount(){
	//x=event.clientX;
	//y=event.clientY;
	h=window.innerHeight;

	var confirm_delete=document.querySelector(".bg-confirm");
	var confirm_body=document.querySelector(".confirm-body");

	var sbody=document.getElementById("settingsbody");
	var bodyheight=document.body.scrollHeight;
	var windowheight=window.scrollY;

	confirm_delete.style.display="flex";
	confirm_delete.style.top=windowheight+"px";
	//confirm_delete.style.height=bodyheight+"px";
	sbody.style.overflow="hidden";
}
function SafeClose() {
	var confirm_delete=document.querySelector(".bg-confirm");
	var sbody=document.getElementById("settingsbody");
	confirm_delete.style.display="none";
	sbody.style.overflow="scroll";
}
function PasswordCheck() {
	var password=document.getElementById("password");
	var info=document.getElementById("info");

	if (!(/\S/.test(password.value))) {
		info.style.color="green";
		info.innerHTML="* Please enter valid password.";
		info.style.display="block";
		return false;
	}
	if (password.value.length<8) {
		info.innerHTML="* Password length must be 8 or greater.";
		info.style.color="crimson";
		info.style.display="block";
		return false;
	}
	return true;
}
function HideInfo() {
	var info=document.getElementById("info");
	info.style.display="none";
}
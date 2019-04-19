var count=0;
function ShowActiveFriend() {
	iframeactive=document.getElementById('friendlist');
	if (count==0) {
		iframeactive.style.display="block";
		count=1;
	}
	else{
		iframeactive.style.display="none";
		count=0;
	}
	iframeactive.contentWindow.location.reload();
}
function SeeMessage() {
	conversation=document.getElementById('conversation');
	conversation.onload="this.style.height = 0;this.style.height=(contentWindow.document.body.scrollHeight + 15) + 'px';";
	conversation.scrolling="yes";
	conversation.contentWindow.location.reload();
}
function MessageRecord() {
	var conversation=document.getElementById('conversation');
	conversation.contentWindow.location.reload();
}
/*function RefreshFrame() {
	friendlist=document.getElementById(tl'friendlist');
	conversation=document.getElementById('conversation');
	console.log(document.body.clientWidth,conversation);

	if(document.body.clientWidth > 767){
		friendlist.style.display="inline";
		conversation.style.display="inline";

		conversation.contentWindow.location.reload();
		friendlist.contentWindow.location.reload();
	}else{
		count=1;
		ShowActiveFriend();
	}
}*/
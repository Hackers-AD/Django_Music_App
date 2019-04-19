{%extends 'account/base.php'%}
{%load static%}
{%block link%}
<link rel="stylesheet" type="text/css" href="{% static 'account/css/recordmsg.css'%}">
<script type="text/javascript" src="{% static 'account/js/recordmsg.js'%}"></script>
{%endblock%}
{%block body%}
<body>
	<div style="text-align: center;position: relative;">
		<img src="" width="100" class="hideview">
		<div class="hidecancel" style="display: none;"><span style="cursor: pointer;" onclick="window.open('/account/recordmsg/{{msg_id}}','_self')">&times;</span></div>
	</div>
	<header>
		<nav>
			<form action="/account/recordmsg/{{msg_id}}/" method="post" autocomplete="off" enctype="multipart/form-data" onsubmit="return CheckMessage();" id="msgform">{%csrf_token%}
				<input type="file" id="image" name="image" style="display: none;" accept="image/*" onchange="CheckMessageInput(event)">
				<label for="image"><span class="glyphicon glyphicon-picture"></span></label>
				<input type="file" id="file" name="file" style="display: none;" accept="application/*" onchange="CheckMessageInput(event)">
			    <label for="file"><span class="glyphicon glyphicon-file"></span></label>
			    <input type="text" name="message" placeholder="Write a message." autocomplete="off" onkeyup="CheckMessageInput(event)" id="message" autofocus="">
			    <button type="submit" class="submitform" style="display: none;" id="send">
			    	<span class="glyphicon glyphicon-send"></span>
			    </button>
			    <button type="button" class="submitform" id="likebut" onclick="ThumbClicked()">
			    	<input type="" name="thumbsup" style="display: none;" id="like">
			    	<span class="glyphicon glyphicon-thumbs-up"></span>
			    </button>
			    <span onclick="window.open('/account/recordmsg/{{msg_id}}','_self')" class="cancel">&times;</span>
			    <span class="glyphicon glyphicon-record" id="record" style="display: none;"></span>
		    </form>
		    <br>
		</nav>
	</header>
</body>
{%endblock%}
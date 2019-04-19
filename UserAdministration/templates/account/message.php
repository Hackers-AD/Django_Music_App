{%extends 'account/base.php'%}
{%load static%}
{%block link%}
<link rel="stylesheet" type="text/css" href="{% static 'account/css/message.css'%}">
<script type="text/javascript" src="{% static 'account/js/message.js'%}"></script>
{%endblock%}
{%block body%}
<body onresize="RefreshFrame()" id="framebody">
	<header>
		<nav class="navbar navbar-inverse" style="margin:0;border-radius: 0;">
			<ul class="message-menu">
				<li>
					<a href="/tubelight/{{request.user}}/">
					{%if profile.profile_photo%}
						<img src="{{profile.profile_photo.url}}">				
					{%else%}
						<img src="{%static 'music/img/profile.png'%}">
					{%endif%}
					</a>
				</li>
				<li onclick="window.open('/account/recentmessage/','_self')"><img src="{%static 'account/img/ficonblue.png'%}" style="border:none"></li>
				<li onclick="window.open('/account/addfriend/','_self')"><img src="{%static 'account/img/friendadd.png'%}"></li>
			</ul>
		</nav>
	</header>

	<section>
		<iframe src="/account/activefriend/" id="friendlist"  scrolling="yes" onload="this.height=screen.height;"></iframe>
		{%if msg_id%}
		    <iframe src="/account/recordmsg/{{msg_id}}/" frameborder="0" scrolling="no" onload="MessageRecord()" id="msgrecord"></iframe>
		    <iframe src="/account/conversation/{{msg_id}}/" id="conversation" frameborder="0" scrolling="no" onload="this.height=screen.height;"></iframe>
    </section>
		{%else%}
		    <center>
		    	<br><br>
				<h3 style="margin: 0;"><span class="glyphicon glyphicon-info-sign"></span></h3>
				<h4>You Havenot Started any Conversation Yet.</h4>
				<p>See who is online to start.</p>
				<a href="/account/addfriend/"><button class="btn btn-info">Add Friends</button></a>
			</center>
		{%endif%}
    <div id="menu" onclick="ShowActiveFriend()"><button><span class="glyphicon glyphicon-list"></span></button></div>
    {%if msg_id%}
		<div id="seemsg"><label onclick="SeeMessage()"><span class="glyphicon glyphicon-eye-open"></span> See All Message</label></div>
	{%endif%}   
</body>
{%endblock%}
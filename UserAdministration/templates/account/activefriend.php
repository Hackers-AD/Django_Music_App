{%extends 'account/base.php'%}
{%load static%}
{%block link%}
<link rel="stylesheet" type="text/css" href="{% static 'account/css/activefriend.css'%}">
<script type="text/javascript" src="{% static 'account/js/activefriend.js'%}"></script>
<meta http-equiv="refresh" content="60">
{%endblock%}
{%block body%}
<body>
	<header><br>
	    <div style="position: absolute;">
	    	<img src="{% static 'music/img/friend.png'%}" width="35px">
	        <big>Active Friends</big>
	    </div>
	    <form accept="" method="get" id="onoff" style="margin:0px;">
	    	{%if chat_status%}
		    <label class="switch" onclick="document.getElementById('onoff').submit();">
			  <input type="checkbox" name="onoff">
			  <span class="slider round"></span><br>
			  Online
			</label>
			{%else%}
			<label class="switch" onclick="document.getElementById('onoff').submit();">
			  <input type="checkbox" name="onoff">
			  <span class="slider round" style="background: #f0f0f0;"></span><br>Offline
			</label>
			{%endif%}
	    </form>

		<form action="" method="" autocomplete="off" id="searchform"><br>
		    <input type="text" name="q" placeholder="Search Friends." autocomplete="off">
	    </form>
	</header>
	{%if chat_status%}
	<section id="list">
		{%if friends%}<ul class="userlist">
			{%for friend in friends%}<li onclick="window.open('/account/message/{{friend.follower}}','_parent');">
			    {%if friend.follow_perm%}
					{%for trackuser in trackusers%}
					    {%ifequal trackuser.user.id friend.follower%}
					        {%if trackuser.is_online%}
						        {%for profile in profiles%}
						            {%ifequal friend.follower profile.user.id%}
						                {%if profile.profile_photo%}
						                <img src="{{profile.profile_photo.url}}" class="profilepic">
						                {%else%}
						                <img src="{% static 'account/img/profile.png'%}" class="profilepic">
						                {%endif%}
						            {%endifequal%}
						        {%endfor%}
						        &emsp;{{trackuser.user}}
						        <div class="circle"></div>
					        {%endif%}
					    {%endifequal%}
					{%endfor%}
			    {%endif%}</li>
			{%endfor%}</ul>
	    {%else%}
	    <br>
	    <center><span class="glyphicon glyphicon-alert">
	    	<label>No Friend For Chat.
	    		<br>Start Following Friend to start Conversation.
	    	</label><br>
	    	<button class="btn btn-success" onclick="window.open('/account/addfriend/','_parent')">Add Friends</button></a>
	    </span></center>
		{%endif%}
		{%if pendingrequest%}
		<div class="pendingrequestinfo">
			<p><span class="glyphicon glyphicon-user"></span> Some Friends with Follow Request are Online.</p>
			<button class="btn btn-info" onclick="window.open('/account/addfriend/','_parent')">Approve Request</button></a>
	    </div>
	    {%else%}
	        {%if nouseronline%}
	        <center>
	        	<span class="glyphicon glyphicon-exclamation-sign"></span><br>
	            Opps!! No Friends is Online Now.
	        </center>
		    {%endif%}
		{%endif%}
	<div id="seefriends"><button class="btn btn-primary btn-block" onclick="SeeOnlineFriends()">See More Friends</button></div>
	</section>
	{%else%}
	<center><br>
		<span class="glyphicon glyphicon-alert" style="font-size: 20px;"></span><br>
		<label style="font-size: 14px;">You are Offline.</label><br><br>
		<form action="" method="get">
		    <button type="submit" class="btn btn-success" name="onoff" value=".">
		        Go Online
		    </button>
		</form>
	</center>
	{%endif%}
</body>
{%endblock%}
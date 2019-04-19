{%extends 'music/base.php'%}
{%load static%}
{%block link%}
<link rel="stylesheet" type="text/css" href="{% static 'music/css/settings.css'%}">
<script type="text/javascript" src="{% static 'music/js/settings.js'%}"></script>
{%endblock%}
{%block body%}
<body id="settingsbody" onresize="RefreshFrame()">
	<header onclick="HideMenu()">
		<nav>
			<h1><span onclick="window.open('/tubelight/','_self')">
				<span class="glyphicon glyphicon-music"></span> TubeLight
			</span></h1>
		    <h4><span class="glyphicon glyphicon-cog"></span> Account Settings</div></h4>
		    <center> Configure Your Account.</center><br>
		    {%if profile.profile_photo%}
		    <img src="{{profile.profile_photo.url}}" class="pp" onclick="window.open('/tubelight/{{request.user}}','_self')">
		    {%else%}
		    <img src="{% static 'music/img/profile1.png'%}" class="pp" onclick="window.open('/tubelight/{{request.user}}','_self')">
		    {%endif%}
	    </nav>
	    <ul>
		  	<li><span></span></li>
		   	<li onclick="window.open('/profile/edit/','_self')"><span class="glyphicon glyphicon-edit"></span> Edit Profile</li>
		</ul>
	</header>
	<article>
		<div id="menudiv"><span class="glyphicon glyphicon-list" onclick="ShowMenu()"></span></div>
		{%if delerror%}
		    <center><h4 style="color: red;">Password Doesn't Matched. Retry ?</h4></center>
		{%endif%}
		<section id="menu" onload="">
			<div onclick="HideMenu()">
				<span class="glyphicon glyphicon-menu-left"></span><span class="glyphicon glyphicon-menu-left"></span>
			</div><br>
			<ul>
				<li onclick="SettingsChoosen('general')"><span class="glyphicon glyphicon-cog"></span> General</li>
			    <li onclick="SettingsChoosen('messages')"><span class="glyphicon glyphicon-envelope"></span> Messages
			    </li>
				<li onclick="SettingsChoosen('musics')"><span class="glyphicon glyphicon-music"></span> Musics</li>
				<li onclick="SettingsChoosen('notify')"><span class="glyphicon glyphicon-bell"></span> Notifications
				</li>
				<li onclick="SettingsChoosen('profile')"><span class="glyphicon glyphicon-user"></span> Profile</li>
				<li onclick="DeleteAccount()"><span class="glyphicon glyphicon-trash"></span> Delete Account</li>
			</ul>
		</section>
		<section id="content" onclick="HideMenu()">
			<iframe src="/settings/general/" id="general" frameborder="0" scrolling="no" onload="this.style.height = 0;this.style.height=(contentWindow.document.body.scrollHeight + 15) + 'px';"></iframe>

			<iframe src="/settings/messages/" id="messages" frameborder="0" scrolling="no" onload="this.style.height = 0;this.style.height=(contentWindow.document.body.scrollHeight + 15) + 'px';"></iframe>

			<iframe src="/settings/musics/" id="musics" frameborder="0" scrolling="no" onload="this.style.height = 0;this.style.height=(contentWindow.document.body.scrollHeight + 15) + 'px';"></iframe>

			<iframe src="/settings/notify/" id="notify" frameborder="0" scrolling="no" onload="this.style.height = 0;this.style.height=(contentWindow.document.body.scrollHeight + 15) + 'px';"></iframe>

			<iframe src="/settings/profile/" id="profile" frameborder="0" scrolling="no" onload="this.style.height = 0;this.style.height=(contentWindow.document.body.scrollHeight + 15) + 'px';"></iframe>

			<form action="" method="post" id="DeleteAccountForm">{%csrf_token%}
				<input type="submit" name="delete_account" value="DeleteAccount" style="display: none;">
			</form>
		</section>
	</article>
	<div class="bg-confirm">
		<div class="confirm-body">
			<div class="safeclose" onclick="SafeClose()">&times;</div><br><br>
			<span class="glyphicon glyphicon-alert" style="font-size: 25px;color: red;"></span><br>
			<h4>Are You Sure to Delete Account Permanantly ?</h4>
			<label>Confirm Password.</label>
			<form action="" method="post" autocomplete="off" onsubmit="return PasswordCheck();">{%csrf_token%}
				<p id="info"></p>
				<input type="password" name="password" placeholder="Password" autocomplete="off" id="password" onfocus="HideInfo();"><br><br>
				<button type="submit" name="delete" class="btn btn-danger" value="delete">
					<span class="glyphicon glyphicon-trash"></span> Delete Account
				</button>
			</form>
			<div class="btn btn-success" id="delcancel" onclick="SafeClose()">
				<span class="glyphicon glyphicon-ok"></span> Cancel
			</div>
		</div>
	</div>
	<footer>
		<ul>
			<li>Terms of Use</li>
			<li>Privacy Policy</li>
			<li>Feedback</li>
			<li>Report an Issue</li>
			<li>FAQs</li>
		</ul>
		<center style="color: black;"><br>
			<h2>&#x266C;</h2>
			&copy;TubeLight Music 2019, All Rights Reserved.
		</center>
	</footer>
</body>
{%endblock%}
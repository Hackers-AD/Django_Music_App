{%extends 'music/base.php'%}
{%load static%}
{%block link%}
<link rel="stylesheet" type="text/css" href="{% static 'music/css/generalsettings.css'%}">
<script type="text/javascript" src="{% static 'music/js/generalsettings.js'%}"></script>
{%endblock%}
{%block body%}
<body>
	<h2><span class="glyphicon glyphicon-cog"></span> General Settings</h2>
	<ul class="infolist">
		<li>
			<b><span class="glyphicon glyphicon-chevron-right" id="pchev"></span> <big>Account Information</big></b>
			<p style="margin-left: 20px;"> 
			    Account Information refers to data you had provided us at the time of creating your account. You can edit those information here.
		    </p>
			<form id="accountinfoform">
				<label>Username and Email</label><br>
				<input type="text" name="username" placeholder="Username">
				<input type="email" name="email" placeholder="E-mail address.">
				<br><br><label>Change Password</label><br>
				<input type="password" name="oldpass" placeholder="Recent password.">
				<input type="password" name="newpass" placeholder="New password.">
				<br><br>
				<button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-save"></span> Save Changes</button>
			</form>
		</li>
		<br>
		<li>
			<b><span class="glyphicon glyphicon-chevron-right" id="pchev"></span> <big>Account Privacy</big></b>
			<p style="margin-left: 20px;">You can maitain your account privacy by three labels. Public, Private and Friendly. Public label allows anyone, see your account info. Private label ensure only you can see you account info else no one. And Friendly label allows only your friends to see your account info.<br>Public is Default label.</p>
			<b style="margin-left: 20px">Make Your Account : </b><br>
			<form action="" method="" id="privacyform">
				<div>
					<label><span class="glyphicon glyphicon-globe"></span> Public</label>
					<input type="radio" name="public" checked="true" value="public" onclick="document.getElementById('privacyform').submit()">
			    </div>
			    <div>
					<label><span class="glyphicon glyphicon-user"></span> Private</label>
					<input type="radio" name="private" value="private" onclick="document.getElementById('privacyform').submit()">
			    </div>
			    <div>
					<label>
						<span class="glyphicon glyphicon-user"></span><span class="glyphicon glyphicon-user"></span>
						Friendly
						<input type="radio" name="friendly" value="friend" onclick="document.getElementById('privacyform').submit()">
					</label>
			    </div>
			</form>
		</li>
	</ul>
	<br><br><br>
	<center><button class="btn btn-warning"><span class="glyphicon glyphicon-log-out"></span> Deactivate Account</button></center>
</body>
{%endblock%}
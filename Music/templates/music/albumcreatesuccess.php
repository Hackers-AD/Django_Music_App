{%extends 'music/base.php'%}
{%load static%}
{%block link%}
<link rel="stylesheet" type="text/css" href="{% static 'music/css/newalbum.css'%}">
<script type="text/javascript" src="{% static 'music/js/newalbum.js'%}"></script>
{%endblock%}
{%block body%}
<body>
	<header>
		<nav class="navbar bg-primary" id="navtop">
			<h1><span onclick="window.open('/tubelight/','_self')"><span class="glyphicon glyphicon-headphones"></span> TubeLight Music</span></h1>
			{%if not request.user.is_authenticated%}
			    <button class="btn btn-primary btn-lg">Sign Up Now</button>
			{%endif%}
		</nav>
		<div>
			<span class="glyphicon glyphicon-film"></span><br>
			<span class="glyphicon glyphicon-arrow-down"></span>
			<span class="glyphicon glyphicon-arrow-down"></span>
			<span class="glyphicon glyphicon-arrow-down"></span>
	    </div>
	    {%if profile.profile_photo%}
			<img src="{{profile.profile_photo.url}}" class="pp" onclick="window.open('/tubelight/{{request.user}}/','_self')">
	    {%endif%}
	</header>

	<div class="navbar navbar-default" id="headerdiv">
	   	<h2>
	    	<span class="glyphicon glyphicon-plus-sign"></span> Create&ensp;
	        <span class="glyphicon glyphicon-film"></span> Album
	    </h2>
	</div>
	<center>
		<span style="color: green;">
	        <big><span class="glyphicon glyphicon-saved"></span> Album is sucessfully created.</big>
	    </span><br><br>
    
	    <a href="/createalbum/">
		    <button class="btn btn-primary btn-lg">
		    	<span class="glyphicon glyphicon-plus-sign"></span> Create Next Album
		    </button>
	    </a>
	    <a href="/tubelight/">
	     	<button class="btn btn-primary btn-lg">Back To Home</button>
	    </a>
    </center>
	<br><br><br><br><br>
	<a href="/album/{{album_id}}/addsong/">
		<button class="btn btn-default btn-block btn-lg">
		    <h2><span class="glyphicon glyphicon-plus-sign"></span> Add Song in Album</h2>
		</button>
	</a>
	<footer>
		<span class="glyphicon glyphicon-headphones" style="font-size: 30px;"></span><br>
		{%if not request.user.is_authenticated%}<h2 onclick="window.open('/account/signup/','_self')">Sign Up Now !!</h2>{%endif%}
		<h3>TubeLight Music Station</h3>
		<b>&copy;copyright, 2019</b>
		<br>All Rights Reserved.<br>
		<span class="glyphicon glyphicon-envelope"></span> innovativename05@gmail.com
	</footer>
</body>
{%endblock%}
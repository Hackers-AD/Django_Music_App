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
	<form action="" method="post" enctype="multipart/form-data" id="uploadform" onsubmit="return AlbumCreated();">{%csrf_token%}
		<input type="text" name="title" placeholder="* Title of Album" id="title">
		<input type="text" name="genre" placeholder="Genre"  id="genre">
		<input type="text" name="artist" placeholder="* Album Artist" id="artist">
		<br><br>
		<input type="file" name="imagefile" id="imagefile" style="display: none;" onchange="FileSelected(this)">
		<label for="imagefile">
			<span class="btn btn-block" style="border:none;" id="choosesongbtn">
				<span class="glyphicon glyphicon-picture" style="font-size: 20px;"></span>
				&ensp;Choose Album logo
			</span>
			<span id="imagefilename" style="font-weight: normal;"></span>
		</label>
		<br>
		<label><span class="glyphicon glyphicon-time"></span> Released Date:</label>
		<input type="date" name="date" id="date" style="height: 0px;width: 0px;border-radius: 50%;padding:0;" onchange="DateSelected()">
		<label for="date" style="cursor: pointer;"><span class="glyphicon glyphicon-calendar" style="font-size: 20px;"></span></label>
		&emsp;<span id="dateinfo"></span><br><br>
		<button type="submit" class="btn btn-primary btn-lg" style="padding: 5px 50px;" id="addalbumbutton">
			<span class="glyphicon glyphicon-plus-sign"></span> Create Album
		</button>
	</form>
	<center><span style="color: red">*</span> means field is mandatory.</center>
	<br><br><br><br><br>
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
{%extends 'music/base.php'%}
{%load static%}
{%block link%}
<link rel="stylesheet" type="text/css" href="{% static 'music/css/uploadsong.css'%}">
<script type="text/javascript" src="{% static 'music/js/uploadsong.js'%}"></script>
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
			<span class="glyphicon glyphicon-music"></span><br>
			<span class="glyphicon glyphicon-heart"></span>
			<span class="glyphicon glyphicon-heart"></span>
			<span class="glyphicon glyphicon-heart"></span>
	    </div>
	    {%if profile.profile_photo%}
			<img src="{{profile.profile_photo.url}}" class="pp" onclick="window.open('/tubelight/{{request.user}}/','_self')">
	    {%endif%}
	</header>

	<div class="navbar navbar-default" id="headerdiv">
	   	<h2>
	    	<span class="glyphicon glyphicon-upload"></span> Upload&ensp;
	        <span class="glyphicon glyphicon-headphones"></span> Song
	    </h2>
	</div>
	{%if message%}
	<center>
		<span style="color: green;">
	        <big>Song is sucessfully added. Add another song. </big>
	    </span><br>
    </center>
	{%endif%}
	<form action="" method="post" enctype="multipart/form-data" id="uploadform" onsubmit="return SongUpload()">{%csrf_token%}
		<input type="text" name="title" placeholder="Title of Song" id="title">
		<input type="text" name="genre" placeholder="Genre" id="genre">
		<input type="text" name="artist" placeholder="Song Artist" id="artist">
		<br><br>
		<input type="file" name="songfile" id="songfile" style="display: none;" onchange="FileSelected(this)">
		<label for="songfile">
			<span class="btn btn-block" style="border:none;" id="choosesongbtn">
				<span class="glyphicon glyphicon-hand-right"></span>
				&ensp;Choose Music File *
			</span>
			<span id="songfilename" style="font-weight: normal;"></span>
		</label>
		<br>
		<label>Write Song Lyrics.</label><br>
		<textarea name="lyrictyped" placeholder="If you know song lyrics, you can type it and submit song with lyric. Or you can upload lyrics file from icon below."></textarea>
		<br><br>--------OR--------<br><br>
		<input type="file" name="lyrics" id="lyrics" style="display: none;" onchange="LyricsSelected(this)">
		<label for="lyrics">
			<span class="glyphicon glyphicon-file" style="cursor: pointer;font-size: 20px;"></span>
		</label><br>
		<b id="lyricsfileinfo">Attach lyrics file</b><br><br>
		<label><span class="glyphicon glyphicon-time"></span> Released Date:</label>
		<input type="date" name="date" id="date" style="height: 0px;width: 0px;border-radius: 50%;padding:0;" onchange="DateSelected()">
		<label for="date" style="cursor: pointer;"><span class="glyphicon glyphicon-calendar" style="font-size: 20px;"></span></label>
		&emsp;<span id="dateinfo"></span><br><br>
		<button type="submit" class="btn btn-primary btn-lg" style="padding: 5px 50px;" id="addsongbutton">
			<span class="glyphicon glyphicon-plus-sign"></span> Add Song
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
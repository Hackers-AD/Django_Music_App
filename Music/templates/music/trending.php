{%extends 'music/base.php'%}
{%load static%}
{%block link%}
<link rel="stylesheet" type="text/css" href="{% static 'music/css/artist.css'%}">
<link rel="stylesheet" type="text/css" href="{% static 'music/css/album.css'%}">
<script type="text/javascript" src="{% static 'music/js/artist.js'%}"></script>
<script type="text/javascript" src="{% static 'music/js/song.js'%}"></script>
{%endblock%}
{%block body%}
<body>
	{%if songs%}
		<h2 class="navbar navbar-default"><span class="glyphicon glyphicon-music">&ensp;Songs</h2>
		<audio id="audio"></audio>
		<ol style="padding: 0px;font-weight: bold;">
		    {%for song in songs%}
		    <li class="navbar navbar-default" style="margin:0;padding-bottom: 30px;padding-top: 25px;" id="{{song.id}}">
		    	<p style="position: absolute;top: 0px;right: 30px;font-size: 18px;color: blue;font-weight: normal;cursor: pointer;" class="glyphicon glyphicon-hand-right"> {{song.song_artist}}
		    	</p>
		    	<div id="songname">{{forloop.counter}}. {{song.song_title}}</div>
		    	<span class="optspan">
		    		<span class="glyphicon glyphicon-play" onclick="PlaySong('{{song.id}}','{{song.song_file.url}}')" id="play"></span>
		    		<span class="glyphicon glyphicon-pause" onclick="PauseSong('{{song.id}}')" id="pause" style="display: none;"></span>
		    		<span class="glyphicon glyphicon-volume-up" onclick="VolumeUp('{{song.id}}')" id="volup" style="display: none;"></span>
		    		<span class="glyphicon glyphicon-stop" onclick="StopSong('{{song.id}}')" id="stop" style="display: none;"></span>
		    		<span class="glyphicon glyphicon-volume-down" onclick="VolumeDown('{{song.id}}')" id="voldown" style="display: none;"></span>
		    		<a href="{{song.song_file.url}}" download="{{song.song_title}}"><span class="glyphicon glyphicon-download" id="download"></span></a>
		    		<span class="glyphicon glyphicon-file" id="file"></span>
		    	</span>
		    	<div class="songfeed">
		    		<span class="glyphicon glyphicon-thumbs-up"> {{song.likes}}</span>
		    		<span class="glyphicon glyphicon-thumbs-down"> {{song.dislikes}}</span>
		    	</div>
		    	<div class="audioline" onclick="SetPlayPoint('{{song.id}}',event)">
		    		<div class="durationscroller"></div>
		    	</div>
		    	<div id="audiolength" style="display: none;position: absolute;bottom: 18px;right: 10px;"></div>
		    </li>
		    {%endfor%}
		</ol>
	{%else%}
		<h2 class="navbar navbar-default">
			&#9888; Opps!! No &#9836;Songs in Data Center.
			<br>
			<button class="btn btn-primary btn-lg" onclick="window.open('/uploadsong/','_parent')"><span class="glyphicon glyphicon-plus-sign"></span> Add a Song</button>
		</h2>
	{%endif%}
	<footer style="text-align: center;">
		<a href="" onclick="window.open('/songs/','_parent')">
		    <h2>All Songs</h2>
	    </a>
	</footer>
	<header>
		<nav class="navbar navbar-default">
			<div style="position: absolute;"><span class="glyphicon glyphicon-film"></span>&emsp;Albums</div>
			<div style="position: absolute;right: 20px;">
				<a  onclick="window.open('/createalbum/','_parent')" href="">
					<span class="glyphicon glyphicon-plus"></span> Add Album
				</a>
			</div>
		</nav>
	</header>
	{%if albums%}
	<ul>
	    {%for album in albums%}
	    <li>
	    	<h2 class="mycolor">
	    		<a onclick="window.open('/album/songs/{{album.id}}/','_parent');">
	    		    <span class="glyphicon glyphicon-list"></span> {{album.album_title}}</span>
	    		</a>&emsp;
	    		<span class="glyphicon glyphicon-thumbs-up">{{album.likes}}</span>&emsp;
	    		<span class="glyphicon glyphicon-thumbs-down">{{album.dislikes}}</span>
	    	</h2><br>
	    	<b>Artist:</b> {{album.album_artist}}
	    	<a onclick="window.open('/album/songs/{{album.id}}/','_parent');">
	    		{%if album.album_logo%}<img src="{{album.album_logo.url}}" width="80%">{%else%}
	    		    <img src="{%static 'music/img/background/album.jpg'%}" width="80%">
	    		{%endif%}
	    	</a><br><br>
	    	<div><label>Genre:</label> {{album.album_genre}}</div>
	    	<div><label>Published Date:</label> {{album.published_date}}</div>

	    	<span onclick="window.open('/album/songs/{{album.id}}/','_parent');"><big>
	    		<label class="label label-primary"> See Album</label>
	    	</big></span>
	    </li>
	    {%endfor%}
	</ul>
	{%else%}
	<div>
		<h3 class="navbar bg-info">No Album Records</h3>
		<center><button class="btn btn-success btn-lg" onclick="window.open('/createalbum/','_parent')">
			<span class="glyphicon glyphicon-plus"></span> Create Album <span class="glyphicon glyphicon-film">
			</span></button></center>
	</div>
	{%endif%}
</body>
{%endblock%}
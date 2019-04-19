{%extends 'music/base.php'%}
{%load static%}{%load custom_music_tags%}
{%block link%}
<link rel="stylesheet" type="text/css" href="{% static 'music/css/playlistsongs.css'%}">
<script type="text/javascript" src="{% static 'music/js/albumsongs.js'%}"></script>
{%endblock%}
{%block body%}
<body>
	<header>
		<nav class="navbar navbar-inverse" style="margin: 0px;">
			{%if request.user.is_authenticated%}
			    {%if profile.profile_photo%}
			        <img src="{{profile.profile_photo.url}}" class="pp" onclick="window.open('/tubelight/{{request.user}}/','_self')">
			    {%else%}
			        <img src="{% static 'music/img/profile1.png'%}" class="pp" onclick="window.open('/tubelight/{{request.user}}/','_self')" ></span>
			    {%endif%}
			{%else%}
			   <button class="btn btn-info btn-lg" style="position: absolute;top: 40px;" onclick="window.open('/account/signup/','_self')">Sign Up Now</button>
			{%endif%}
			<h2><a href="/tubelight/">
				<h1><span class="glyphicon glyphicon-headphones"></span> TubeLight Music</h1>
			</a><span class="glyphicon glyphicon-play-circle"></span> My Playlist
			</h2>
		</nav>
		<div>
		{%if playlist.cover%}
		    <img src="{{playlist.cover.url}}">
		{%else%}
		    <img src="{% static 'music/img/background/iphonesong.jpg'%}">
		{%endif%}
	    </div>
		<h2 style="color: purple;"><span class="glyphicon glyphicon-play-circle"></span> {{playlist.name}}</h2>
		{%if playlist.is_favourite%}
		    <div style="position: absolute;top: 50px;right:20px;color: #fff;">
		    	<span class="glyphicon glyphicon-star" style="font-size: 25px;"></span>
		    </div>
		{%endif%}
    </header>

	<section id="songlist">
		<br>
		{%if songs%}
		<h2 class="navbar navbar-default"><span class="glyphicon glyphicon-music"> Playlist&ensp;Songs</h2>
		<audio id="audio"></audio>
		<ol style="padding: 0px;font-weight: bold;">
		    {%for song in songs%}
		    <li class="navbar navbar-default" style="margin:0;padding-bottom: 30px;padding-top: 25px;" id="{{song.id}}">
		    	<p style="position: absolute;top: 0px;right: 30px;font-size: 18px;color: blue;font-weight: normal;" class="glyphicon glyphicon-hand-right"> {{song.song_artist}}
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
			&#9888; Opps!! No &#9836;Songs in Playlist
		</h2>
		{%endif%}
	</section>
	<div style="text-align: center;"><a href="/createplaylist/">
		<button class="btn btn-primary btn-lg" style="margin-top: 5px;">
			<span class="glyphicon glyphicon-plus-sign"></span>
			Create a New&ensp;
			<span class="glyphicon glyphicon-play-circle"></span> Playlist
		</button></a>
		{%ifequal request.user playlist.user%}
		<a href="/playlist/{{playlist.id}}/addsong/">
		<button class="btn btn-warning btn-lg" style="margin-top:5px; ">
			<span class="glyphicon glyphicon-plus-sign"></span>
			Add Songs in&ensp;
			<span class="glyphicon glyphicon-play-circle"></span>
			Playlist
		</button></a>
		{%endifequal%}
	</div>

	<section id="playlists">
		<div class="navbar navbar-default">
			<h3><span class="glyphicon glyphicon-play-circle"></span> Playlists</h3>
		</div>
		{%if playlists%}
		<ul>
		    {%for myplaylist in playlists%}
		    {%ifequal myplaylist.id playlist.id%}
		    {%else%}
			    <li>
			    	<h2 class="mycolor">
			    		<a onclick="window.open('/playlist/{{myplaylist.id}}/songs/','_parent');">
			    		    <span class="glyphicon glyphicon-hand-right"></span> {{myplaylist.name}}</span>
			    		</a>
			    	</h2><br>

			    	<a onclick="window.open('/playlist/{{myplaylist.id}}/songs/','_parent');">
			    		{%if myplaylist.cover%}
			    		    <img src="{{myplaylist.cover.url}}" width="80%">
			    		{%else%}
			    		    <img src="{% static 'music/img/background/iphonesong.jpg'%}" width="80%">
			    		{%endif%}
			    	</a><br><br>
			    	<div><label>Created Date:</label> {{myplaylist.created_date}}</div>

			    	<span onclick="window.open('/playlist/{{myplaylist.id}}/songs/','_parent');"><big>
			    		<label class="label label-primary"> See Playlist</label>
			    	</big></span>
			    </li>
			{%endifequal%}
		    {%endfor%}
		</ul>
		{%endif%}
	</section>
	<footer>
		<span class="glyphicon glyphicon-headphones" style="font-size: 30px;"></span><br>
		{%if not request.user.is_authenticated%}<h2 onclick="window.open('/account/signup/','_self')">Sign Up Now !!</h2>{%endif%}
		<h3>TubeLight Music Station</h3>
		<b>&copy;copyright, 2019</b>
		<br>All Rights Reserved.<br>
		<span class="glyphicon glyphicon-envelope"></span> innovativename05@gmail.com
	</footer>
</body>
{%endblock%}tl
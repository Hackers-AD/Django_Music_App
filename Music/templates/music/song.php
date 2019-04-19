{%extends 'music/base.php'%}
{%load static%}
{%block link%}
<link rel="stylesheet" type="text/css" href="{% static 'music/css/song.css'%}">
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
				<button class="btn btn-primary btn-lg" onclick="window.open('/uploadsong/','_parent')">
					<span class="glyphicon glyphicon-plus-sign"></span> Add a Song
				</button>
		</h2>
	{%endif%}
	<footer style="text-align: center;">
		<a href="/songs/" onclick="window.open('/songs/','_parent')">
		    <h2>All Songs</h2>
	    </a>
	</footer>
</body>
{%endblock%}lt
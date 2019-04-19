{%extends 'music/base.php'%}
{%load static%}
{%block link%}
<link rel="stylesheet" type="text/css" href="{% static 'music/css/myplaylist.css'%}">
<script type="text/javascript" src="{% static 'music/js/myplaylist.js'%}"></script>
{%endblock%}
{%block body%}
<body>
	{%if playlists%}<ul>
	    {%for playlist in playlists%}
	    <li>
	    	<div id="name">
	    		<span onclick="window.open('/playlist/{{playlist.id}}/songs/','_parent')" style="cursor: pointer;">
		    		<span class="glyphicon glyphicon-play-circle"></span>
		    		{{playlist.name}}
	    	    </span>
	    	</div>
	    	{%if playlist.cover%}
	    	    <img src="{{playlist.cover.url}}" class="cover" onclick="window.open('/playlist/{{playlist.id}}/songs/','_parent')">
	    	{%else%}
	    	    <img src="{% static 'music/img/background/iphonesong.jpg'%}" class="cover" onclick="window.open('/playlist/{{playlist.id}}/songs/','_parent')">
	    	{%endif%}
	    	{%if playlist.is_favourite%}
	    	    <div style="position: absolute;left: 48%;top: 20%;color: #fff;font-size: 20px;">
	    	    	<span class="glyphicon glyphicon-star"></span>
	    	    </div>
	    	{%endif%}
	    	<div id="number">({{playlist.song_number}}) Songs</div>
	    	{%ifequal playlist.song_number 0%}
	    	    <a href="/playlist/{{playlist.id}}/addsong/">
	    	    	<span class="glyphicon glyphicon-plus-sign"></span> Add Song
	    	    </a>
	    	{%else%}
	    	    <a href="/playlist/{{playlist.id}}/songs/">
	    	    	<span class="glyphicon glyphicon-eye-open"></span> See Songlist
	    	    </a>
	    	{%endifequal%}
	    </li>	    
	    {%endfor%}</ul>
	    <footer style="text-align: center;"><br><br>
			<button class="btn btn-warning btn-lg" onclick="window.open('/createplaylist/','_parent')">
				<span class="glyphicon glyphicon-plus-sign"></span>
				Create a New &ensp;
				<span class="glyphicon glyphicon-play-circle"></span> Playlist
			</button>
		</footer>
	{%else%}
	    <div style="text-align: center;"><br>
	    	<span class="glyphicon glyphicon-exclamation-sign" style="font-size: 25px;"></span><br>
	    	<label class="label label-warning label-lg">You haven't created any playlist.</label><br><br><br>
	    	<button class="btn btn-primary" onclick="window.open('/createplaylist/','_parent')">
	    		<span class="glyphicon glyphicon-plus-sign"></span> Add a playlist.
	    	</button></a>
	    </div>
	{%endif%}
</body>
{%endblock%}
{%extends 'music/base.php'%}
{%load static%}
{%block link%}
<link rel="stylesheet" type="text/css" href="{% static 'music/css/songs.css'%}">
<script type="text/javascript" src="{% static 'music/js/songs.js'%}"></script>
{%endblock%}
{%block body%}
<body>
	<header>
		<nav class="navbar navbar-inverse" style="margin: 0px;">
			{%if request.user.is_authenticated%}
			    {%if profile.profile_photo%}
			        <img src="{{profile.profile_photo.url}}" class="pp" onclick="window.open('/tubelight/{{request.user}}/','_self')">
			    {%else%}
			        <img src="{% static 'music/img/profile1.png'%}" class="commentimg" onclick="window.open('/tubelight/{{request.user}}/','_self')" ></span>
			    {%endif%}
			{%else%}
			   <button class="btn btn-info btn-lg" style="position: absolute;top: 40px;" onclick="window.open('/account/signup/','_self')">Sign Up Now</button>
			{%endif%}
			<h2><a href="/tubelight/">
				<h1><span class="glyphicon glyphicon-headphones"></span> TubeLight Music</h1>
			</a>Songs
			</h2>
			<h2 id="head-div">
				{% if user.is_authenticated %}
					<a href="/account/message/">
						<img src="{% static 'music/img/ficonblue.png'%}" class="icon-img">
					</a>
					<!--<div class="bell">
					   	<span class="glyphicon glyphicon-bell"></span>
					   	<div id="notfycount"></div>
				    </div>-->
				{% endif %}
			</h2>
		</nav>
	</header>
	<form action="" method="" id="searchform">
		<input type="text" name="searchsong" class="input" placeholder="Type your search.">
	</form>
	<section class="songlist">
	{%if songs%}
		<h2 class="navbar navbar-default"><span class="glyphicon glyphicon-music">&ensp;All&ensp;Songs
		</h2>
		<audio id="audio"></audio>
		<ol>
		    {%for song in songs%}
		    <li class="" id="{{song.id}}">
		    	<p class="glyphicon glyphicon-hand-right" id="artistname"> {{song.song_artist}}	</p>
		    	<div id="songname">{{forloop.counter}}. {{song.song_title}}</div>
		    	<div id="optspan">
		    		<span class="glyphicon glyphicon-play" onclick="PlaySong('{{song.id}}','{{song.song_file.url}}')" id="play"></span>
		    		<span class="glyphicon glyphicon-pause" onclick="PauseSong('{{song.id}}')" id="pause"></span>
		    		<span class="glyphicon glyphicon-volume-up" onclick="VolumeUp('{{song.id}}')" id="volup"></span>
		    		<span class="glyphicon glyphicon-stop" onclick="StopSong('{{song.id}}')" id="stop"></span>
		    		<span class="glyphicon glyphicon-volume-down" onclick="VolumeDown('{{song.id}}')" id="voldown">
		    		</span>
		    		<a href="{{song.song_file.url}}" download="{{song.song_title}}"><span class="glyphicon glyphicon-download" id="download"></span></a>
		    		<span class="glyphicon glyphicon-file" id="file"></span>
		    	</div>
		    	<div class="songfeed">
		    		<span class="glyphicon glyphicon-thumbs-up"> {{song.likes}}</span>
		    		<span class="glyphicon glyphicon-thumbs-down"> {{song.dislikes}}</span>
		    		<span class="glyphicon glyphicon-comment" onclick="ShowCommentForm('{{song.id}}')"></span>
		    	</div>
		    	<center>
			    	<div class="audioline" onclick="SetPlayPoint('{{song.id}}',event)">
			    		<div class="durationscroller"></div>
			    	</div>
		        </center>
		    	<div id="audiolength"></div><div style="width: 100%;"></div>

		    	<form action="" name="commentform" class="commentform" onsubmit="return SongFeed();"><br>
		    		<div id="songreview" style="display: none;">
		    			<button type="submit" name="dislikesong"><span class="glyphicon glyphicon-thumbs-up"></span></button>
		    			<button type="submit" name="likesong"><span class="glyphicon glyphicon-thumbs-down"></span></button>
		    			<span class="glyphicon glyphicon-comment" style="cursor: pointer;" onclick="ShowCommentForm('{{song.id}}')"></span>
		    		</div>
		    		<div id="commentdiv">
						{%if profile.profile_photo%}
						    <img src="{{profile.profile_photo.url}}" class="commentimg">
						{%else%}
						    <img src="{% static 'music/img/profile.png'%}" class="commentimg">
						{%endif%}
						   	<input type="text" name="comment" placeholder="Write a comment.">
							<button type="submit" name="btn-comment" value="{{song.id}}"><span class="glyphicon glyphicon-send"></span></button>
						{%if not request.user.is_authenticated%}
				            <br><label class="label label-danger">* You must login to comment.</label><br>
			            {%endif%}
		            </div>
			    </form>
		    </li>
		    {%endfor%}
		</ol>
	{%else%}

	{%endif%}
    </section>
</body>
{%endblock%}lt
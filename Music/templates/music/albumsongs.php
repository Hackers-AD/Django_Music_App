{%extends 'music/base.php'%}
{%load static%}{%load custom_music_tags%}
{%block link%}
<link rel="stylesheet" type="text/css" href="{% static 'music/css/albumsongs.css'%}">
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
			</a><span class="glyphicon glyphicon-film"></span> Albums
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
		{%if album.album_logo%}
		    <img src="{{album.album_logo.url}}">
	    {%else%}
	        <img src="{%static 'music/img/background/album.jpg'%}">
		{%endif%}
		<h2><span class="glyphicon glyphicon-film"></span> {{album.album_title}}</h2>
		<div id="albuminfo">
			<h1><span class="glyphicon glyphicon-info-sign"></span></h1>
			<ul>
				<li>Genre: {{album.album_genre}}</li>
				<li>Published Date: {{album.published_date}}</li>
				<li>Album Title: {{album.album_artist}}</li>
			</ul>
			<ul class="likedislike">
				<form action="" method="" style="margin: 0;">
			    <li>
			    	<button type="submit" name="like" value="likes"><span class="glyphicon glyphicon-thumbs-up"></span></button><br>
			    	{{album.likes}} <b>Likes</b>
			    </li>
			    <li>
			    	<button type="submit" name="dislikes" value="dislikes"><span class="glyphicon glyphicon-thumbs-down"></span></button><br>
			    	{{album.dislikes}} <b>Dislikes</b>
			    </li>
			    </form>
			</ul>
		</div>
    </header>
	<audio id="audio"></audio>
	<section id="songlist">
		<br>
		{%if songs%}
		<h2 class="navbar navbar-default"><span class="glyphicon glyphicon-music"> Album&ensp;Songs</h2>
			<form>
				{%if profile.profile_photo%}
				   <img src="{{profile.profile_photo.url}}" class="commentimg">
				{%else%}
				   <img src="{% static 'music/img/profile.png'%}" class="commentimg">
				{%endif%}
				<input type="text" name="comment" placeholder="Write a comment.">
				<button type="submit" name="btn-comment"><span class="glyphicon glyphicon-send"></span></button>
				{%if not request.user.is_authenticated%}
				<br><label class="label label-danger">* You must login to comment.</label>
				{%endif%}
			</form><br>
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
			&#9888; Opps!! No &#9836;Songs in Album
		</h2>
		{%endif%}
	</section>
	<div style="text-align: center;"><a href="/createalbum/">
		<button class="btn btn-primary btn-lg" style="margin-top: 5px;">
			<span class="glyphicon glyphicon-plus-sign"></span>
			Create a New&ensp;
			<span class="glyphicon glyphicon-film"></span> Album
		</button></a>
		{%ifequal request.user album.user%}
		<a href="/album/{{album.id}}/addsong/">
		<button class="btn btn-warning btn-lg" style="margin-top:5px; ">
			<span class="glyphicon glyphicon-plus-sign"></span>
			Add a Song in&ensp;
			<span class="glyphicon glyphicon-film"></span>
			Album
		</button></a>
		{%else%}
		    {%ifequal album.user.id "1"%}
		        <a href="/album/{{album.id}}/addsong/">
				<button class="btn btn-warning btn-lg" style="margin-top:5px; ">
					<span class="glyphicon glyphicon-plus-sign"></span>
					Add a Song in&ensp;
					<span class="glyphicon glyphicon-film"></span>
					Album
				</button></a>
		    {%endifequal%}
		{%endifequal%}
	</div>
	<section id="usercomments">
		<section id="songlist">
			<form>
				{%if profile.profile_photo%}
				   <img src="{{profile.profile_photo.url}}" class="commentimg">
				{%else%}
				   <img src="{% static 'music/img/profile.png'%}" class="commentimg">
				{%endif%}
				<input type="text" name="comment" placeholder="Write a comment.">
				<button type="submit" name="btn-comment"><span class="glyphicon glyphicon-send"></span></button>
				{%if not request.user.is_authenticated%}
				<br><label class="label label-danger">* You must login to comment.</label>
				{%endif%}
			</form><br>
		</section>
		{%if comments%}
		<h2 class="navbar navbar-default" style="color: black;"><span class="glyphicon glyphicon-comment"> Album&ensp;Comments !!</span></h2>
		<ul>
			{%for comment in comments reversed%}
			<li>
				{%if comment.user|has_profile_photo:"yesno"%}
				    {%for userprofile in profiles%}
				        {%ifequal userprofile.user comment.user%}
				            <img src="{{userprofile.profile_photo.url}}" class="commentimg">
				        {%endifequal%}
				    {%endfor%}
			    {%else%}
			        <img src="{% static 'music/img/profile.png'%}" class="commentimg">
			    {%endif%}
			    {%for userprofile in profiles%}
				    {%ifequal userprofile.user comment.user%}
				        <b style="cursor: pointer;">{{userprofile.user}}</b>
				    {%endifequal%}
				{%endfor%}
			    <span style="margin-left: 15px;">
				    {%if comment.comment%}<p style="margin-left: 50px;">{{comment.comment}}</p>{%endif%}
				    {%if comment.image%}<img src="{{comment.image.url}}" class="commentpic">{%endif%}
				    {%if comment.file%}<a href="{{comment.file.url}}" download="{{comment.file}}" style="margin-left: 50px;">{{comment.file.url}}</a>{%endif%}
			    </span>
			</li>
			{%endfor%}
		</ul>
		{%endif%}
	</section>
	<section id="albums">
		<div class="navbar navbar-default">
			<h3><span class="glyphicon glyphicon-film"></span> Albums</h3>
		</div>
		{%if albums%}
		<ul>
		    {%for albumx in albums%}
		        {%ifequal albumx.id album.id%}
		        {%else%}
				    <li>
				    	<h2 class="mycolor">
				    		<a onclick="window.open('/album/songs/{{albumx.id}}/','_parent');">
				    		    <span class="glyphicon glyphicon-list"></span> {{albumx.album_title}}</span>
				    		</a>
				    	</h2><br>

				    	<a onclick="window.open('/album/songs/{{albumx.id}}/','_parent');">
				    		{%if albumx.album_logo%}
				    		    <img src="{{albumx.album_logo.url}}" width="80%">
				    		{%else%}
	    		                <img src="{%static 'music/img/background/album.jpg'%}" width="80%">
	    	            	{%endif%}
				    	</a><br><br>
				    	<div><label>Genre:</label> {{albumx.album_genre}}</div>
				    	<div><label>Published Date:</label> {{albumx.published_date}}</div>

				    	<span onclick="window.open('/album/songs/{{albumx.id}}/','_parent');"><big>
				    		<label class="label label-primary"> See Album</label>
				    	</big></span>
				    </li>
		         {%endifequal%}
		    {%endfor%}
		</ul>
		{%else%}
		<div>
			<center><h3>No Album Records</h3></center>
			<center><button class="btn btn-success">
				<span class="glyphicon glyphicon-plus"></span> Create Album <span class="glyphicon glyphicon-film">
				</span></button></center>
		</div>
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
	<script type="text/javascript">
		
	</script>
</body>
{%endblock%}
{%extends 'music/base.php'%}
{%load static%}{%load custom_music_tags%}
{%block link%}
<link rel="stylesheet" type="text/css" href="{% static 'music/css/albumaddsong.css'%}">
<script type="text/javascript" src="{% static 'music/js/albumaddsong.js'%}"></script>
<script type="text/javascript">
	function ShowSongs(argument) {
		if (argument.value=="Only Album Songs") {
			list=document.getElementsByTagName('li');
			for (var i = 0; i < list.length; i++) {
				input=list[i].getElementsByTagName('input');
				console.log(input[0].value);
				if (input[0].id=='unchecked') {
					list[i].style.display="none";
				}
				else{
					list[i].style.display="flex";
				}
			}			
		}
		if (argument.value=="Only Songs not in Album") {
			list=document.getElementsByTagName('li');
			for (var i = 0; i < list.length; i++) {
				input=list[i].getElementsByTagName('input');
				console.log(input[0].value);
				if (input[0].id=='checked') {
					list[i].style.display="none";
				}
				else{
					list[i].style.display="flex";
				}
			}			
		}
		if (argument.value=="All Songs") {
			list=document.getElementsByTagName('li');
			for (var i = 0; i < list.length; i++) {
				list[i].style.display="flex";
			}			
		}
	}
</script>
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
			<span class="glyphicon glyphicon-film"></span>
			<span class="glyphicon glyphicon-plus-sign"></span>
			<span class="glyphicon glyphicon-music"></span><br>
			<span class="glyphicon glyphicon-arrow-down"></span><br>
			<b style="color: #340000">{{album.album_title}}</b>
	    </div>
	    {%if profile.profile_photo%}
			<img src="{{profile.profile_photo.url}}" class="pp" onclick="window.open('/tubelight/{{request.user}}/','_self')">
	    {%endif%}
	</header>
	<div class="navbar navbar-default">
		<h3><span class="glyphicon glyphicon-plus-sign"></span> Add Song In Album</h3>
	</div>
	<p id="addsonginfo"></p>
	<select style="float: right;border: 1px solid grey;border-radius: 4px 4px;" onchange="ShowSongs(this)">
		<option>All Songs</option>
		<option>Only Album Songs</option>
		<option>Only Songs not in Album</option>
	</select>
	{%if albumacess%}
	    <section id="addsong"><ol>
	    	{%for song in songs%}
	    	<form action="" method="post">{%csrf_token%}
	    		<li id="listdiv" class="navbar navbar-default" style="margin: 0px;padding: 20px 10px;" >
	    		{%if song|is_in_album:album_id%}
			    	<span id="songname">{{forloop.counter}}. {{song.song_title}}</span>
			    	<span id="artistname">{{song.song_artist}}</span>
			    	<span id="checkform">
			    		<input type="checkbox" name="checked" checked="" id="checked" style="display: none;">&emsp;
					    <button type="submit" name="trash" value="{{song.id}}" style="border: none;">
					    	<span class="glyphicon glyphicon-trash" style="color: crimson;"></span>
					    </button>
			    	</span>
			    {%else%}
			        <span id="songname">{{forloop.counter}}. {{song.song_title}}</span>
		    	    <span id="artistname">{{song.song_artist}}</span>
		    	    <span id="checkform">
		    	        <input type="checkbox" name="checked" id="unchecked">&emsp;
			            <button type="submit" name="addsong" value="{{song.id}}" style="border: none;">
			    		    <span class="glyphicon glyphicon-check" style="color: blue;"></span>
			    	    </button>	    	    	
		    	    </span>
			    {%endif%}
	    	    </li>
	    	</form>
	    	{%endfor%}<ol>
	    </section>
	    <br><br>
	    <center>
	    <a href=""><button class="btn btn-primary btn-lg">
	    	<span class="glyphicon glyphicon-refresh"></span> Refresh Songs
	    </button></a>
	    </center>
	{%else%}
	  <center>You have no permission to add a song to this Album.</center>
	{%endif%}
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

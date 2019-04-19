{%extends 'music/base.php'%}
{%load static%}
{%block link%}
<link rel="stylesheet" type="text/css" href="{% static 'music/css/album.css'%}">
<link rel="stylesheet" type="text/css" href="{% static 'music/css/image_animation.css'%}">
<script type="text/javascript" src="{% static 'music/js/album.js'%}"></script>
{%endblock%}
{%block body%}
<body>
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
	    		</a>
	    	</h2><br>

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
		<center>
			<a href="/createalbum/">
				<button class="btn btn-success btn-lg" onclick="window.open('/createalbum/','_parent')">
			        <span class="glyphicon glyphicon-plus"></span> Create Album <span class="glyphicon glyphicon-film">
			        </span>
			    </button>
			</a>
			</center>
	</div>
	{%endif%}
</body>
{%endblock%}
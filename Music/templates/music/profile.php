{%extends 'music/base.php'%}
{%load static%}
{%block link%}
<link rel="stylesheet" type="text/css" href="{% static 'music/css/profile.css'%}">
<link rel="stylesheet" type="text/css" href="{% static 'music/css/image_animation.css'%}">
<script type="text/javascript" src="{% static 'music/js/profile.js'%}"></script>
{%endblock%}
{%block body%}
<body onresize="RefreshFrame()">
  <div>
  	<h1 class="navbar bg-info" style="margin: 0px;cursor: default;">{{request.user}}</h1>
	<h2 class="navbar bg-info" id="head-div">
		<div class="bell">
			<a href="/tubelight/">
			<!--<img src="{% static 'music/img/music.png'%}" class="icon-img">-->
			<span class="glyphicon glyphicon-music"></span>
		    </a>
		</div>
		{% if user.is_authenticated %}
			<a href="/account/message/"><img src="{% static 'music/img/ficonblack.png'%}" class="icon-img"></a>
			<div class="bell">
			   	<span class="glyphicon glyphicon-bell"></span>
			   	<div id="notfycount"></div>
		    </div>
		{% endif %}
	</h2>
	<header>
	    <div id="pic">
		    <a href="">
		        {%if profile.cover_photo%}
		        <img class="cp" src="{{profile.cover_photo.url}}" alt="Cover Pic">
		        {%else%}
		        <img class="cp" src="{%static 'music/img/background/lovemusic.jpg'%}" alt="Cover Pic">
		        {%endif%}
		    </a>

		    <p class="">
		        <a href="">
		            {%if profile.profile_photo%}
		                <img class="pp" src="{{profile.profile_photo.url}}"  alt="Profile Pic">
		            {%else%}
		                <img class="pp" src="{%static 'music/img/profile.png'%}" alt="Profile Pic">
		           {%endif%}
		        </a>
		    </p>
	    </div>
	        <form action="" method="post" enctype="multipart/form-data">{%csrf_token%}
	        	<input type="file" name="cp" id="cp" style="display: none;" accept="image/*" onchange="PreviewCoverImage(event)">
	        	<label for="cp">
	        		<div class="btn btn-primary" id="changecp">&#9998; Change Cover Picture</div>
	        	</label>

	        	<input type="file" name="pp" id="pp" style="display: none;" accept="image/*" onchange="PreviewProfileImage(event)">
		        <label for="pp">
		        	<div class="btn btn-success" id="changepp">&#9998; Change Profile Picture</div>
		        </label>
		        <button type="submit" name="change" class="btn btn-warning" id="savebutton">
		        	<span class="glyphicon glyphicon-save"></span> Save Changes
		        </button>
		        <div class="btn btn-primary" id="editbutton">
		        	<span class="glyphicon glyphicon-edit"></span> Edit Photo
		        </div>
		        <a href="">
		        	<div class="btn btn-danger" id="cancelbutton">
		        		<span class="glyphicon glyphicon-remove"></span> Cancel
		        	</div>
		        </a>
	        </form>
	    <div id="setnote">
	    	<ul>
	    		<li onclick="window.open('/settings/','_self');"><span class="glyphicon glyphicon-cog"></span> Settings</li>
	    		<li onclick=""><span class="glyphicon glyphicon-bell"></span> Notifications</li>
	    		<li onclick="window.open('/account/message/','_self');"><span class="glyphicon glyphicon-envelope"></span> Messages</li>
	    	</ul>
	    </div>
	    <button id="menu-option" onclick="ShowInfo()"><span class="glyphicon glyphicon-menu-hamburger"></span></button>
	    <div id="info">
		    <h3><span class="glyphicon glyphicon-globe"></span> Intro</h3>
		    <ul>
		        <li><span class="glyphicon glyphicon-user"></span> {{request.user.username}}</li>
		        <li><span class="glyphicon glyphicon-envelope"></span> {{request.user.email}}</li>
		        {%if profile.birth_date%}
		        <li>
		        	<span class="glyphicon glyphicon-time"></span>
		        	Born on {{profile.birth_date}}
		        </li>
		        {%endif%}
		        {%if profile.temporary_address%}
		        <li>
		        	<span class="glyphicon glyphicon-map-marker"></span>
		            Lives in {{profile.temporary_address}}
		        </li>
		        {%endif%}
		        {%if profile.permanent_address%}
		        <li>
		        	<span class="glyphicon glyphicon-home"></span>
		        	Home Town is in {{profile.permanent_address}}
		        </li>
		        {%endif%}
		        {%if profile.education_degree%}
		        <li>
		        	<span class="glyphicon glyphicon-education"></span>
		        	Studied {{profile.education_degree}}
		        </li>
		        {%endif%}
		        {%if profile.nick_name%}<li>Nick Name is {{profile.nick_name}}</li>{%endif%}
		        {%if profile.country%}
		        <li>
		        	<span class="glyphicon glyphicon-globe"></span>
		        	From {{profile.country}}
		        </li>
		        {%endif%}
		        {%if profile.religion%}
		        <li>
		        	Religion View is {{profile.religion}}
		        </li>
		        {%endif%}
		        {%if profile.language_known%}
		        <li>
		        	Languages Known {{profile.language_known}}
		        </li>
		        {%endif%}
		        {%if profile.interested_in%}
		        <li>
		        	<span class="glyphicon glyphicon-heart"></span>
		        	Interested In {{profile.interested_in}}
		        </li>
		        {%endif%}
		    </ul>
		    <br><br>
		    <a href="/profile/edit/"><button class="btn btn-secondary">
		    	<span class="glyphicon glyphicon-pencil"></span>  Edit Profile
		    </button></a>
		    <br><br>
		</div>
    </header>
    <div style="margin-left: 15px;">
    	{%if profile.about_you%}
    	<h4>
    		<span class="glyphicon glyphicon-info-sign"></span>
    		About <a href="" style="text-transform: uppercase;text-decoration: none;">
    		{{request.user.username}}</a>
    	</h4>
    	<p style="margin-left: 20px;">{{profile.about_you}}</p>
    	{%endif%}
    </div>

    <section><br>
    	<div class="navbar navbar-default">
    		<ul class="menubar">
    			<li onclick="MenuClicked('album')"><span class="glyphicon glyphicon-film"></span> My Albums</li>
    			<li onclick="MenuClicked('likedsong')"><span class="glyphicon glyphicon-heart"></span> Liked Songs</li>
    			<li onclick="MenuClicked('playlist')"><span class="glyphicon glyphicon-play-circle"></span> My Playlists</li>
    		</ul>
    	</div>
    </section>
    <section id="frame">
    	<iframe src="/songlist/{{request.user}}/album/" id="album" frameborder="0" onload="this.style.height = 0;this.style.height=(contentWindow.document.body.scrollHeight + 15) + 'px';" scrolling="no"></iframe>
    	<iframe src="/songlist/{{request.user}}/likedsong/" id="likedsong" frameborder="0" onload="this.style.height = 0;this.style.height=(contentWindow.document.body.scrollHeight + 15) + 'px';" scrolling="no"></iframe>
    	<iframe src="/songlist/{{request.user}}/playlist/" id="playlist" frameborder="0" onload="this.style.height = 0;this.style.height=(contentWindow.document.body.scrollHeight + 15) + 'px';" scrolling="no"></iframe>
    </section>
    <h3 id="info"></h3>
    <section id="image-animation">
    	<div id="container">
		    <img src="http://imaging.nikon.com/lineup/dslr/df/img/sample/img_01.jpg">
		    <img src="http://imaging.nikon.com/lineup/dslr/df/img/sample/img_02.jpg">
		    <img src="http://imaging.nikon.com/lineup/dslr/df/img/sample/img_03.jpg">
		    <img src="http://imaging.nikon.com/lineup/dslr/df/img/sample/img_04.jpg">
		</div>
		<div id="animation-info">
			<span class="glyphicon glyphicon-headphones"></span> Music Background Animation
		</div>
		<br>
		<div>
			<center>
			    <a href="/createplaylist/">
				    <button class="btn btn-info">
					    <span class="glyphicon glyphicon-plus"></span> Create New Playlist
				    </button>
				</a>
			</center>
		</div>
    </section>
    <footer>
		<ul>
			<li>Terms of Use</li>
			<li>Privacy Policy</li>
			<li>Feedback</li>
			<li>Report an Issue</li>
			<li>FAQs</li>
		</ul>
		<center><br>
			<h2>&#x266C;</h2>
			&copy;TubeLight Music 2019, All Rights Reserved.
		</center>
	</footer>
</div>
</body>
{%endblock%}
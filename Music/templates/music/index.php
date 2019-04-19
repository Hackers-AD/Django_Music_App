{%extends 'music/base.php'%}
{%load static%}{%load custom_music_tags%}
{%block link%}
<meta name="google-site-verification" content="8THkPagRYCiU6H4EkMV-MSJ2xTt4R08Uyp-CyuAsgYw" />
<link rel="stylesheet" type="text/css" href="{% static 'music/css/index.css'%}">
<script type="text/javascript" src="{% static 'music/js/index.js'%}"></script>
{%endblock%}
{%block body%}
<body onresize="RefreshFrame()" id="body" onload="Display()">
	<header id="header">
		<center>
			{% if msgs %}
			    {% for msg in msgs %}
			        <li style="background: #fff;padding: 10px 0px"><b style="color: green;">{{msg}}</b></li>
			    {% endfor %}
			{% endif %}
		</center>
		<div id="head-one">
			{% if user.is_authenticated %}
			    <a href="/account/message/"><img src="{% static 'music/img/ficonblue.png'%}" class="msg"></a>
			    <div class="bell">
			    	<span class="glyphicon glyphicon-bell" onclick="ShowNotify(event);"></span>
			    	<div class="notifycount"><note>{{notifycount}}</note></div>
			    </div>
			{% endif %}
			<ul class="menulist">
				<li><a href="">Home</a></li>
				<li><a href="">Music</a></li>
				<li><a href="">Developer</a></li>
			</ul>

			<div id="floatDivOne">
				<br>
				<h2 style="cursor: pointer;">♬ TubeLight Music Station</h2>
				<p>&emsp;&emsp;&emsp;Listen to your favourite music, Download and Share with friends.</p>
			</div>
			<div id="floatDivTwo">
				{% if user.is_authenticated %}
				    <p>Welcome, {{ request.user.username }}. Thanks for logging in.</p>
				    <a href="/tubelight/{{request.user.username}}/"><button class="btn btn-primary">Show Profile</button></a>
				    <a href="/account/logout/"><button class="btn btn-primary">Log Out</button></a><br><br>
				{% else %}
				    <p>Welcome. Please log in.</p>
				    <a href="/account/signup/"><button class="btn btn-primary">Sign Up</button></a>
				    <a href="/account/login/"><button class="btn btn-success">Log In</button></a>
				{% endif %}
			</div>
			<div id="floatDivThree">
				<h4>Sign Up for free.</h4>
				<h3>&emsp; &#127911;</h3>Get Connected.
			</div>
			<div class="changecover">
		        <div class="circle-focused" id="c-one" onclick="nextCover('1')"></div>
		        <div class="circle-unfocused" id="c-two" onclick="nextCover('2')"></div>
		        <div class="circle-unfocused" id="c-three" onclick="nextCover('3')"></div>
	        </div>
	    </div>
	    <div id="head-two">
			{% if user.is_authenticated %}
			    <a href="/account/message/"><img src="{% static 'music/img/ficonblue.png'%}" class="msg"></a>
			    <div class="bell">
			    	<span class="glyphicon glyphicon-bell"></span>
			    	<div class="notifycount"><note>{{notifycount}}</note></div>
			    </div>
			{% endif %}
			<ul class="menulist">
				<li><a href="">Home</a></li>
				<li><a href="">Music</a></li>
				<li><a href="">Developer</a></li>
			</ul>

			<div id="floatDivOne">
				<br>
				<h3 style="cursor: pointer;">♬ TubeLight Music Station</h3>
				<p>&emsp;&emsp;&emsp;Listen to your favourite music, Download and Share with friends.</p>
			</div>
			<div id="floatDivTwo">
				{% if user.is_authenticated %}
				    <p>Welcome, {{ request.user.username }}. Thanks for logging in.</p>
				    <a href="/tubelight/{{request.user.username}}/"><button class="btn btn-primary">Show Profile</button></a>
				    <a href="/account/logout/"><button class="btn btn-primary">Log Out</button></a><br><br>
				{% else %}
				    <p>Welcome. Please log in.</p>
				    <a href="/account/signup/"><button class="btn btn-primary">Sign Up</button></a>
				    <a href="/account/login/"><button class="btn btn-success">Log In</button></a>
				{% endif %}
			</div>
			<div id="floatDivThree">
				<h4>Sign Up for free.</h4>
				<h3>&emsp; &#127911;</h3>Get Connected.
			</div>
			<div class="changecover">
		        <div class="circle-unfocused" id="c-one" onclick="nextCover('1')"></div>
		        <div class="circle-focused" id="c-two" onclick="nextCover('2')"></div>
		        <div class="circle-unfocused" id="c-three" onclick="nextCover('3')"></div>
	        </div>
	    </div>
	    <div id="head-three">
			{% if user.is_authenticated %}
			    <a href="/account/message/"><img src="{% static 'music/img/ficonblue.png'%}" class="msg"></a>
			    <div class="bell">
			    	<span class="glyphicon glyphicon-bell"></span>
			    	<div class="notifycount"><note>{{notifycount}}</note></div>
			    </div>
			{% endif %}
			<ul class="menulist">
				<li><a href="">Home</a></li>
				<li><a href="">Music</a></li>
				<li><a href="">Developer</a></li>
			</ul>

			<div id="floatDivOne">
				<br>
				<h3 style="cursor: pointer;">♬ TubeLight Music Station</h3>
				<p>&emsp;&emsp;&emsp;Listen to your favourite music, Download and Share with friends.</p>
			</div>
			<div id="floatDivTwo">
				{% if user.is_authenticated %}
				    <p>Welcome, {{ request.user.username }}. Thanks for logging in.</p>
				    <a href="/tubelight/{{request.user.username}}/"><button class="btn btn-primary">Show Profile</button></a>
				    <a href="/account/logout/"><button class="btn btn-primary">Log Out</button></a><br><br>
				{% else %}
				    <p>Welcome. Please log in.</p>
				    <a href="/account/signup/"><button class="btn btn-primary">Sign Up</button></a>
				    <a href="/account/login/"><button class="btn btn-success">Log In</button></a>
				{% endif %}
			</div>
			<div id="floatDivThree">
				<h4>Sign Up for free.</h4>
				<h3>&emsp; &#127911;</h3>Get Connected.
			</div>
			<div class="changecover">
		        <div class="circle-unfocused" id="c-one" onclick="nextCover('1')"></div>
		        <div class="circle-unfocused" id="c-two" onclick="nextCover('2')"></div>
		        <div class="circle-focused" id="c-three" onclick="nextCover('3')"></div>
	        </div>
	    </div>
	    
	</header>
	<div class="notifydiv">
		<div class="closenotify"><span onclick="CloseNotify()">&times;</span></div>
		<center><h1><span class="glyphicon glyphicon-bell"></span> Notifications</h1></center>
	    <iframe  src="http://www.fb.com/" class="notify" scrolling="no" onload="this.style.height = 0;this.style.height=(contentWindow.document.body.scrollHeight + 15) + 'px';" frameborder="0"></iframe>
	</div>
	<section id="searchbar">
		<form>
			<input type="text" name="search" placeholder="&#128270; TubeLight music search">
		</form>
	</section>
	<section class="index-song">
		<div id="menu" class="navbar bg-info">
			<ul>
				<li onclick="MenuClicked('trend')"><span class="glyphicon glyphicon-fire"></span> Trending</li>
				<li onclick="MenuClicked('album')"><span class="glyphicon glyphicon-film"></span> Albums</li>
				<li onclick="MenuClicked('artist')"><span class="glyphicon glyphicon-user"></span> Artist</li>
				<li onclick="MenuClicked('song')"><span class="glyphicon glyphicon-music"></span> Songs</li>
				<li onclick="MenuClicked('lyric')"><span class="glyphicon glyphicon-file"></span> Lyrics</li>
			</ul>
		</div>
    </section>
    <section id="frame">
    	<iframe src="/songlist/album/" id="album" frameborder="0" onload="this.style.height = 0;this.style.height=(contentWindow.document.body.scrollHeight + 15) + 'px';" scrolling="no" onresize="RefreshFrame('album')"></iframe>
    	<iframe src="/songlist/trending/" id="trending" frameborder="0" onload="this.style.height = 0;this.style.height=(contentWindow.document.body.scrollHeight + 15) + 'px';" scrolling="no" onresize="RefreshFrame('trending')"></iframe>
    	<iframe src="/songlist/artist/" id="artist" frameborder="0" onload="this.style.height = 0;this.style.height=(contentWindow.document.body.scrollHeight + 15) + 'px';" scrolling="no" onresize="RefreshFrame('artist')"></iframe>
    	<iframe src="/songlist/song/" id="song" frameborder="0" onload="this.style.height = 0;this.style.height=(contentWindow.document.body.scrollHeight + 15) + 'px';" scrolling="no" onresize="RefreshFrame('song')"></iframe>
    	<iframe src="/songlist/lyric/" id="lyric" frameborder="0" onload="this.style.height = 0;this.style.height=(contentWindow.document.body.scrollHeight + 15) + 'px';" scrolling="no" onresize="RefreshFrame('lyric')"></iframe>
    </section>
    <section id="song-upload">
    </section>
    <section id="add-album">
    </section>
    <section id="song-des">
    	<div >
    		<a href="/uploadsong/">
    			<button class="btn btn-warning" id="addsong">
    			    <span class="glyphicon glyphicon-plus"></span> Upload&emsp;
    			    <span class="glyphicon glyphicon-music"></span> Song
    		    </button>
    		</a>
    		<a href="/createalbum/">
    			<button class="btn btn-primary " id="addalbum">
    			    <span class="glyphicon glyphicon-plus"></span> Create&emsp;
    			    <span class="glyphicon glyphicon-film"></span> Album
    		    </button>
    	    </a>
    		<img src="{%static 'music/img/background/perfect.jpg'%}" width="90%">
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
		<ul>
			<tl>About Us</li>
			<li>E-mail: innovateme05@gmail.com</li>
		</ul>
		<ul id="social-media">
			<h5>Follow Us</h5>
			<li><img src="{% static 'music/img/facebook.png'%}" width="30"><br>Facebook</li>
			<li><img src="{% static 'music/img/instagram.png'%}" width="30"><br>Instagram</li>
			<li><img src="{% static 'music/img/twitter.png'%}" width="30"><br>Twitter</li>
		</ul>
		<center>
			<br><h2>&#x266C;</h2>
			&copy;TubeLight Music 2019, All Rights Reserved.
		</center>
	</footer>
</body>
{%endblock%}
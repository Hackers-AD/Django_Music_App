{%extends 'music/base.php'%}
{%load static%}
{%block link%}
<link rel="stylesheet" type="text/css" href="{% static 'music/css/songinfo.css'%}">
<script type="text/javascript" src="{% static 'music/js/songinfo.js'%}"></script>
{%endblock%}
{%block body%}
<body>
	{%if song%}
	    <div class="song-cover">
	    	<audio src="{{song.song_file.url}}" controls="controls">Browser Doesnot Support Audio File.</audio>
	    </div>
	{%endif%}
</body>
{%endblock%}
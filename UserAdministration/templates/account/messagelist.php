{%extends 'account/base.php'%}
{%load static%}
{%block link%}
<link rel="stylesheet" type="text/css" href="{% static 'account/css/messagelist.css'%}">
<script type="text/javascript" src="{% static 'account/js/messagelist.js'%}"></script>
{%endblock%}
{%block body%}
<body>
	<header>
		<nav class="navbar navbar-inverse" style="margin:0;border-radius: 0;">
			<ul class="message-menu">
				<li>
					<a href="/tubelight/{{request.user}}/">
					{%if profile.profile_photo%}
						<img src="{{profile.profile_photo.url}}">				
					{%else%}
						<img src="{%static 'music/img/profile.png'%}">
					{%endif%}
					</a>
				</li>
				<li onclick="window.open('/account/message/','_self')"><img src="{%static 'account/img/ficonblue.png'%}" style="border:none"></li>
				<li onclick="window.open('/account/addfriend/','_self')"><img src="{%static 'account/img/friendadd.png'%}"></li>
			</ul>
		</nav>
	</header>
	{%if order_msg%}
	<ul class="msglist">
		{%for msg in order_msg%}
		<li onclick="window.open('/account/message/{{msg.friends}}','_self')">
		{%for profile in profiles%}
		    {%ifequal profile.user.id msg.friends%}
			    {%if profile.profile_photo%}
			        <img src="{{profile.profile_photo.url}}" class="pp">
			    {%else%}
			        <img src="{% static 'account/img/profile.png'%}" class="pp">
			    {%endif%}
			    &emsp;<label>{{profile.user.username}}</label>
			    {%for user in trackusers%}
			        {%ifequal user.user.id msg.friends%}
			            {%if user.is_online%}
			                <div class="circle"></div>
			            {%else%}
			                <div class="offline"></div>
			            {%endif%}
			        {%endifequal%}
			    {%endfor%} 
		    {%endifequal%}
		{%endfor%}
		<div style="margin-left: 50px">
			{%for con in last_con%}
			    {%ifequal con.user.friends msg.friends%}
				    {%ifequal con.sent '&#128077;'%}
				        <span class="glyphicon glyphicon-thumbs-up"></span>
				    {%else%}
				        {{con.sent}}
			        {%endifequal%}

			        {%ifequal con.received '&#128077;'%}
			            <span class="glyphicon glyphicon-thumbs-up"></span>
				    {%else%}
				        {{con.received}}
			        {%endifequal%}

			        {%if con.sent_pic%}
				        Sent Photo.
			        {%endif%}

			        {%if con.received_pic%}
				        Received Photo
			        {%endif%}

			        {%if con.sent_file%}
				        Sent File.
			        {%endif%}

			        {%if con.received_file%}
				        Received File.
			        {%endif%}

			    {%endifequal%}
			{%endfor%}
	    </div>
		</li>
		{%endfor%}
	</ul>
	{%endif%}
</body>
{%endblock%}
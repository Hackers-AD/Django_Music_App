{%extends 'account/base.php'%}
{%load static%}
{%block link%}
<link rel="stylesheet" type="text/css" href="{% static 'account/css/conversation.css'%}">
<script type="text/javascript" src="{% static 'account/js/conversation.js'%}"></script>
<meta http-equiv="refresh" content="">
{%endblock%}
{%block body%}
<body>
	<header>
		<nav class="">
			<label class="label label-success" style="padding: 4px 4px;">
				<span class="glyphicon glyphicon-user"></span>
				{{senderprofile.user.username}} and {{receiverprofile.user.username}}
			</label>
		</nav>
	</header>
	<section>
	{%if conversations%}<ul class="msglist">
	    {%for conversation in conversations reversed%}
	    <li>
	    	{%if conversation.sent or conversation.sent_pic or conversation.sent_file%}
		    <div id="leftdiv">
		    	{%if senderprofile.profile_photo%}
		    	<img src="{{senderprofile.profile_photo.url}}" class="pp">
		    	{%else%}
		    	<span class="glyphicon glyphicon-user" style="font-size: 30px;"></span>
		    	{%endif%}
		    	{%if conversation.sent%}
		    	    {%ifequal conversation.sent '&#128077;'%}
			    	    &emsp;<span class="glyphicon glyphicon-thumbs-up" style="font-size: 20px;color: blue;"></span>
			    	{%else%}
			    	    <span style="padding-left: 10px;">{{conversation.sent}}</span>
		    	    {%endifequal%}
		    	{%endif%}
		    	{%if conversation.sent_pic%}
		    	    <img src="{{conversation.sent_pic.url}}" alt="" class="msgimage" onclick="window.open('/account/msgimage/{{conversation.id}}/{{msg_id}}/','_parent','');">
		    	{%endif%}
		    	{%if conversation.sent_file%}
		    	    <label class="label label-primary" onclick="window.open('/account/msgimage/{{conversation.id}}/{{msg_id}}/','_parent','');">File Sent</label>
		    	{%endif%}<br>
		    </div>
		    {%endif%}

		    {%if conversation.received or conversation.received_pic or conversation.received_file%}
		    <div id="rightdiv">
		    	{%if conversation.received_pic%}
		    	    <img src="{{conversation.received_pic.url}}" alt="" class="msgimage" onclick="window.open('/account/msgimage/{{conversation.id}}/{{msg_id}}/','_parent','');">
		    	{%endif%}

		    	{%if conversation.received_file%}
		    	    <label class="label label-primary" onclick="window.open('/account/msgimage/{{conversation.id}}/{{msg_id}}/','_parent','');">File Received</label>
		    	{%endif%}

		    	{%if conversation.received%}
		    	    {%ifequal conversation.received '&#128077;'%}
			    	    <span class="glyphicon glyphicon-thumbs-up" style="font-size: 20px;color: blue;"></span>
			    	    &emsp;
			    	{%else%}
			    	     <span style="padding-right: 10px;">{{conversation.received}}</span>
			    	    </label>
		    	    {%endifequal%}
		    	{%endif%}

		    	{%if receiverprofile.profile_photo%}
		    	<img src="{{receiverprofile.profile_photo.url}}" class="pp">
		    	{%else%}
		    	<span class="glyphicon glyphicon-user" style="font-size: 30px;"></span>
		    	{%endif%}<br>
		    </div>
		    {%endif%}
	    </li>
	    {%endfor%}</ul>
	{%endif%}
	<iframe src="/account/refresh_message/{{msg_id}}/{{old_msg_count}}/" frameborder="0" scrolling="no" width="100%"></iframe>
    </section>
</body>
{%endblock%}
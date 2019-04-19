{%extends 'account/base.php'%}
{%load static%}
{%block link%}
<link rel="stylesheet" type="text/css" href="{% static 'account/css/msgimage.css'%}">
<script type="text/javascript" src="{% static 'account/js/msgimage.js'%}"></script>
<meta http-equiv="refresh" content="">
{%endblock%}
{%block body%}
<body>
	<div class="msgimage-bg">
		<div class="closeimg" onclick="window.open('/account/message/{{msg_id}}','_self')">&times</div>
		<div class="msgimage-body">
			{%if conversation.sent_pic%}
			    <img src="{{conversation.sent_pic.url}}">
			{%endif%}
			{%if conversation.received_pic%}
			    <img src="{{conversation.received_pic.url}}">
			{%endif%}

			{%if conversation.sent_file%}
			    <embed src="{{conversation.sent_file.url}}"></embed>
			{%endif%}
			{%if conversation.received_file%}
			    <embed src="{{conversation.received_file.url}}"></embed>
			{%endif%}
	    </div>
    </div>
</body>
{%endblock%}
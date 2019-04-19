<!DOCTYPE html>
{%load static%}
<html>
<head>
	<title>None</title>
	<link rel="stylesheet" type="text/css" href="{% static 'account/css/msgcount.css'%}">
    <meta http-equiv="refresh" content="5">
</head>
<body>
	{%if new_message%}
	<script type="text/javascript">
		window.open('/account/conversation/{{msg_id}}/','_parent');
	</script>
	{%endif%}
</body>
</html>


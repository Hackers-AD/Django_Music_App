{%extends 'account/base.php'%}
{%load static%}
{%block link%}
<link rel="stylesheet" type="text/css" href="{% static 'account/css/login.css'%}">
<script type="text/javascript" src="{% static 'account/js/login.js'%}"></script>
<script type="text/javascript">
	function InputFocused(argument) {
		var input=document.getElementById(argument);
		input.style.border=2+"px solid skyblue";
	}
	function InputBlur(argument) {
		var input=document.getElementById(argument);
		input.style.border=1+"px solid silver";
	}
</script>
{%endblock%}
{%block body%}
<body>
	<header>
		<a href="/tubelight/" style="text-decoration: none;"><h1>&#x266C; TubeLight Administration</h1></a>
		<center>
			{% if messages %}
			    {% for message in messages %}
			        <li style="background: #fff;padding: 10px 0px"><b style="color: green;">{{message}}</b></li>
			    {% endfor %}
			{% endif %}
		</center>
		<div>
			<h4><span class="glyphicon glyphicon-user"></span>&emsp;Log In</h4>
			<form action="" method="post" autocomplete="off">{%csrf_token%}
				{%if errors%}<ul>
				    {%for error in errors%}
				        <li style="color: red">* {{error}}</li>
				    {%endfor%}</ul>
				{%endif%}
				<label>Email or Username</label><br>
				<input type="text" name="email" placeholder="username20@gmail.com" autocomplete="off" value="{{email}}" required="required" id="email" onfocus="InputFocused('email')" onblur="InputBlur('email')"><br>
				<label>Password</label><br>
				<input type="password" name="password" placeholder="**********" autocomplete="off" required="required" id="password" onfocus="InputFocused('password')" onblur="InputBlur('password')"><br><br>
				<input type="submit" name="login" value="Log In" class="btn btn-success"><br><br>
				<p><a href="">Forget Password?</a>&emsp;<a href="">Reset Password</a></p><br>
				<p><a href="/account/signup/"><big>Create a New Account</big></a><br>Don't Have an Account?</p>
			</form>
	    </div>
	</header>
	<section id="info">
		<ul>
			<li><a href="">Term of Use</a></li>
			<li><a href="">Privacy Policy</a></li>
			<li><a href="">FAQs</a></li>
	    </ul>
	    <center>
			<br><h2>&#x266C;</h2>
			&copy;TubeLight Music 2019, All Rights Reserved.
			<br><br>
			<a href="/tubelight/"><button class="btn btn-primary">Back To Home</button></a>
		</center>
	</section>
</body>
{%endblock%}
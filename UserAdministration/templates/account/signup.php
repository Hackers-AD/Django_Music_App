{%extends 'account/base.php'%}
{%load static%}
{%block link%}
<link rel="stylesheet" type="text/css" href="{% static 'account/css/signup.css'%}">
<script type="text/javascript" src="{% static 'account/js/signup.js'%}"></script>
{%endblock%}
{%block body%}
<body>
	<section>
		<h1><a href="/tubelight/" style="text-decoration: none;color: #fff;">&#x266C; TubeLight</a><br></h1><h3>&emsp;Create a New Account</h3>
		<h3>Join with your email address</h3>
		<form action="" method="post" autocomplete="off" onsubmit="return ValidateForm();">{%csrf_token%}
			<div class="navbar bg-primary" id="btn">
				<div style="position: absolute;">&emsp;Sign Up</div>
				<div style="position: absolute;right: 20px;"><a href="/account/login/" class="btn btn-default" >Log In</a></div>
			</div><br>
			{%if errors%}<ul>
				{%for error in errors%}
				    <li style="color: red;display: block;">* {{error}}</li>
				{%endfor%}</ul>
			{%endif%}
			<label>Username <span class="danger">*</span></label><br>
			<input type="text" name="username" placeholder="Required. 150 characters or fewer. Letters, digits and @/./+/-/_ only"  required="required" value="{{username}}"><br>
			<label>Email <span class="danger">*</span></label><br>
			<input type="email" name="email" placeholder="Example - 072bex451@pcampus.edu.np"  required="required" value="{{email}}"><br>
			<label>New password <span class="danger" >*</span></label><br>
			<input type="password" name="npass" placeholder="Password length must be greater than 8." required="required" id="npass" value="{{password}}"><br>
			<label>Retype password <span class="danger">*</span></label><br>
			<input type="password" name="rpass" placeholder="Confirm new password" required="required" id="rpass"><br>
			<label>Full name</label><br>
			<input type="text" name="fname" placeholder="First name + Last name" value="{{fn}}"><br>
			<p id="pinfo" style="color: red;display: none;"></p>
			<br><input type="submit" name="signup" value="Create Account" class="btn btn-primary"><br>
			<p><span class="danger">* </span> means mandatory field.</p>
		</form>
    </section>
    <section>
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
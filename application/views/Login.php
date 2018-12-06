<!DOCTYPE html>
<html>
<style>
h1 {
	overflow:hidden;
	margin:auto;
	font-size: 28px;
	text-align:	center;
}

body {
	background-image: url(https://thewallpaper.co/wp-content/uploads/2016/10/Lollipop-backgrounds-wide-hd-background-wallpapers-free-amazing-tablet-smart-phone-4k-high-definition-3840x2400-768x480.jpg);
}

input [type=text, type=password] {
	display:block;
	width: 100%;
    margin-left: auto;
	margin-right: auto;
	margin-top: 15px;
	height: 50px;
	width: 250px;
	background-color: lightgrey;
	border: none;
}

form {
	margin-top: 5%;
	text-align: center;
}

.logout {
	position:fixed;
	right:10px;
	top:5px;
}

</style>
<body>
<form action="User/logout" align="right" name="form1" method="post">
  <button class="logout" name="logout_button" type="submit">Logout</button>
 </form>
<h1>Login page</h1>
<form action="/User/doLogin" method="post">
	<input type="text" name="user" placeholder="Username">
	<input type="password" name="pass" placeholder="Password">
	<input type="submit" value="Login">
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #Panel
{
	width: 15%;
	float: left;
}
        #Panel a:hover
{
	color: #ccc;
}
.middle
{
    width : 82%;
    float : right;
}
        </style>
</head>
<body>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="header">
	<div id="logo">Code<span class="smart">WithUs.com</span></div>
	<div class="menu">
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="Register.php">Register</a></li>
			<li><?php
			session_start();
			if(isset($_SESSION["user"]) || isset($_SESSION["admin"]))	
			echo"<a href=logout.php>Logout</a>";
			else
			echo "<a href=login.php>Login</a>";
			?></li>
			</ul>
	</div>
</header>
<h1 align="center">Code Review And Discussion Forum</h1>
<hr/>
	
<br/>
<?php /* require 'alladmin.php';*/?>
    <?php
    echo "<div id=Panel>";
    echo "<div class=box><h3><a href=#>DashBoard</a></h3></div>";
    echo "<div class=box><h3><a href=#>Categories</a></h3></div>";
    echo "<div class=box><h3><a href=#>Users</a></h3></div>";
    echo "<div class=box><h3><a href=#>Posts</a></h3></div></div>";
    echo "<div class=middle> <h2 >Hi Admin</h2></div>";
    ?>
</body>
</html>
<?php
    function register()
    {
        echo <<< token1
        <h2> Register Here</h2>
        <form action="$_SERVER[PHP_SELF]" method="post">
        <input type="hidden" name="check" value="1"/>
		<h3>Username</h3><input type="text" name="name"/><br/><br/>
        <h3>Email</h3><input type="email" name="email"/><br/><br/>
        <h3>Password</h3><input type="password" name="psword"/><br/><br/>
        <h3>Re-Password</h3><input type="password" name="repsword"/><br/><br/>
		<button type="submit">Register</button></form><br/>
token1;
    }
    ?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
 <?php
    require 'header.php';
 if(isset($_SESSION['admin']))
 {
     header('Location: admin.php');
 }
 elseif(isset($_SESSION['user']))
 {
     header('Location: index.php');
 }
 else
 {
    register();
    if(isset($_POST["check"]))
    {
        require 'db_connect.php';
        $sql="insert into user(Username, Email, Password, RePassword) values('$_POST[name]', '$_POST[email]', '$_POST[psword]', '$_POST[repsword]')";  
        $query=mysqli_query($connect,$sql);
        if(!$query)
        {
            die("Data couldnt be inserted ".mysqli_error($connect));
        }
        $_SESSION['user']=$_POST['name'];
        echo "You are now registerd <b>$_SESSION[user]</b> <br/> Click here to <a href=logout.php>Logout</a>";
        mysqli_close($connect);
    }
 }
 require 'footer.php';
 ?>
</body>
</html>
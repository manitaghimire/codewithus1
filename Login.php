<?php
function login()
{
    echo <<< token1
        <form action=$_SERVER[PHP_SELF] method=post>
        <input type=hidden name=check value=1/>
        <h3>Username</h3><input type=text name=name1 /><br/><br/>
        <h3>Password</h3><input type=password name=psword1 /><br/><br/>
		<button type=submit>Login</button>
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
    <style>
    #footer{
    bottom:0;
	position :fixed;}
    </style>
</head>
<body>
    <?php
    require 'header.php';
    if(isset($_SESSION['admin']) )
    {
        header("Location: admin.php");
    }
    elseif(isset($_SESSION['user']))
    {
        header("Location: users.php");
    }
    else
    {
        if(isset($_POST["check"]))
        {
            require 'db_connect.php';
            $username=$_POST["name1"];
            $password=$_POST["psword1"];
            $sql1="select * from admin where Username='$username' AND Password='$password' ";
            $query1=mysqli_query($connect,$sql1);
            if(!$query1)
            {
                die("Data couldnt be selected ".mysqli_error($connect));
            }
            $rows1=mysqli_num_rows($query1);
            if($rows1>0)
            {
                $_SESSION['admin']=$username;
                header("Location: admin.php");
            }
            else
            {
                $sql2="select * from user where Username='$username' AND Password='$password' ";
                $query2=mysqli_query($connect,$sql2);  
                if(!$query2)
            {
                die("Data couldnt be selected ".mysqli_error($connect));
            }
            $rows2=mysqli_num_rows($query2);
            if($rows2>0)
            {
                $_SESSION['user']=$username;
                header("Location: users.php");
            }            
            else
            {
                echo "Incorrect Name or Password<br/>";
                login();
            }
        }}
        else
        {
            login();
        }
    }
    require 'footer.php';
    ?>
    
</body>
</html>
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
    require 'admins.php';
    require 'db_connect.php';
    $sql1= "select email, Password from admin where Username='$_SESSION[admin]' ";
    $query1=mysqli_query($connect, $sql1);
    $result=mysqli_fetch_assoc($query1);
    if(!$query1)
            {
                die("Query couldnt be processed ".mysqli_error($connect));
            }

    echo "<div class=middle> <h2 >Update admin profile</h2>";
    echo "<h4>Update Name</h4>
    <form action=$_SERVER[PHP_SELF] method=post>
        <h3>Admin Name </h3><input type=text name=adminname value=$_SESSION[admin] /><br/><br/>
        <h3>Email </h3><input type=email name=adminemail value='$result[email]' /><br/><br/>
        <h3>Existing Password</h3><input type=password name=adminpsword /><br/><br/>
		<input type=submit name=updateProfile value='Make changes' ></form>
    <h4>Update Password</h4>
    <form action=$_SERVER[PHP_SELF] method=post>
        <input type=hidden name=check value=1/>
        <h3>
        Enter Your old Password</h3><input type=password name=adminpsword /><br/><br/>
        <h3>Enter Your New Password</h3><input type=password name=newpsword /><br/><br/>
        <h3>Enter Your Confirm Password</h3><input type=password name=renewpsword /><br/><br/>
		<input type=submit name=updatePassword value='Make changes' ></form>
    ";
    echo "</div><div class=lines></div>";
if(isset($_POST["updateProfile"]))
{
    if($result["Password"]==$_POST["adminpsword"])
    {
        $sql2 = "Update admin set Username='$_POST[adminname]', email='$_POST[adminemail]' where Username='$_SESSION[admin]' ";
        $query2 = mysqli_query($connect, $sql2);
        if(!$query2)
        {
            die("Query couldnt be processed ".mysqli_error($connect));
        }
        $_SESSION["admin"]=$_POST["adminname"];
        header("Location: $_SERVER[PHP_SELF]");
    }
    else
    {
        echo "Please enter correct password to make changes";
    }
}
if(isset($_POST["updatePassword"]))
{
    if($result["Password"]==$_POST["adminpsword"])
    {
        if($_POST["newpsword"]==$_POST["renewpsword"])
        {
            $sql3 = "Update admin set Password='$_POST[newpsword]' where Username='$_SESSION[admin]' ";
            $query3 = mysqli_query($connect, $sql3);
        if(!$query3)
        {
            die("Query couldnt be processed ".mysqli_error($connect));
        }
        header("Location: $_SERVER[PHP_SELF]");
        }
        else
        {
            echo "Confirmation password didnot match the new password";
        }
    }
    else
    {
        echo "Please enter correct password to make changes";
    }
}
?>
    
</body>
</html>
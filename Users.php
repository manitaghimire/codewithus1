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
    require 'userheader.php';
    $sql1= "select * from user where Username='$_SESSION[user]' ";
    $query1=mysqli_query($connect, $sql1);
    $result=mysqli_fetch_assoc($query1);
    if(!$query1)
            {
                die("Query couldnt be processed ".mysqli_error($connect));
            }
            echo "
    <h3 style=text-align:center >Update Profile</h3>
    <form action=$_SERVER[PHP_SELF] method=post>
        <b>User Id : $result[User_Id]</b> <br/><br/>
        <b>Joined date : $result[Joined] </b><br/><br/>
        <h4>Update Information</h4>
        <b>Username : </b><input type=text name=User value=$result[Username] /><br/><br/>
        <b>Email : </b><input type=text name= email value=$result[Email] /><br/><br/>
        <b>Existing Password : </b><input type=password name='psword1' /><br/><br/>
		<input type=submit name=updateProfile value='Make changes' ></form>
        <h4>Update Password</h4>
    <form action=$_SERVER[PHP_SELF] method=post>
        <b>
        Enter Your old Password : </b><input type=password name='psword1' /><br/><br/>
        <b>Enter Your New Password : </b><input type=password name=newpsword /><br/><br/>
        <b>Enter Your Confirm Password : </b><input type=password name=renewpsword /><br/><br/>
		<input type=submit name=updatePassword value='Make changes' ></form>
        ";
echo "</div>";
if(isset($_POST["updateProfile"]))
{
    if($result["Password"]==$_POST["psword1"])
    {
        $sql2 = "Update user set Username='$_POST[User]', Email='$_POST[email]' where Username='$_SESSION[user]' ";
        $query2 = mysqli_query($connect, $sql2);
        if(!$query2)
        {
            die("Query couldnt be processed ".mysqli_error($connect));
        }
        $_SESSION["user"]=$_POST["User"];
        header("Location: $_SERVER[PHP_SELF]");
    }
    else
    {
        echo "Please enter correct password to make changes";
        }
}
        if(isset($_POST["updatePassword"]))
        {
            if($result["Password"]==$_POST["psword1"])
            {
            if($_POST["newpsword"]==$_POST["renewpsword"])
            {
                $sql3 = "Update user set Password='$_POST[newpsword]' where Username='$_SESSION[user]' ";
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
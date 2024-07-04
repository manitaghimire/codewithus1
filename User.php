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
    echo "<div class=middle>
    
    <h2 >User Information</h2>
    <table border=1px>
    <tr>
    <th>User Id</th>
    <th>Username</th>
    <th>Email</th>
    <th>Joined date</th>
    <th>Action</th>
    </tr>
";
require 'db_connect.php';
$sql1="Select * from user";
$query1=mysqli_query($connect,$sql1);
if(!$query1)
{
    die("Query couldnt be processed ".mysqli_error($connect));
}
$rows=mysqli_num_rows($query1);
if($rows>0)
{   
while($result=mysqli_fetch_assoc($query1))
{
    echo "<tr>
    <td>$result[User_Id]</td>
    <td>$result[Username]</td>
    <td>$result[Email]</td>
    <td>$result[Joined]</td>
    <td><a href=removeUser.php?User=$result[Username] >Remove User</a></td>
    </tr>";
}
}
  echo"</table> </div>";
    echo "<div class=lines></div>";
    ?>
</body>
</html>
<?php
$url = $_SERVER['HTTP_REFERER'];
$name=$_GET["User"];
require 'db_connect.php';
$sql1= "DELETE FROM user WHERE Username='$name'";
    $query1=mysqli_query($connect,$sql1);
    if(!$query1)
    {
        die("Query couldnt be processed ".mysqli_error($connect));
    }
    else
    {
        header("Location: $url");
    }
?>
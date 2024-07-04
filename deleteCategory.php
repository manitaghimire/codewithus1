<?php
$url = $_SERVER['HTTP_REFERER'];
$catname=$_GET["Category_name"];
require 'db_connect.php';
$sql1= "DELETE FROM category WHERE Category_name='$catname'";
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
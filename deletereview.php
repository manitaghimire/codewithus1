<?php
$url = $_SERVER['HTTP_REFERER'];
$reviewid=$_GET["review_id"];
require 'db_connect.php';
$sql1= "DELETE FROM reviews WHERE review_id=$reviewid";
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
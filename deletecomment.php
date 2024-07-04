<?php
$url = $_SERVER['HTTP_REFERER'];
$commentid=$_GET["comment_id"];
require 'db_connect.php';
$sql1= "DELETE FROM comments WHERE comment_id=$commentid";
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
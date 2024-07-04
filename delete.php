<?php
$url = $_SERVER['HTTP_REFERER'];
$threadid=$_GET["thread_id"];
require 'db_connect.php';
$sql1= "DELETE FROM threads WHERE thread_id=$threadid";
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
<?php
$url = $_SERVER['HTTP_REFERER'];
$codeid=$_GET["code_Id"];
require 'db_connect.php';
$sql1= "DELETE FROM codes WHERE code_Id=$codeid";
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

<?php
//NOT NEEDED
$url=$_GET["search"];
?>
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
    require 'header.php';
    echo "<h2>Search Results for \"$url\" are listed below</h2>";
    require 'db_connect.php';
    $sql1="select * from threads where thread_title like '%$url%' || thread_description like '%$url%' ";
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
       echo "<a href='comments.php?thread_id=$result[thread_id]'>$result[thread_title]</a><br/>$result[thread_description]<br/><hr style='height:1px;border-width:0;color:#ccc;background-color:#ccc'>";
    }
}
else
{
    echo "Result not found";
}
    ?>
</body>
</html>
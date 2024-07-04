<?php
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
    $sql1="SELECT * FROM `threads` WHERE match(thread_title, thread_description) against ('$url')";
    $sql2 ="SELECT * FROM `codes` WHERE match(title, description) against ('$url') ";
    $query1=mysqli_query($connect,$sql1);
    $query2=mysqli_query($connect,$sql2);
    if(!$query1 || !$query2)
    {
        die("Query couldnt be processed ".mysqli_error($connect));
    }
    $rows=mysqli_num_rows($query1);
    $rows2=mysqli_num_rows($query2);
if($rows>0)
{   
    while($result=mysqli_fetch_assoc($query1))
    {
        $result['thread_description']=str_replace("<","&lt;",$result['thread_description']);
        $result['thread_description']=str_replace(">","&gt;",$result['thread_description']);
       echo "<a href='comments.php?thread_id=$result[thread_id]'>$result[thread_title]</a><br/>$result[thread_description]<br/><hr style='height:1px;border-width:0;color:#ccc;background-color:#ccc'>";
    }
}
if($rows2>0)
{   
    while($result2=mysqli_fetch_assoc($query2))
    {
        $result2['description']=str_replace("<","&lt;",$result2['description']);
        $result2['description']=str_replace(">","&gt;",$result2['description']);
        $result2['code']=str_replace("<","&lt;",$result2['code']);
        $result2['code']=str_replace(">","&gt;",$result2['code']);
       echo "<a href='reviews.php?code_Id=$result2[code_Id]'>$result2[title]</a><br/>$result2[description]<br/><pre><code>".substr($result2["code"],0,80)."...</code></pre><hr style='height:1px;border-width:0;color:#ccc;background-color:#ccc'>";
    }
}
if($rows==0 && $rows2==0)
{
    echo "Result not found";
}
    ?>
</body>
</html>
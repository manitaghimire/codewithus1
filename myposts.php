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
    $replace = ["`  ","  `"];
    $replaced = ["<pre><span class='codes'>","</span></pre>"]; 
    $sql1= "select thread_title, thread_id, thread_description, Category_name from threads where Username='$_SESSION[user]' ";
    $query1=mysqli_query($connect, $sql1);
    if(!$query1)
            {
                die("Query couldnt be processed ".mysqli_error($connect));
            }
            $rows=mysqli_num_rows($query1);
if($rows>0)
{   
    echo "
    <table border=1px>
    <tr>
    <th>Category</th>
    <th>Posts</th>
    </tr>";
while($result=mysqli_fetch_assoc($query1))
{
    $result['thread_description']=str_replace("<","&lt;",$result['thread_description']);
        $result['thread_description']=str_replace(">","&gt;",$result['thread_description']);
        $result['thread_description']=str_replace($replace ,$replaced,$result['thread_description']);
    echo "<tr>
    <td>$result[Category_name]</td>
    <td><a href=comments.php?thread_id=$result[thread_id]>$result[thread_title]</a><br/>"
    .substr($result["thread_description"],0,160)."
    ....</td>
    </tr>";
        }
        echo"
    </table>
    ";
}
    ?>
</body>
</html>
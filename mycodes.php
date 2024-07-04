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
    $sql1= "select title, code_Id, description, code, Category_name from codes where Username='$_SESSION[user]' ";
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
    $result['description']=str_replace("<","&lt;",$result['description']);
    $result['description']=str_replace(">","&gt;",$result['description']);
    $result['code']=str_replace("<","&lt;",$result['code']);
    $result['code']=str_replace(">","&gt;",$result['code']);
    $result['code']=str_replace($replace ,$replaced,$result['code']);
    echo "<tr>
    <td>$result[Category_name]</td>
    <td><a href=reviews.php?code_Id=$result[code_Id]>$result[title]</a><br/>"
    .substr($result["description"],0,160)."
    ....<br/><pre>"
    .substr($result["code"],0,100).
    "...</pre></td>
    </tr>";
        }
        echo"
    </table>
    ";
}
    ?>
</body>
</html>
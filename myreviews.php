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
    //$sql1= "select thread_title, thread_id, thread_description, Category_name from threads where Username='$_SESSION[user]' ";
    $sql1="select reviews.review_description, reviews.code, reviews.code_Id, codes.Category_name, codes.title from reviews
            INNER JOIN codes on reviews.code_Id=codes.code_Id
            where reviews.Username='$_SESSION[user]'";
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
    $result['review_description']=str_replace("<","&lt;",$result['review_description']);
    $result['review_description']=str_replace(">","&gt;",$result['review_description']);
    $result['code']=str_replace("<","&lt;",$result['code']);
    $result['code']=str_replace(">","&gt;",$result['code']);
    $result['code']=str_replace($replace ,$replaced,$result['code']);
    echo "<tr>
    <td>$result[Category_name]</td>
    <td><a href=reviews.php?code_Id=$result[code_Id]>$result[title]</a></a><br/>"
    .substr($result["review_description"],0,160)."
    ....<br/>"
    .substr($result["code"],0,100)."
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
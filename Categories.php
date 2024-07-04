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
    require 'admins.php';
    echo "<div class=middle> <h2>Update Categories</h2>";
    echo <<< token1
    <table border=1px>
    <tr>
    <th>Category Name</th>
    <th>Category description</th>
    <th>Image</th>
    <th>Action</th>
    <th>View from categories</th>
    </tr>
token1;

    require 'db_connect.php';
    $sql1="Select * from category";
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
        echo "<tr>
        <td>$result[Category_name]</td>
        <td>".substr($result["Category_description"],0,150)."...</td>
        <td><img src=$result[Image_url] width= 100px height= 100px/></td>
        <td><a href=editCategories.php?result=$result[Category_name]> Edit</a> || <a href=deleteCategory.php?Category_name=$result[Category_name] >Delete</a> </td>
        <td><a href=threads.php?category=$result[Category_name]>Posts</a> || <a href=codes.php?category=$result[Category_name]>Codes</a> </td>
        </tr>";
        /*echo "<div class=picture><img src=$result[Image_url] width= 300px height= 300px/><br/>";
        echo "<div class=info> <b>$result[Category_name]</b><br/>".substr($result["Category_description"],0,80)."... <br/>";
        echo "<div class=add><a href=threads.php?category=$result[Category_name] >Discussions</a> || <a href=codes.php?category=$result[Category_name] >Reviews</a><br/></div></div></div>";*/
    }
}
    echo "</table>";
    echo "</div><div class=lines></div>";
    ?>
</body>
</html>
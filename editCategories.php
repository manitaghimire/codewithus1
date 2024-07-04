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
$catname=$_GET["result"];
require 'admins.php';
echo "<div class=middle> ";
require 'db_connect.php';
    $sql1="Select * from category where Category_name='$catname' ";
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
        /*echo "<div class=picture><img src=$result[Image_url] width= 300px height= 300px/><br/>";
        echo "<div class=info> <b>$result[Category_name]</b><br/>".substr($result["Category_description"],0,80)."... <br/>";
        echo "<div class=add><a href=threads.php?category=$result[Category_name] >Discussions</a> || <a href=codes.php?category=$result[Category_name] >Reviews</a><br/></div></div></div>";*/
        echo <<< token1
        <form action=$_SERVER[REQUEST_URI] method=post enctype =multipart/form-data >
        <h2>Edit the Category</h2>
        <h3>Category Name</h3><input type=text name=name1 value=$catname /><br/>
        <h3>Category Desciption</h3><textarea name=describe rows=5 cols=50 >$result[Category_description]</textarea><br/>
        <h3>Change image</h3>
        <img src=$result[Image_url] width= 200px height= 200px/><br/>
        <input type="file" name="file" value= "$result[Image_url]"/><br/>
        <input type="submit" name="saveChanges" value= "Save changes" /><br/>
token1;
        $fileurl=$result['Image_url'];
    }
}
echo "</div>";
echo "<div class=lines></div>";
?>
<?php
if(isset($_POST['saveChanges']))// check other inputs too
{
    require 'db_connect.php';
    if (!(empty($_FILES['file']['name'])))
    {   
        echo "File changes<br/>";
    $file_name= $_FILES['file']['name'];
    $file_type= $_FILES['file']['type'];
    $file_size=$_FILES['file']['size'];
    $file_temp=$_FILES['file']['tmp_name'];
    $file_store = "uploads/".$file_name;
    if(move_uploaded_file($file_temp,$file_store))
    {
        $fileurl=$file_store;
    }}
        require 'db_connect.php';
        $sql=" UPDATE category SET Category_name = '$_POST[name1]', Category_description= '$_POST[describe]', Image_url='$fileurl' WHERE Category_name = '$catname' ";
        $query=mysqli_query($connect,$sql);
        if(!$query)
        {
            die("Data couldnt be updated ".mysqli_error($connect));
        }
        mysqli_close($connect);
        header('Location: Categories.php');
        
    }
    
?>
</body>
</html>
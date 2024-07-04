<?php
if(isset($_POST['upload_file']))// check other inputs too
{
    $file_name= $_FILES['file']['name'];
    $file_type= $_FILES['file']['type'];
    $file_size=$_FILES['file']['size'];
    $file_temp=$_FILES['file']['tmp_name'];
    $file_store = "uploads/".$file_name;
    if(move_uploaded_file($file_temp,$file_store))
    {
        echo "Category added <br/>";
        //echo $file_store;
        require 'db_connect.php';
        $sql="insert into category values('$_POST[name1]','$_POST[describe]','$file_store')";  
        $query=mysqli_query($connect,$sql);
        if(!$query)
        {
            die("Data couldnt be inserted ".mysqli_error($connect));
        }
        mysqli_close($connect);
    }
}
function add_category()
{
    echo <<< token1
        <form action=$_SERVER[PHP_SELF] method=post enctype =multipart/form-data >
        <h2>Add a new Category</h2>
        <h3>Category Name</h3><input type=text name=name1 /><br/><br/>
        <h3>Category Desciption</h3><textarea name=describe rows=5 cols=50 ></textarea><br/><br/>
        <h3>Choose an image</h3>
        <input type="file" name="file"/><br/><br/>
        <input type="submit" name="upload_file"/><br/>
token1;
}
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

require 'admins.php';
echo "<div class=middle> ";
add_category();
echo "</div>";
echo "<div class=lines></div>";
?>
</body>
</html>
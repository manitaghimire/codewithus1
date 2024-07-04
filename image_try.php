<?php
if(isset($_POST['upload_file']))
{
    $file_name= $_FILES['file']['name'];
    $file_type= $_FILES['file']['type'];
    $file_size=$_FILES['file']['size'];
    $file_temp=$_FILES['file']['tmp_name'];
    $file_store = "uploads/".$file_name;
    if(move_uploaded_file($file_temp,$file_store))
    {
        echo "File uploaded<br/>";
        echo $file_store;
    }
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
    <form action=<?php echo "$_SERVER[PHP_SELF]"; ?> method="post" enctype ="multipart/form-data" >
    <input type="file" name="file"/><br/>
    <input type="submit" name="upload_file"/><br/>
    <h2>Hey</h2>
</form>
</body>
</html>
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
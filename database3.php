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
    require 'db_connect.php';
    $sql="insert into admin values('Manita727','manita@gmail.com','727manita8')";  
    $query=mysqli_query($connect,$sql);
    if(!$query)
    {
        die("Data couldnt be inserted ".mysqli_error($connect));
    }
    mysqli_close($connect);
    ?>
</body>
</html>
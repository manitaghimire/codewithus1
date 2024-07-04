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
    $sql="ALTER TABLE `images` ADD FOREIGN KEY (`code_Id`) REFERENCES `codes`(`code_Id`) ON DELETE CASCADE ON UPDATE CASCADE;";  
    $query=mysqli_query($connect,$sql);
    if(!$query)
    {
        die("Table couldnt be altered ".mysqli_error($connect));
    }
    mysqli_close($connect);
    ?>
</body>
</html>
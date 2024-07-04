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
    $sql="Create table threads(`thread_id` INT NOT NULL AUTO_INCREMENT , `thread_title` VARCHAR(200) NOT NULL , `thread_description` TEXT NOT NULL , `Username` VARCHAR(25) NOT NULL , `Category_name` VARCHAR(25) NOT NULL , `Time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`thread_id`))";  
    $query=mysqli_query($connect,$sql);
    if(!$query)
    {
        die("Table couldnt be created ".mysqli_error($connect));
    }
    mysqli_close($connect);
    ?>
</body>
</html>
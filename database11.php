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
    $sql="Create table reviews(`review_id` INT NOT NULL AUTO_INCREMENT , `review_description` TEXT NOT NULL , `code` TEXT , `Username` VARCHAR(25) NOT NULL , `code_Id` INT NOT NULL , `Time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`review_id`))";  
    $query=mysqli_query($connect,$sql);
    if(!$query)
    {
        die("Table couldnt be created ".mysqli_error($connect));
    }
    mysqli_close($connect);
    ?>
</body>
</html>
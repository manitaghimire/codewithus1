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
    $sql="Create table review_images( `Image` VARCHAR(100) NOT NULL , `review_id` INT NOT NULL , PRIMARY KEY (`Image`))";  
    $query=mysqli_query($connect,$sql);
    $sql2="ALTER TABLE `review_images` ADD FOREIGN KEY (`review_id`) REFERENCES `reviews`(`review_id`) ON DELETE CASCADE ON UPDATE CASCADE;";  
    $query2=mysqli_query($connect,$sql2);
    if(!$query || !$query2)
    {
        die("Table couldnt be altered ".mysqli_error($connect));
    }
    mysqli_close($connect);
    ?>
</body>
</html>
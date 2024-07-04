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
    $connect=mysqli_connect("localhost","root","");
    if(!$connect)
    {
        die("Connection failed ".mysqli_connect_error());
    }
    $sql="Create database Project";
    $query=mysqli_query($connect,$sql);
    if(!$query)
    {
        die("Database couldnt be created ".mysqli_error());
    }
    mysqli_close($connect);
    ?>
</body>
</html>
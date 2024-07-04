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
    require 'userheader.php';
    echo "<table width=12% ><tr><td><a href='Notifications.php'>Comments</a></td><td><a href='Notifications2.php'>Reviews</a></td></tr></table>";
    require 'db_connect.php';
    $replace = ["`  ","  `"];
    $replaced = ["<pre><span class='codes'>","</span></pre>"]; 
    echo "
        <table border=1px>
        <tr>
        <th>Time</th>
        <th>Notification</th>
        </tr>";
        $sql1="select reviews.review_id, reviews.review_description, reviews.code, reviews.Username, reviews.code_Id, reviews.Time, codes.title from reviews
            INNER JOIN codes on reviews.code_Id=codes.code_Id
            where codes.Username='$_SESSION[user]' ORDER BY reviews.review_id DESC";
            /*
            $sql1="select reviews.review_id, reviews.review_description, reviews.code, reviews.Username, reviews.code_Id, reviews.Time from reviews
            INNER JOIN codes on reviews.code_Id=codes.code_Id
            where codes.Category_name='$_POST[categorySearch]'";
            */
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
                $result['code']=str_replace($replace ,$replaced,$result['code']);
                echo "<tr> <td>$result[Time]</td><td>Your post was responded to by $result[Username] <br/><a href=reviews.php?code_Id=$result[code_Id]>$result[title]</a><br/>$result[review_description]<br/>".substr($result["code"],0,200)."...</td></tr>";
            }
        }
        
    ?>
</body>
</html>
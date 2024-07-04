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
        $sql1="select comments.comment_id, comments.comment_description, comments.Username, comments.thread_id, comments.Time, threads.thread_title from comments
            INNER JOIN threads on comments.thread_id=threads.thread_id
            where threads.Username='$_SESSION[user]' ORDER BY comments.comment_id DESC";
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
                $result['comment_description']=str_replace($replace ,$replaced,$result['comment_description']);
                echo "<tr> <td>$result[Time]</td><td>Your post was responded to by $result[Username] <br/><a href=comments.php?thread_id=$result[thread_id]>$result[thread_title]</a><br/>".substr($result["comment_description"],0,200)."...</td></tr>";
            }
        }
        
    ?>
</body>
</html>
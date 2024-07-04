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
        require 'admins.php';
        echo "<div class=middle>
    <h2 >Posts Information</h2>
    <table style='text-align:left; width:600px; ' >
    <tr>
    <th>Search by Categories</th>
    <th>Search by Username</th>
    <tr/>
		<tr><td><form method=post ><input type=text name=categorySearch />
        <input type=submit value=Search /></form>
        </td>
        <td><form method=post ><input type=text name=nameSearch />
        <input type=submit value=Search /></form>
        </td>
        </tr>
        </table>
        <br/>
        ";
        echo "
        <table border=1px>
        <tr>
        <th>Post Id</th>
        <th>Title</th>
        <th>Description</th>
        <th>Username</th>
        <th>Category</th>
        <th>Time</th>
        <th>Action</th>
        </tr>
            ";
        require 'db_connect.php';
        $replace = ["`  ","  `"];
        $replaced = ["<pre><span class='codes'>","</span></pre>"];
        if (isset($_POST["categorySearch"]))
        {
            echo "<h2 style='text-align:center'; ><i>Search results against \"$_POST[categorySearch]\"</i></h2> ";
            $sql1="Select * from threads where Category_name='$_POST[categorySearch]'";
            $query1=mysqli_query($connect,$sql1);
            if(!$query1)
            {
                die("Query couldnt be processed ".mysqli_error($connect));
            }
        }
        elseif (isset($_POST["nameSearch"]))
        {
            echo "<h2 style='text-align:center'; ><i>Search results against \"$_POST[nameSearch]\"</i></h2> ";
            $sql1="Select * from threads where Username='$_POST[nameSearch]' ";
            $query1=mysqli_query($connect,$sql1);
            if(!$query1)
            {
                die("Query couldnt be processed ".mysqli_error($connect));
            }
        }
        else
        {
            echo "All table information";
            $sql1="Select * from threads";
            $query1=mysqli_query($connect,$sql1);
            if(!$query1)
            {
                die("Query couldnt be processed ".mysqli_error($connect));
            }
             }
             $rows=mysqli_num_rows($query1);
if($rows>0)
{   
while($result=mysqli_fetch_assoc($query1))
{
    echo "<tr>
    <td>$result[thread_id]</td>
    <td><a href=comments.php?thread_id=$result[thread_id]>$result[thread_title]</a></td>";
    $result['thread_description']=str_replace("<","&lt;",$result['thread_description']);
    $result['thread_description']=str_replace(">","&gt;",$result['thread_description']);
    $result['thread_description']=str_replace($replace ,$replaced,$result['thread_description']);
    //<td>".substr($result["thread_description"],0,150)."...</td>
    echo "<td>".substr($result["thread_description"],0,200).".......</td>
    <td>$result[Username]</td>
    <td>$result[Category_name]</td>
    <td>$result[Time]</td>
    <td><a href=delete.php?thread_id=$result[thread_id]>Delete Post</a></td>
    </tr>";
}}
echo"</table> </div>";

    echo "</div><div class=lines></div>";
    ?>
</body>
</html>
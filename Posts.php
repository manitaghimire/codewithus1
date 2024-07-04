<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        </style>
</head>
<body>
    <?php
    //can be removed
    require 'admins.php';
    echo "<div class=middle>
    <h2 >Posts Information</h2>
    
    <table style='text-align:left; width:600px; ' >
    <tr>
    <th>Search by Categories</th>
    <th>Search by Username</th>
    <tr/>
		<tr><td><form><input type=text name=categorySearch />
        <input type=submit value=Search /></form>
        </td>
        <td><form><input type=text name=nameSearch />
        <input type=submit value=Search /></form>
        </td>
        </tr>
        </table>
        <br/>";
        require 'db_connect.php';
        if (isset($_POST["categorySearch"]))
        {
            echo "Searched for $_POST[categorySearch] ";
           /* $sql2="Select * from threads where Category_name=$_POST[categorySearch] ";
            $query2=mysqli_query($connect,$sql2);
            if(!$query2)
            {
                die("Query couldnt be processed ".mysqli_error($connect));
            }
            $rows2=mysqli_num_rows($query2);
            if($rows2>0)
            {   
            while($result=mysqli_fetch_assoc($query2))
        {   
            echo "<tr>
    <td>$result[thread_id]</td>
    <td><a href=comments.php?thread_id=$result[thread_id]>$result[thread_title]</a></td>";
    $result['thread_description']=str_replace("<","&lt;",$result['thread_description']);
    $result['thread_description']=str_replace(">","&gt;",$result['thread_description']);
    //<td>".substr($result["thread_description"],0,150)."...</td>
    echo "<td>".substr($result["thread_description"],0,200).".......</td>
    <td>$result[Username]</td>
    <td>$result[Category_name]</td>
    <td>$result[Time]</td>
    <td><a href=delete.php?thread_id=$result[thread_id]>Delete Post</a></td>
    </tr>";
        }}
    */}
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
//require 'db_connect.php';
$sql1="Select * from threads";
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
    echo "<tr>
    <td>$result[thread_id]</td>
    <td><a href=comments.php?thread_id=$result[thread_id]>$result[thread_title]</a></td>";
    $result['thread_description']=str_replace("<","&lt;",$result['thread_description']);
    $result['thread_description']=str_replace(">","&gt;",$result['thread_description']);
    //<td>".substr($result["thread_description"],0,150)."...</td>
    echo "<td>".substr($result["thread_description"],0,200).".......</td>
    <td>$result[Username]</td>
    <td>$result[Category_name]</td>
    <td>$result[Time]</td>
    <td><a href=delete.php?thread_id=$result[thread_id]>Delete Post</a></td>
    </tr>";
    /*echo "<div class=picture><img src=$result[Image_url] width= 300px height= 300px/><br/>";
    echo "<div class=info> <b>$result[Category_name]</b><br/>".substr($result["Category_description"],0,80)."... <br/>";
    echo "<div class=add><a href=threads.php?category=$result[Category_name] >Discussions</a> || <a href=codes.php?category=$result[Category_name] >Reviews</a><br/></div></div></div>";*/
    
}
}
/*mysqli_close($connect);*/
  echo"</table> </div>";

     echo "<div class=lines></div>";
    ?>
</body>
</html>
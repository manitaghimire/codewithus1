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
    <h2 >Codes Information</h2>
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
        <th>Code Id</th>
        <th>Title</th>
        <th>Description</th>
        <th>Code</th>
        <th>Username</th>
        <th>Category</th>
        <th>Time</th>
        <th>Action</th>
        </tr>
            ";
            $replace = ["`  ","  `"];
        $replaced = ["<pre><span class='codes'>","</span></pre>"];
        require 'db_connect.php';
        if (isset($_POST["categorySearch"]))
        {
            echo "<h2 style='text-align:center'; ><i>Search results against \"$_POST[categorySearch]\"</i></h2> ";
            $sql1="Select * from codes where Category_name='$_POST[categorySearch]'";
            $query1=mysqli_query($connect,$sql1);
            if(!$query1)
            {
                die("Query couldnt be processed ".mysqli_error($connect));
            }
        }
        elseif (isset($_POST["nameSearch"]))
        {
            echo "<h2 style='text-align:center'; ><i>Search results against \"$_POST[nameSearch]\"</i></h2> ";
            $sql1="Select * from codes where Username='$_POST[nameSearch]' ";
            $query1=mysqli_query($connect,$sql1);
            if(!$query1)
            {
                die("Query couldnt be processed ".mysqli_error($connect));
            }
        }
        else
        {
            $sql1="Select * from codes";
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
    <td>$result[code_Id]</td>
    <td><a href=reviews.php?code_Id=$result[code_Id]>$result[title]</a></td>";
    $result['description']=str_replace("<","&lt;",$result['description']);
    $result['description']=str_replace(">","&gt;",$result['description']);
    echo "<td>".substr($result["description"],0,100).".......</td>";
    $result['code']=str_replace("<","&lt;",$result['code']);
    $result['code']=str_replace(">","&gt;",$result['code']);
    $result['code']=str_replace($replace ,$replaced,$result['code']);
    echo "<td>".substr($result["code"],0,100).".......</td>
    
    <td>$result[Username]</td>
    <td>$result[Category_name]</td>
    <td>$result[time]</td>
    <td><a href=deletecode.php?code_Id=$result[code_Id]>Delete Code</a></td>
    </tr>";
}}
echo"</table> </div>";

    echo "</div><div class=lines></div>";
    ?>
</body>
</html>
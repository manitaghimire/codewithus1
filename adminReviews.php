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
    <h2 >Reviews Information</h2>
    <table style='text-align:left; width:900px; ' >
    <tr>
    <th>Search by Categories</th>
    <th>Search by Username</th>
    <th>Search by Code title</th>
    <tr/>
		<tr><td><form method=post ><input type=text name=categorySearch />
        <input type=submit value=Search /></form>
        </td>
        <td><form method=post ><input type=text name=nameSearch />
        <input type=submit value=Search /></form>
        </td>
        <td><form method=post ><input type=text name=codeSearch />
        <input type=submit value=Search /></form>
        </td>
        </tr>
        </table>
        <br/>
        ";
        echo "
        <table border=1px>
        <tr>
        <th>Review Id</th>
        <th>Description</th>
        <th>Code</th>
        <th>Username</th>
        <th>Code title</th>
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
            $sql1="select reviews.review_id, reviews.review_description, reviews.code, reviews.Username, reviews.code_Id, reviews.Time from reviews
            INNER JOIN codes on reviews.code_Id=codes.code_Id
            where codes.Category_name='$_POST[categorySearch]'";
            $query1=mysqli_query($connect,$sql1);
            if(!$query1)
            {
                die("Query couldnt be processed ".mysqli_error($connect));
            }
        }
        elseif (isset($_POST["nameSearch"]))
        {
            echo "<h2 style='text-align:center'; ><i>Search results against \"$_POST[nameSearch]\"</i></h2> ";
            $sql1="Select * from reviews where Username='$_POST[nameSearch]' ";
            $query1=mysqli_query($connect,$sql1);
            if(!$query1)
            {
                die("Query couldnt be processed ".mysqli_error($connect));
            }
        }
        elseif(isset($_POST["codeSearch"]))
        {
            echo "<h2 style='text-align:center'; ><i>Search results against \"$_POST[codeSearch]\"</i></h2> ";
            $sql1="select reviews.review_id, reviews.review_description, reviews.code, reviews.Username, reviews.code_Id, reviews.Time from reviews
            INNER JOIN codes on reviews.code_Id=codes.code_Id
            where match(title) against ('$_POST[codeSearch]') ";
            $query1=mysqli_query($connect,$sql1);
            if(!$query1)
            {
                die("Query couldnt be processed ".mysqli_error($connect));
            }
        }
        else
        {
            $sql1="Select * from reviews ";
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
    <td>$result[review_id]</td>";
    $result['review_description']=str_replace("<","&lt;",$result['review_description']);
    $result['review_description']=str_replace(">","&gt;",$result['review_description']);
    echo "<td>".substr($result["review_description"],0,100).".......</td>";
    $result['code']=str_replace("<","&lt;",$result['code']);
    $result['code']=str_replace(">","&gt;",$result['code']);
    $result['code']=str_replace($replace ,$replaced,$result['code']);
    echo "<td>".substr($result["code"],0,100).".......</td>
    <td>$result[Username]</td>";
    $sql2="select title, Category_name from codes where code_Id=$result[code_Id] ";
            $query2=mysqli_query($connect,$sql2);
            if(!$query2)
            {
                die("Query couldnt be processed ".mysqli_error($connect));
            }
             
             $result2=mysqli_fetch_assoc($query2);

    echo "<td><a href=reviews.php?code_Id=$result[code_Id]>$result2[title]</a></td>
    <td>$result2[Category_name]</td>
    <td>$result[Time]</td>
    <td><a href=deletereview.php?review_id=$result[review_id]>Delete review</a></td>
    </tr>";
}}
echo"</table> </div>";

    echo "</div><div class=lines></div>";
    ?>
</body>
</html>


<?php
$categoryname=$_GET["category"];
function Category_info()
{
    global $categoryname;
    $retvalue=false;
    require 'db_connect.php';
    $sql1="Select * from category where Category_name='$categoryname' ";
    $query1=mysqli_query($connect,$sql1);
    if(!$query1)
    {
        die("Query couldnt be processed ".mysqli_error($connect));
    }
    $rows=mysqli_num_rows($query1);
if($rows>0)
{   
    $retvalue=true;
    $result=mysqli_fetch_assoc($query1);
        echo "<h1> Welcome to $result[Category_name] Forums for Code Reviews</h1>";
        echo "$result[Category_description]<br/>";

}
else
{
    echo "<center><h2>Category \"$categoryname\" doesnt exist</h2></center>";
    exit;
}
return $retvalue;
}
function post_code()
{
    global $categoryname;
    echo <<< token1
        <h3>Post your Query Here</h3>
        <form action=codes.php?category=$categoryname method=post enctype =multipart/form-data >
        <input type=hidden name=check value=1/>
        <h3>Title</h3><input type=text name=title /><br/><br/>
        <h3>Description</h3><textarea name=describe rows=5 cols=50 ></textarea><br/><br/>
        <h3>Code</h3>
        <input type="button" onclick="codeStyle()" value="code format"><br/>
        <textarea name=code id=code rows=20 cols=100 ></textarea><br/><br/>
        <h3>Select images</h3>
        <input type="file" name="file[]" multiple /><br/><br/>
        <input type="submit" name="Submit"/><br/>
        </form>
token1;
}
function listCodes()
{
    $retvalue=false;
    global $categoryname;
    $replace = ["`  ","  `"];
    $replaced = ["<pre><span class='codes'>","</span></pre>"];
    require 'db_connect.php';
    $sql1="Select * from codes where Category_name='$categoryname' ORDER BY code_Id DESC ";
    $query1=mysqli_query($connect,$sql1);
    if(!$query1)
    {
        die("Query couldnt be processed ".mysqli_error($connect));
    }
    $rows=mysqli_num_rows($query1);
if($rows>0)
{
    $retvalue=true;  
    echo "<h2>View Codes and Reviews</h2>";
    while($result=mysqli_fetch_assoc($query1))
    {
    $result['description']=str_replace("<","&lt;",$result['description']);
    $result['description']=str_replace(">","&gt;",$result['description']);
    $result['code']=str_replace("<","&lt;",$result['code']);
    $result['code']=str_replace(">","&gt;",$result['code']);
    $result['code']=str_replace($replace ,$replaced,$result['code']);
        echo "<div class='individual'><img src=user.png width=30px height=18px style='float:left;'/><b>$result[Username]</b> at $result[time]<br/> <a href=reviews.php?code_Id=$result[code_Id]>$result[title]</a><br/>$result[description] ".substr($result["code"],0,80)."...<br/><a href=reviews.php?code_Id=$result[code_Id]>View More</a>"; 
        if(isset($_SESSION["admin"]) || isset($_SESSION["user"]) && $_SESSION["user"]==$result["Username"])
        {
            echo " <a href=deletecode.php?code_Id=$result[code_Id]>Delete</a>";
        }
        echo "<br/><hr style='height:1px;border-width:0;color:#ccc;background-color:#ccc'>";
    }
    //.substr($result["code"],0,80).
return $retvalue;
}}
?>
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
    require 'header.php';
    if(Category_info()){
    post_code();}
    if(isset($_POST["check"]))
    {
        if(!(isset($_SESSION["user"])) )
        {
            echo "<br/>You have to login to post";
        }
        else{
        require 'db_connect.php';
        $_POST['title']=str_replace("'","\'","$_POST[title]");
        $_POST['describe']=str_replace("'","\'","$_POST[describe]");
        $_POST['code']=str_replace("'","\'","$_POST[code]");
        $sql1="insert into codes(title, description, code, Username, Category_name) values('$_POST[title]', '$_POST[describe]', 
        '$_POST[code]', '$_SESSION[user]', '$_GET[category]')";  
        $query1=mysqli_query($connect,$sql1);
        if(!$query1)
            {
                die("Data couldnt be inserted ".mysqli_error($connect));
            }
            if($_FILES){
        $num=1;
        $id = mysqli_insert_id($connect);
            foreach($_FILES["file"]["name"] as $key => $val)
            {
                $file_name= $_FILES['file']['name'][$key];
                $ext=pathinfo($file_name, PATHINFO_EXTENSION);
                $file_temp= $_FILES["file"]["tmp_name"][$key];
                $file_store = "image/code".$id."_".$num.".".$ext;
                $num++;
                if(move_uploaded_file($file_temp,$file_store))
        {
            $sql2="insert into images values('$file_store', '$id')";  
            $query2=mysqli_query($connect,$sql2);
            if(!$query2)
        {
            die("Data couldnt be inserted ".mysqli_error($connect));
        }
            }
        }
        }
        echo "<br/>Your code has been posted. Please wait for the response <br/>";
        mysqli_close($connect);
    }
}
    if(!(listcodes()))
    {
        echo "<h3>No Discussions Yet</h3>";
    }
    require 'footer.php';
    ?>
    <script>
        function codeStyle()
        {
            var text1=document.getElementById("code").value;
            var text2="`  Enter your code here  `";
            document.getElementById("code").value=text1+text2;
            var length1=text1.length+3;
            var length2= length1+20;
            var input = document.getElementById('code');
            input.select();
            input.setSelectionRange(length1, length2);
        }
        </script>
</body>
</html>
<?php
$codeid=$_GET["code_Id"];
$replace = ["`  ","  `"];
$replaced = ["<pre><span class='codes'>","</span></pre>"];
function Code_info()
{
    global $codeid;
    global $replace;
    global $replaced;
    $retvalue=false;
    require 'db_connect.php';
    $sql1="Select * from codes where code_Id='$codeid' ";
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
    $result['description']=str_replace("<","&lt;",$result['description']);
    $result['description']=str_replace(">","&gt;",$result['description']);
    $result['code']=str_replace("<","&lt;",$result['code']);
    $result['code']=str_replace(">","&gt;",$result['code']);
    $result['code']=str_replace($replace ,$replaced,$result['code']);
        echo "<h1> $result[title]</h1>Posted By: <b>$result[Username]</b> on $result[time]<br/><br/>";
        echo "$result[description]<br/>";
        echo "$result[code]";
        $sql2="Select * from images where code_Id='$result[code_Id]' ";
    $query2=mysqli_query($connect,$sql2);
    if(!$query2)
    {
        echo("Images couldnt be retrieved ".mysqli_error($connect));
    }
    $rows1=mysqli_num_rows($query2);
if($rows1>0){
while($result2=mysqli_fetch_assoc($query2))
{
        echo "<img src=$result2[Image] width=900px height=700px >";
    }

}}
else
{
    echo "Code doesnt exist";
}
return $retvalue;
}
function post_review()
{
    global $codeid;
    echo <<< token1
        <h3>Post your review Here</h3>
        <form action=reviews.php?code_Id=$codeid] method=post  enctype =multipart/form-data>
        <input type=hidden name=check value=1/>
        <h3>Description</h3><textarea name=describe rows=5 cols=50 ></textarea><br/><br/>
        <h3>Code</h3>
        <input type="button" onclick="codeStyle()" value="code format"><br/>
        <textarea name=code id=code rows=20 cols=100 ></textarea><br/><br/>
        <h3>Select images</h3>
        <input type="file" name="file[]" multiple /><br/><br/>
		<button type=submit>Post</button>
token1;
}
function listreviews()
{
    $retvalue=false;
    global $codeid;
    global $replace;
    global $replaced;
    require 'db_connect.php';
    $sql1="Select * from reviews where code_Id='$codeid' ORDER BY review_id DESC ";
    $query1=mysqli_query($connect,$sql1);
    if(!$query1)
    {
        die("Query couldnt be processed ".mysqli_error($connect));
    }
    $rows=mysqli_num_rows($query1);
if($rows>0)
{
    $retvalue=true;  
    echo "<h2>View reviews</h2>";
    while($result=mysqli_fetch_assoc($query1))
    {
    $result['review_description']=str_replace("<","&lt;",$result['review_description']);
    $result['review_description']=str_replace(">","&gt;",$result['review_description']);
    $result['code']=str_replace("<","&lt;",$result['code']);
    $result['code']=str_replace(">","&gt;",$result['code']);
    $result['code']=str_replace($replace ,$replaced,$result['code']);
        echo "<img src=user.png width=30px height=18px style='float:left;'/><b>$result[Username]</b> at $result[Time]<br/><div class='nospace'>$result[review_description]<br/>$result[code]</div>";

        $sql2="Select * from review_images where review_id='$result[review_id]' ";
        $query2=mysqli_query($connect,$sql2);
        if(!$query2)
        {
            echo("Images couldnt be retrieved ".mysqli_error($connect));
        }
        $rows1=mysqli_num_rows($query2);
    if($rows1>0){
    while($result2=mysqli_fetch_assoc($query2))
    {
            echo "<img src=$result2[Image] width=900px height=700px ><br/>";
        }
    }
    if(isset($_SESSION["admin"]) || isset($_SESSION["user"]) && $_SESSION["user"]==$result["Username"])
        {
            echo "<a href=deletereview.php?review_id=$result[review_id]>Delete</a>";
        }
        echo "<br/>";
        echo "</div><hr style='height:1px;border-width:0;color:#ccc;background-color:#ccc'>";
    //echo "delete<br/>";
    }
   
}
return $retvalue;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .codeBox
{
	width : 98%;
	background-color: #ccc;
    word-wrap: break-word;
}
        </style>
</head>
<body>
    <?php
    require 'header.php';
    if(Code_info()){
        post_review();}
        if(isset($_POST["check"]))
        {
            if(!(isset($_SESSION["user"])) )
            {
                echo "<br/>You have to login to post";
            }
            else{
            require 'db_connect.php';
            $sql="insert into reviews(review_description , code, Username, code_Id) values('$_POST[describe]', '$_POST[code]', '$_SESSION[user]', '$_GET[code_Id]')";  
            $query=mysqli_query($connect,$sql);
            if(!$query)
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
                    $file_store = "image/review".$id."_".$num.".".$ext;
                    $num++;
                    if(move_uploaded_file($file_temp,$file_store))
            {
                $sql2="insert into review_images values('$file_store', '$id')";  
                $query2=mysqli_query($connect,$sql2);
                if(!$query2)
                {
                    echo "Image couldnt be uploaded<br/>";
                }
                }
            }
        }
            echo "<br/>Your review has been posted. <br/>";
            mysqli_close($connect);
        }
    }
        if(!(listreviews()))
        {
            echo "<h3>No Reviews Yet</h3>";
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
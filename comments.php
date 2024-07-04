<?php
$threadid=$_GET["thread_id"];
$replace = ["`  ","  `"];
$replaced = ["<pre><span class='codes'>","</span></pre>"]; 
function Thread_info()
{
    global $threadid;
    global $replace;
    global $replaced;
    $retvalue=false;
    require 'db_connect.php';
    $sql1="Select * from threads where thread_id='$threadid' ";
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
    $result['thread_description']=str_replace("<","&lt;",$result['thread_description']);
        $result['thread_description']=str_replace(">","&gt;",$result['thread_description']);
        $result['thread_description']=str_replace($replace ,$replaced,$result['thread_description']);
        echo "<h1> $result[thread_title]</h1>";
        echo "$result[thread_description]<br/>Posted By: <b>$result[Username]</b> on $result[Time]<br/><br/>";

}
else
{
    echo "Thread doesnt exist";
}
return $retvalue;
}
function post_comment()
{
    global $threadid;
    echo <<< token1
        <h3>Post your Comment Here</h3>
        <form action=comments.php?thread_id=$threadid] method=post>
        <input type=hidden name=check value=1/>
        <h3>Comment:</h3><input type="button" onclick="codeStyle()" value="code format"><br/><textarea name=describe id=describe rows=5 cols=50 ></textarea><br/><br/>
		<button type=submit>Post</button>
token1;
}
function listComments()
{
    $retvalue=false;
    global $threadid;
    global $replace;
    global $replaced;
    require 'db_connect.php';
    $sql1="Select * from comments where thread_id='$threadid' ORDER BY comment_id DESC";
    $query1=mysqli_query($connect,$sql1);
    if(!$query1)
    {
        die("Query couldnt be processed ".mysqli_error($connect));
    }
    $rows=mysqli_num_rows($query1);
if($rows>0)
{
    $retvalue=true; 
    echo "<h2>View Comments</h2>";
    while($result=mysqli_fetch_assoc($query1))
    {
        $result['comment_description']=str_replace("<","&lt;",$result['comment_description']);
        $result['comment_description']=str_replace(">","&gt;",$result['comment_description']);
        $result['comment_description']=str_replace($replace ,$replaced,$result['comment_description']);
        echo "<img src=user.png width=30px height=18px style='float:left;'/><b>$result[Username]</b> at $result[Time]<br/>$result[comment_description]";
        if(isset($_SESSION["admin"]) || isset($_SESSION["user"]) && $_SESSION["user"]==$result["Username"])
        {
            echo "<a href=deletecomment.php?comment_id=$result[comment_id]>Delete</a>";
        }
        echo "</div><hr style='height:1px;border-width:0;color:#ccc;background-color:#ccc'>";
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
    if(Thread_info()){
        post_comment();}
        if(isset($_POST["check"]))
        {
            if(!(isset($_SESSION["user"])) )
            {
                echo "<br/>You have to login to post";
            }
            else{
            require 'db_connect.php';
            $sql="insert into comments(comment_description , Username, thread_id) values('$_POST[describe]', '$_SESSION[user]', '$_GET[thread_id]')";  
            $query=mysqli_query($connect,$sql);
            if(!$query)
            {
                die("Data couldnt be inserted ".mysqli_error($connect));
            }
            echo "<br/>Your comment has been posted. <br/>";
            mysqli_close($connect);
        }
    }
        if(!(listComments()))
        {
            echo "<h3>No Comments Yet</h3>";
        }
        require 'footer.php';
    ?>
    <script>
        function codeStyle()
        {
            var text1=document.getElementById("describe").value;
            var text2="`  Enter your code here  `";
            document.getElementById("describe").value=text1+text2;
            var length1=text1.length+3;
            var length2= length1+20;
            var input = document.getElementById('describe');
            input.select();
            input.setSelectionRange(length1, length2);
        }
        </script>
</body>
</html>
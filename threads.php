<?php
$categoryname=$_GET["category"];
function Category_info()
{
    global $categoryname;
    $retvalue=false;
    require 'db_connect.php';
    $sql1="Select * from category where Category_name='$categoryname'  ";
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
        echo "<h1> Welcome to $result[Category_name] Forums</h1>";
        echo "$result[Category_description]<br/>";

}
else
{
    echo "<center><h2>Category \"$categoryname\" doesnt exist</h2></center>";
    exit;
}
return $retvalue;
}
function post_question()
{
    global $categoryname;
    echo <<< token1
        <h3>Post your Query Here</h3>
        <form action=threads.php?category=$categoryname method=post>
        <input type=hidden name=check value=1/>
        <h3>Title</h3><textarea name=title rows=1 cols=50 ></textarea><br/><br/>
        <h3>Description</h3>
        <input type="button" onclick="codeStyle()" value="code format"><br/>
        <textarea name=describe id="describe" rows=5 cols=50 ></textarea><br/><br/>
		<button type=submit>Post</button>
        </form>
token1;
}
function listThreads()
{
    $retvalue=false;
    global $categoryname;
    require 'db_connect.php';
    $sql1="Select * from threads where Category_name='$categoryname' ORDER BY thread_id DESC";
    $query1=mysqli_query($connect,$sql1);
    if(!$query1)
    {
        die("Query couldnt be processed ".mysqli_error($connect));
    }
    $rows=mysqli_num_rows($query1);
if($rows>0)
{
    $retvalue=true;  
    echo "<h2>View Discussions</h2>";
    $replace = ["`  ","  `"];
    $replaced = ["<code><span class='codes'>","</span></code>"];
    while($result=mysqli_fetch_assoc($query1))
    {
        $result['thread_description']=str_replace("<","&lt;",$result['thread_description']);
        $result['thread_description']=str_replace(">","&gt;",$result['thread_description']);
        $result['thread_description']=str_replace($replace ,$replaced,$result['thread_description']);
        echo "<div class='individual'><img src=user.png width=30px height=18px style='float:left;'/><b>$result[Username]</b> at $result[Time]<br/> <a href=comments.php?thread_id=$result[thread_id]>$result[thread_title]</a><br/><div class='codeBox'> ".wordwrap($result['thread_description'],480,'<br>')."</div><a href=comments.php?thread_id=$result[thread_id]>Join Discussion</a> ";
        if(isset($_SESSION["admin"]) || isset($_SESSION["user"]) && $_SESSION["user"]==$result["Username"])
        {
            echo "<a href=delete.php?thread_id=$result[thread_id]>Delete</a>";
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

        </style>
</head>
<body>
    <?php
    require 'header.php';
    if(Category_info()){
    post_question();}
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
        $sql="insert into threads(thread_title, thread_description , Username, Category_name) values('$_POST[title]', '$_POST[describe]', '$_SESSION[user]', '$_GET[category]')";  
        $query=mysqli_query($connect,$sql);
        if(!$query)
        {
            die("Data couldnt be inserted ".mysqli_error($connect));
        }
        echo "<br/>Your question has been posted. You will be notified if someone responds <br/>";
        mysqli_close($connect);
    }
}
    if(!(listThreads()))
    {
        echo "<h3>No Discussions Yet</h3>";
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
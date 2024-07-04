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
    ?><br/>
    <img src="images/codeimg2.avif" width="100%" height="550px" alt="Banner" />
    <div id="categories">
	<div class="box"><h2>View by categories</h2></div>
    <?php
    require 'db_connect.php';
    $sql1="Select * from category";
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
        echo "<div class=box><h3><a href=threads.php?category=$result[Category_name]> $result[Category_name]</a></h3></div>";
    }
}
	?>
	
</div>
	<div id="intro"><h2>Introduction to us</h2>
		<p>To ensure the best possible experience for all members, we have established some basic guidelines for participation. By joining and using these forum, you agree that you have read and will follow the rules and guidelines set for these peer discussion groups .You also agree to reserve forum discussions for topics best suited to the medium. This is a great medium with which to solicit the advice of your peers, benefit from their experience, and participate in an ongoing conversation..</p>
		
 <h3>  Rules</h3>
 Don’t challenge or attack others. The discussions on the forum are meant to stimulate conversation, not to create contention. Let others have their say, just as you may.All defamatory, abusive, profane, threatening, offensive, or illegal materials are strictly prohibited. State concisely and clearly the topic of your comments in the subject line. This allows members to respond more appropriately to your posting and makes it easier for members to search the archives by subject.Don’t post commercial messages. Contact people directly with product and service information if you believe it would help them.All defamatory, abusive, profane, threatening, offensive, or illegal materials are strictly prohibited.
<div id="read"><a href="website.xhtml" target="_blank">Read more....</a></div>
</div>
<br/>
<br/>
<br/>
<div class="main">
    <h2>Categories</h2>
    <hr/>
    <?php
    require 'db_connect.php';
    $sql1="Select * from category";
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
        echo "<div class=picture><img src=$result[Image_url] width= 300px height= 300px/><br/>";
        echo "<div class=info> <b>$result[Category_name]</b><br/>".substr($result["Category_description"],0,80)."... <br/>";
        echo "<div class=add><a href=threads.php?category=$result[Category_name] >Discussions</a> || <a href=codes.php?category=$result[Category_name] >Reviews</a><br/></div></div></div>";
    }
}
    ?>
    <?php require 'footer.php';?>
</body>
</html>
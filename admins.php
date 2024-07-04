<?php
echo <<< token
<style>
#Panel
{
width: 15%;
float: left;
/*border: 4px solid black;*/
}
#Panel a:hover
{
color: #ccc;
}
hr
{
border: 1px solid black;
}
.lines
{
    width : 5%;
    float : right;
    height : 680px;
    border-left: 2px solid black;
}
.middle
{
width : 77.5%;
float : right;
/*border-left: 2px solid black;
height : 550px;*/
}
</style>
token;
 require 'header.php';
 require 'alladmin.php';
echo "<hr/>";
    echo "<div id=Panel>";
    echo "<div class=box><h3><a href=admin.php>Admin Panel</a></h3></div>";
    echo "<div class=box><h3><a href=Categories.php>Categories</a></h3></div>";
    echo "<div class=box><h3><a href=addCategories.php>Add Category</a></h3></div>";
    echo "<div class=box><h3><a href=User.php>Users</a></h3></div>";
    echo "<div class=box><h3><a href=Post.php>Posts</a></h3></div>";
    echo "<div class=box><h3><a href=adminComment.php>Comments</a></h3></div>";
    echo "<div class=box><h3><a href=adminCode.php>Codes</a></h3></div>";
    echo "<div class=box><h3><a href=adminReviews.php>Reviews</a></h3></div>";
    echo "<div class=box><h3><a href=settings.php>Settings</a></h3></div></div>";
   
    /*echo "<div class=middle> <h2 >Hi Admin</h2></div>";*/
    ?>

<head>
<style>
    table
    {
        margin-left: auto;
        margin-right: auto;
    }
    </style>
</head>
<?php
    require 'headers.php';
    require 'userall.php';
    require 'db_connect.php';
    echo <<< token1
    <div class =centerall>
    <br/>
    <table border=1px width=70%;>
    <tr>
    <td><a href=Users.php>My Profile</a></td>
    <td><a href=myposts.php>My Posts</a></td>
    <td><a href=mycomments.php>My Comments</a></td>
    <td><a href=mycodes.php>My Codes</a></td>
    <td><a href=myreviews.php>My reviews</a></td>
    <td><a href=Notifications.php>My Notifications(1)</a></td>
    </tr>
    </table>
    token1;
    ?>
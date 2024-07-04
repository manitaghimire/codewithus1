<?php
    $connect=mysqli_connect("localhost","root","","Project");
    if(!$connect)
    {
        die("Connection failed ".mysqli_connect_error());
    }
    ?>
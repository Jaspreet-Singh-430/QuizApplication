<?php
$servername = 'localhost';
$user = 'root';
$password = '';
$conn = mysqli_connect($servername, $user, $password, 'project');
if (!$conn)
    die("connection failed " . mysqli_connect_error());
else
    ;
?>
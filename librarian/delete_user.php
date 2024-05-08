<?php
include('dbcon.php');

$id=$_GET['id'];
mysqli_connect("localhost", "root", "ms388699", "eb_lms");
mysql_query("delete from users where user_id='$id'") or die(mysql_error());

header('location:users.php');
?>
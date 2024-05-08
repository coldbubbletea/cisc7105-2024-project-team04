<?php
include('dbcon.php');
$id=$_GET['id'];
$conn = mysqli_connect("127.0.0.1", "root", "", "eb_lms"); 
mysqli_query($conn, "delete from member where member_id='$id'") or die(mysql_error());
header('location:member.php');
?>
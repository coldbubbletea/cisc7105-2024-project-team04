<?php
include('dbcon.php');
$id=$_GET['id'];
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_query($conn, "update book set status = 'Archive' where book_id='$id'")or die(mysql_error());
header('location:books.php');
?>
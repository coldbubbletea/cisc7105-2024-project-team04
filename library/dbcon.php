<?php
$servername = "localhost";  
$username = "root";  
$password = "ms388699";  
$dbname = "eb_lms";  
  
// 创建连接  
$conn = new mysqli($servername, $username, $password, $dbname);  
  
// 检查连接  
if ($conn->connect_error) {  
    die("连接失败: " . $conn->connect_error);  
} 
?>
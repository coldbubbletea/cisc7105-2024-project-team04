<?php include('header.php'); ?>
<?php include('navbar.php'); ?>
    <div class="container">
		<div class="margin-top">
			<div class="row">	
			<div class="span12">
					<div class="sti">
						<img src="../LMS/vit.png" class="img-rounded">
					</div>
				<div class="login">
				<div class="log_txt">
				<p><strong>Please Enter the Details Below..</strong></p>
				</div>
						<form class="form-horizontal" method="POST">
								<div class="control-group">
									<label class="control-label" for="inputEmail">Username</label>
									<div class="controls">
									<input type="text" name="username" id="username" placeholder="Username" required>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="inputPassword">Password</label>
									<div class="controls">
									<input type="password" name="password" id="password" placeholder="Password" required>
								</div>
								</div>
								<div class="control-group">
									<div class="controls">
									<button id="login" name="submit" type="submit" class="btn"><i class="icon-signin icon-large"></i>&nbsp;Submit</button>
								</div>
								</div>
								
								<?php
								session_start(); // 开始会话，应放在所有输出之前  
  
								// 假设您已经有一个名为$mysqli的mysqli连接对象  
								$mysqli = new mysqli("127.0.0.1", "root", "", "eb_lms");  
								  
								// 检查连接  
								if ($mysqli->connect_error) {  
									die("连接失败: " . $mysqli->connect_error);  
								} 
								if (isset($_POST['submit'])) {  
									$username = $_POST['username'];  
									$password = $_POST['password'];  
								  
									// 准备查询语句（使用预处理语句防止SQL注入）  
									$stmt = $mysqli->prepare("SELECT * FROM users WHERE username=? AND password=?");  
									$stmt->bind_param("ss", $username, $password);  
									$stmt->execute();  
									$result = $stmt->get_result();  
								  
									if ($result->num_rows > 0) {  
										// 登录成功  
										$row = $result->fetch_assoc();  
										$_SESSION['id'] = $row['user_id'];  
										header('Location: dashboard.php');  
										exit; // 确保重定向后停止脚本执行  
									} else {  
										// 登录失败  
										$login_error = "Access Denied";  
									}  
								}
								?>
						</form>
				
				</div>
			</div>		
			</div>
		</div>
    </div>
<?php include('footer.php') ?>
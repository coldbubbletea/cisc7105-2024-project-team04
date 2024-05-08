	<div id="add_user" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-body">
			<div class="alert alert-info"><strong>Add User</strong></div>
	<form class="form-horizontal" method="post">
			<div class="control-group">
				<label class="control-label" for="inputEmail">Username</label>
				<div class="controls">
				<input type="text" id="inputEmail" name="username" placeholder="Username" required>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="inputPassword">Password</label>
				<div class="controls">
				<input type="password" name="password" id="inputPassword" placeholder="Password" required>
				</div>
			</div>
				<div class="control-group">
				<label class="control-label" for="inputEmail">Firstname</label>
				<div class="controls">
				<input type="text" id="inputEmail" name="firstname" placeholder="Username" required>
				</div>
			</div>
				<div class="control-group">
				<label class="control-label" for="inputEmail">Lastname</label>
				<div class="controls">
				<input type="text" id="inputEmail" name="lastname" placeholder="Username" required>
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
				<button name="submit" type="submit" class="btn btn-success"><i class="icon-save icon-large"></i>&nbsp;Save</button>
				</div>
			</div>
    </form>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i>&nbsp;Close</button>
		</div>
    </div>
	
	<?php 
	$pdo = new PDO('mysql:host=127.0.0.1;dbname=eb_lms', 'root', '');
if (isset($_POST['submit'])) {  
    $username = $_POST['username'];  
    $password = $_POST['password'];  
    $firstname = $_POST['firstname'];  
    $lastname = $_POST['lastname'];  
  
  
    // 准备预处理语句  
    $stmt = $pdo->prepare("INSERT INTO users (username, password, firstname, lastname) VALUES (:username, :password, :firstname, :lastname)");  
      
    // 绑定参数并执行  
    $stmt->bindParam(':username', $username);  
    $stmt->bindParam(':password', $hashedPassword);  
    $stmt->bindParam(':firstname', $firstname);  
    $stmt->bindParam(':lastname', $lastname);  
    $stmt->execute();  
  
    // 处理成功的情况，例如重定向到另一个页面  
    header('Location: user.php');  
    exit;  
}  
?>
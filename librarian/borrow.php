<?php include('header.php'); ?>
<?php include('session.php'); ?>
<?php include('navbar_borrow.php'); ?>
    <div class="container">
		<div class="margin-top">
			<div class="row">	
								<div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong><i class="icon-user icon-large"></i>&nbsp;Borrow Table</strong>
                                </div>

		<div class="span12">		

		<form method="post" action="borrow_save.php">
<div class="span3">

											<div class="control-group">
				<label class="control-label" for="inputEmail">Borrower Name</label>
				<div class="controls">  
					<select name="member_id" class="chzn-select" required>  
						<option></option>  
						<?php  
						// 使用mysqli或PDO替换mysql_*函数  
						$connection = mysqli_connect("localhost", "root", "ms388699", "eb_lms");  
						if (!$connection) {  
							die("Connection failed: " . mysqli_connect_error());  
						}  
						
						$result = mysqli_query($connection, "SELECT * FROM member");  
						if (!$result) {  
							die("Query failed: " . mysqli_error($connection));  
						}  
						
						while ($row = mysqli_fetch_assoc($result)) {  
							// 检查$row是否包含需要的键  
							if (isset($row['member_id'], $row['firstname'], $row['lastname'])) {  
								echo "<option value=\"{$row['member_id']}\">{$row['firstname']} {$row['lastname']}</option>";  
							}  
						}  
						
						mysqli_free_result($result);  
						// mysqli_close($connection);  
						?>  
					</select>  
				</div>
			</div>
				<div class="control-group"> 
					<label class="control-label" for="inputEmail">Due Date</label>
					<div class="controls">
					<input type="text"  class="w8em format-d-m-y highlight-days-67 range-low-today" name="due_date" id="sd" maxlength="10" style="border: 3px double #CCCCCC;" required/>
					</div>
				</div>
				<div class="control-group"> 
					<div class="controls">

								<button name="delete_student" class="btn btn-default">Borrow</button>
					</div>
				</div>
				</div>
				<div class="span8">
						<div class="alert alert-success"><strong>Select Book</strong></div>
                            <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">

                                <thead>
                                    <tr>
                       
                                        <th>Acc No.</th>                                 
                                        <th>Book title</th>                                 
                                        <th>Category</th>
										<th>Author</th>
										<th>Publisher name</th>
										<th>status</th>
										<th>Add</th>
										
                                    </tr>
                                </thead>
                                <tbody>  
									<?php  
									// 假设你已经建立了 mysqli 连接，这里用 $conn 表示  
									$user_query = $connection->query("SELECT b.*, c.classname FROM book b JOIN category c ON b.category_id = c.category_id WHERE b.status != 'Archive'");  
									if (!$user_query) {  
										die("Query failed: " . $connection->error);  
									}  
									while ($row = $user_query->fetch_assoc()) {  
										$id = $row['book_id'];  
										$cat_classname = $row['classname']; // 直接从 JOIN 查询中获取分类名称  
									?>  
									<tr class="del<?php echo $id ?>">  
										<td><?php echo $row['book_id']; ?></td>  
										<td><?php echo htmlspecialchars($row['book_title']); ?></td>  
										<td><?php echo htmlspecialchars($cat_classname); ?></td>  
										<td><?php echo htmlspecialchars($row['author']); ?></td>  
										<td><?php echo htmlspecialchars($row['publisher_name']); ?></td>  
										<td><?php echo htmlspecialchars($row['status']); ?></td>  
										<!-- 假设 'toolttip_edit_delete.php' 包含了必要的编辑和删除功能 -->  
										<?php include('toolttip_edit_delete.php'); ?>  
										<td width="20">  
											<input id="" class="uniform_on" name="selector[]" type="checkbox" value="<?php echo $id; ?>">  
										</td>  
									</tr>  
									<?php  
									}  
									$user_query->close(); // 关闭结果集  
									?>  
								</tbody>
                            </table>
							
			    </form>
			</div>		
			</div>		
<script>		
$(".uniform_on").change(function(){
    var max= 3;
    if( $(".uniform_on:checked").length == max ){
	
        $(".uniform_on").attr('disabled', 'disabled');
		         alert('3 Books are allowed per borrow');
        $(".uniform_on:checked").removeAttr('disabled');
		
    }else{

         $(".uniform_on").removeAttr('disabled');
    }
})
</script>		
			</div>
		</div>
    </div>
<?php include('footer.php') ?>
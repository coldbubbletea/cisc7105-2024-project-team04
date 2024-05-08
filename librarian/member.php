<?php include('header.php'); ?>
<?php include('session.php'); ?>
<?php include('navbar_member.php'); ?>
    <div class="container">
		<div class="margin-top">
			<div class="row">	
			<div class="span12">	
			   <div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong><i class="icon-user icon-large"></i>&nbsp;Member Table</strong>
                                </div>
                            <table cellpadding="0" cellspacing="0" border="0" class="table  table-bordered" id="example">
                             
								<p><a href="add_member.php" class="btn-default">&nbsp;Add Member</a></p>
							
                                <thead>
                                    <tr>
                       
                                        <th>Name</th>                                 
                                        <th>Gender</th>
										<th>Address</th>
										<th>Contact</th>
										<th>Type</th>
										<th>Year level</th>
										<th>Status</th>
										<th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
								 
								<?php  
									// 假设您已经建立了数据库连接，并且该连接对象名为 $conn  
									$conn = mysqli_connect("127.0.0.1", "root", "", "eb_lms");  
									
									// 检查连接是否成功  
									if (!$conn) {  
										die("连接失败: " . mysqli_connect_error());  
									}  
									
									// 执行查询  
									$user_query = mysqli_query($conn, "SELECT * FROM member") or die(mysqli_error($conn));  
									
									// 遍历查询结果  
									while ($row = mysqli_fetch_array($user_query)) {  
										$id = $row['member_id'];  
										
										// 输出表格行  
										?>  
										<tr class="del<?php echo $id; ?>">  
											<td><?php echo htmlspecialchars($row['firstname']) . " " . htmlspecialchars($row['lastname']); ?></td>  
											<td><?php echo htmlspecialchars($row['gender']); ?></td>  
											<td><?php echo htmlspecialchars($row['address']); ?></td>  
											<td><?php echo htmlspecialchars($row['contact']); ?></td>  
											<td><?php echo htmlspecialchars($row['type']); ?></td>  
											<td><?php echo htmlspecialchars($row['year_level']); ?></td>  
											<td><?php echo htmlspecialchars($row['status']); ?></td>  
											
											<?php  
											// 假设 'toolttip_edit_delete.php' 和 'delete_student_modal.php' 文件是存在的，并且不需要传递任何额外的参数  
											include('toolttip_edit_delete.php');  
											include('delete_student_modal.php');  
											?>  
											
											<td width="100">  
												<div class="span2">  
													<a rel="tooltip" title="Delete" id="<?php echo $id; ?>" href="#delete_student<?php echo $id; ?>" data-toggle="modal" class="btn-default">  
														<i class="icon-trash icon-large"></i>  
													</a>  
												</div>  
												<div class="span1">  
													<a rel="tooltip" title="Edit" id="e<?php echo $id; ?>" href="edit_member.php?id=<?php echo $id; ?>" class="btn-default">  
														<i class="icon-pencil icon-large"></i>  
													</a>  
												</div>  
											</td>  
										</tr>  
										<?php  
									}  
									
									// 关闭查询结果集  
									mysqli_free_result($user_query);  
									
									// 关闭数据库连接  
									mysqli_close($conn);  
									?>
                           
                                </tbody>
                            </table>
							
			
			</div>		
			</div>
		</div>
    </div>
<?php include('footer.php') ?>
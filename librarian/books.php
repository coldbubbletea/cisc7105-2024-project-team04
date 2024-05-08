<?php include('header.php'); ?>
<?php include('session.php'); ?>
<?php include('navbar_books.php'); ?>
    <div class="container">
		<div class="margin-top">
			<div class="row">	
			<div class="span12">	
			   <div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong><i class="icon-user icon-large"></i>&nbsp;Books Table</strong>
                                </div>
						<!--  -->
								    <ul class="nav nav-pills nav-justified">
										<li   class="active"><a href="books.php">All</a></li>
										<li><a href="new_books.php">New Books</a></li>
										<li><a href="old_books.php">Old Books</a></li>
										<li><a href="lost.php">Lost Books</a></li>
										<li><a href="damage.php">Damage Books</a></li>
										<li><a href="sub_rep.php">Subject for Replacement</a></li>
									</ul>
						<!--  -->
						<center class="title">
						<h1>Books List</h1>
						</center>
                            <table cellpadding="0" cellspacing="0" border="0" class="table  table-bordered" id="example">
								<div class="pull-right">
								<a href="" onclick="window.print()" class="btn-deafult"></i> Print</a>
								</div>
								<p><a href="add_books.php" class="btn-default">&nbsp;Add Books</a></p>
							
                                <thead>
                                    <tr>
									    <th>Acc No.</th>                                 
                                        <th>Book Title</th>                                 
                                        <th>Category</th>
										<th>Author</th>
										<th class="action">copies</th>
										<th>Book Pub</th>
										<th>Publisher Name</th>
										<th>ISBN</th>
										<th>Copyright Year</th>
										<th>Date Added</th>
										<th>Status</th>
										<th class="action">Action</th>		
                                    </tr>
                                </thead>
                                <tbody>
								 
								<?php  
									// 假设你已经有了一个有效的数据库连接对象 $mysqli  
									$mysqli = new mysqli("127.0.0.1", "root", "", "eb_lms");  
									
									// 检查连接是否成功  
									if ($mysqli->connect_error) {  
										die("连接失败: " . $mysqli->connect_error);  
									}  
									
									// 查询未归档的书籍  
									$user_query = $mysqli->query("SELECT * FROM book WHERE status != 'Archive'");  
									if (!$user_query) {  
										die("查询失败: " . $mysqli->error);  
									}  
									
									while ($row = $user_query->fetch_array(MYSQLI_ASSOC)) {  
										$id = $row['book_id'];  
										$cat_id = $row['category_id'];  
										$book_copies = $row['book_copies'];  
									
										// 查询待处理的借阅详情  
										$borrow_details_query = $mysqli->prepare("SELECT * FROM borrowdetails WHERE book_id = ? AND borrow_status = 'pending'");  
										$borrow_details_query->bind_param("i", $id);  
										$borrow_details_query->execute();  
										$borrow_details_result = $borrow_details_query->get_result();  
										$count = $borrow_details_result->num_rows;  
									
										// 计算剩余书籍数量  
										$total = $book_copies - $count;  
									
										// 查询书籍类别  
										$cat_query = $mysqli->prepare("SELECT * FROM category WHERE category_id = ?");  
										$cat_query->bind_param("i", $cat_id);  
										$cat_query->execute();  
										$cat_result = $cat_query->get_result();  
										$cat_row = $cat_result->fetch_array(MYSQLI_ASSOC);  
									?>  
									<tr class="del<?php echo $id ?>">
										<td><?php echo htmlspecialchars($row['book_id']); ?></td>  
										<td><?php echo htmlspecialchars($row['book_title']); ?></td>  
										<td><?php echo htmlspecialchars($cat_row['classname']); ?></td>  
										<td><?php echo htmlspecialchars($row['author']); ?></td>  
										<td class="action"><?php echo htmlspecialchars($total); ?></td>  
										<td><?php echo htmlspecialchars($row['book_pub']); ?></td>  
										<td><?php echo htmlspecialchars($row['publisher_name']); ?></td>  
										<td><?php echo htmlspecialchars($row['isbn']); ?></td>  
										<td><?php echo htmlspecialchars($row['copyright_year']); ?></td>  
										<td><?php echo htmlspecialchars($row['date_added']); ?></td>  
										<td><?php echo htmlspecialchars($row['status']); ?></td>  
									<?php include('toolttip_edit_delete.php'); ?>
                                    <td class="action">
									<div class="span2">
                                        <a rel="tooltip"  title="Delete" id="<?php echo $id; ?>" href="#delete_book<?php echo $id; ?>" data-toggle="modal"    class="btn-default"><i class="icon-trash icon-large"></i></a>
                                        <?php include('delete_book_modal.php'); ?>
										<div class="span1">
										<a  rel="tooltip"  title="Edit" id="e<?php echo $id; ?>" href="edit_book.php<?php echo '?id='.$id; ?>" class="btn-default"><i class="icon-pencil icon-large"></i></a>
										</div></div>
                                    </td>
									
                                    </tr>
									<?php  }  ?>
                           
                                </tbody>
                            </table>
							
			
			</div>		
			</div>
		</div>
    </div>
<?php include('footer.php') ?>
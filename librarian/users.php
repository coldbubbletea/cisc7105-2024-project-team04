<?php include('header.php'); ?>
<?php include('session.php'); ?>
<?php include('navbar_user.php'); ?>
    <div class="container">
		<div class="margin-top">
			<div class="row">	
			<div class="span2">			     
										<ul class="nav nav-stacked">
											<li>
											<a href="#add_user" data-toggle="modal" >&nbsp;<strong>Add User</strong></a>
											</li>
										</ul>
										
										 
     <!-- Modal add user -->
	<?php include('modal_add_user.php'); ?>
										
			</div>
			<div class="span10">
			
			
					
                            <table cellpadding="0" cellspacing="0" border="0" class="table  table-bordered" id="example">
                                <div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong><i class="icon-user icon-large"></i>&nbsp;Users Table</strong>
                                </div>
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Password</th>                                 
                                        <th>Firstname</th>                                 
                                        <th>Lastname</th>                                 
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                  <?php $user_query = $conn->query("SELECT user_id, username, password, firstname, lastname FROM users");  
                                    if (!$user_query) {  
                                        die("Query failed: " . $conn->error);  
                                    }  
  
                                    // 只在页面加载时包含模态框模板  
                                    include('modal_template.php'); // 假设这里包含了一个通用的模态框模板  
                                    
                                    echo '<tbody>';  
                                    while ($row = $user_query->fetch_assoc()) {  
                                        $id = $row['user_id'];  
                                        echo '<tr class="del' . htmlspecialchars($id) . '">';  
                                        echo '<td>' . htmlspecialchars($row['username']) . '</td>';
                                        echo '<td>' . htmlspecialchars($row['password']) . '</td>';  
                                        echo '<td>' . htmlspecialchars($row['firstname']) . '</td>';  
                                        echo '<td>' . htmlspecialchars($row['lastname']) . '</td>';  
                                        echo '<td width="100">';  
                                        echo '<div class="span2">';  
                                        echo '<button type="button" class="btn-default delete-user" data-id="' . htmlspecialchars($id) . '" data-toggle="modal" data-target="#deleteUserModal">Delete</button>';  
                                        echo '</div>';  
                                        echo '<div class="span1">';  
                                        echo '<button type="button" class="btn-default edit-user" data-id="' . htmlspecialchars($id) . '" data-toggle="modal" data-target="#editUserModal">Edit</button>';  
                                        echo '</div>';  
                                        echo '</td>';  
                                        echo '</tr>';  
                                    }  
                                    echo '</tbody>'; ?>
                            </table>
							
<script type="text/javascript">
/*         $(document).ready( function() {
            $('.btn-danger').click( function() {
                var id = $(this).attr("id");
                if(confirm("Are you sure you want to delete this Data?")){
                    $.ajax({
                        type: "POST",
                        url: "delete_user.php",
                        data: ({id: id}),
                        cache: false,
                        success: function(html){
                        $(".del"+id).fadeOut('slow'); 
                        } 
                    }); 
                }else{
                    return false;}
            });				
        }); */
    </script>

			
			</div>		
			</div>
		</div>
    </div>
	</br></br></br></br></br></br></br></br></br></br></br></br>
<?php include('footer.php') ?>
<!-- Made by Vinit Shahdeo -->
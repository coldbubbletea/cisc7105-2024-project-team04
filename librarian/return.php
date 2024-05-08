<?php include('header.php'); ?>
<?php include('session.php'); ?>
<?php include('navbar_borrow.php'); ?>
    <div class="container">
		<div class="margin-top">
			<div class="row">	
				<div class="span12">		
						<div class="alert alert-danger"><strong>Returned Books</strong></div>
                            <table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
								<div class="pull-right">
								<a href="" onclick="window.print()" class="btn-default"> Print</a>
								</div>
                                <thead>
                                    <tr>
                                        <th>Book title</th>                                 
                                        <th>Borrower</th>                                 
                                        <th>Year Level</th>                                 
                                        <th>Date Borrow</th>                                 
                                        <th>Due Date</th>                                
                                        <th>Date Returned</th>

                                    </tr>
                                </thead>
                                <tbody>  
                                <?php  
                                $mysqli = new mysqli("localhost", "root", "ms388699", "eb_lms");  
  
                                if ($mysqli->connect_errno) {  
                                    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;  
                                    exit();  
                                } 
                                $query = "SELECT b.book_title, m.firstname, m.lastname, m.year_level, date_borrow, due_date, bd.date_return, bd.borrow_details_id, bd.borrow_id, b.book_id    
                                FROM borrow    
                                INNER JOIN borrowdetails bd ON borrow.borrow_id = bd.borrow_id    
                                INNER JOIN member m ON borrow.member_id = m.member_id    
                                INNER JOIN book b ON bd.book_id = b.book_id    
                                WHERE bd.borrow_status = 'returned'    
                                ORDER BY borrow.borrow_id DESC";     
                                  
                                if ($result = $mysqli->query($query)) {  
                                    while ($row = $result->fetch_assoc()) {  
                                        $id = $row['borrow_id'];  
                                        $book_id = $row['book_id'];  
                                        $borrow_details_id = $row['borrow_details_id']; }
                                        ?>  
                                    <tr class="del<?php echo htmlspecialchars($id); ?>">  
                                        <td><?php if (isset($row['book_title'])) echo htmlspecialchars($row['book_title']); else echo 'N/A'; ?></td>  
                                        <td><?php if (isset($row['firstname']) && isset($row['lastname'])) echo htmlspecialchars($row['firstname'] . " " . $row['lastname']); else echo 'N/A'; ?></td>  
                                        <td><?php if (isset($row['year_level'])) echo htmlspecialchars($row['year_level']); else echo 'N/A'; ?></td>  
                                        <td><?php if (isset($row['date_borrow'])) echo htmlspecialchars($row['date_borrow']); else echo 'N/A'; ?></td>  
                                        <td><?php if (isset($row['due_date'])) echo htmlspecialchars($row['due_date']); else echo 'N/A'; ?></td>  
                                        <td><?php if (isset($row['date_return'])) echo htmlspecialchars($row['date_return']); else echo 'N/A'; ?></td>  
                                        <td></td>  
                                    </tr>  
                                    <?php  
                                }  
                                
                                // 释放结果集  
                                $user_query->free();  
                                ?>  
                                </tbody>
                            </table>
							

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
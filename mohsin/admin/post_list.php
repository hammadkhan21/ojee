<?php session_start();
	include 'includes/db.php';
	if(isset($_SESSION['user']) && isset($_SESSION['password']) == true){
		$sel_sql = "SELECT * FROM admin WHERE user_email = '$_SESSION[user]' AND user_password = '$_SESSION[password]'";
		if($run_sql = mysqli_query($conn, $sel_sql)){
			while($rows = mysqli_fetch_assoc($run_sql)){
				if(mysqli_num_rows($run_sql) == 1 ){
					if($rows['role'] == 'admin'){
					} else {
						header('Location:../index.php');
					}
				} else{
					header('Location:../index.php');
				}
			}
		}
	} else {
		header('Location:../index.php');
	}
	$result = '';
	if(isset($_GET['new_status'])){
		$new_status =$_GET['new_status'];
		$sql = "UPDATE posts SET product_status='$new_status' WHERE post_id =  $_GET[id] ";
		if($run = mysqli_query($conn,$sql)){
			$result = '<div class="alert alert-success">We Just Updated the Status</div>';
		}
	}
	if(isset($_GET['del_id'])){
		$del_id = $_GET['del_id'];
		$sql = "DELETE FROM posts WHERE post_id = '$del_id'";
		if($run = mysqli_query($conn,$sql)){
			$result = '<div class="alert alert-danger">You Deleted Row no. '.$del_id.' from Database</div>';
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Admin Panel</title>
		<link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
		<script src="../js/jquery.js"></script>
		<script src="../bootstrap/js/bootstrap.js"></script>
	</head>
	<body>
		<?php include 'includes/header.php';?>
		<div style="width:50px;height:50px;"></div>
		<?php include 'includes/sidebar.php';?>
		<div class="col-lg-10">
		<div style="width:50px;height:50px;"></div>
		<?php 
			echo $result;
		?>
			<!------ Users Area --->
			<!------ Post lists Starts----->
			<div class="panel panel-primary">
				<div class="panel-heading"><h3>Posts</h3></div>
				<div class="panel-body">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>S.No</th>
								<th>Date</th>
								<th>Title</th>
								<th>Description</th>
								<th>Category</th>
								<th>Original Price</th>
								<th>Deal Price</th>
								<th>Cost Price</th>
								<th>status</th>
								<th>Action</th>
								<th>Edit Post</th>
								<th>View Post</th>
								<th>Delete Post</th>
							</tr>
						</thead>
						<tbody>
							<?php
								//$sql = "SELECT * FROM posts ORDER BY ID DESC";
								$sql = "SELECT * FROM posts";
								//$sql = "SELECT * FROM posts p JOIN users u ON p.author = u.user_email";
								$run = mysqli_query($conn,$sql);
								$number = 1;
								while($rows = mysqli_fetch_assoc($run)){
									$c_sql = "SELECT * FROM categories WHERE cat_id = '$rows[post_category]'";
									$c_run = mysqli_query($conn, $c_sql);
									
									echo "
									<tr>
										<td>$number</td>
										<td>$rows[post_time]</td>
										<td>$rows[post_heading]</td>
										<td>".substr(strip_tags($rows['post_description']),0,50)."....</td>";
										while($c_rows = mysqli_fetch_assoc($c_run)){
										
											if($rows['post_category'] != ''){
												echo '<td>'.$c_rows['cat_name'].'</td>';
											} else {
												echo '<td>s</td>';
											}
										}
										
										echo "<td>$rows[post_retail]</td>
										<td>$rows[post_offer_price]</td>
										<td>$rows[post_cost]</td>
										<td>".($rows['product_status'] == '0'? 'Draft': 'Published')."</td>
										<td>
											".($rows['product_status'] == '0'? "<a href='post_list.php?new_status=1&id=$rows[post_id]' class='btn btn-primary btn-xs navbar-btn'>Publish</a>" : "<a href='post_list.php?new_status=0&id=$rows[post_id]' class='btn btn-info btn-xs navbar-btn'>Draft</a>")."
										</td>
										<td>
											<a href='edit_post.php?edit_id=$rows[post_id]' class='btn btn-warning btn-xs navbar-btn'>Edit</a>
										</td>
										<td><a href='../deal.php?post_id=$rows[post_id]&title=$rows[post_url]' class='btn btn-success btn-xs navbar-btn' target='_blank'>View</a></td>
										<td><a href='post_list.php?del_id=$rows[post_id]' class='btn btn-danger btn-xs navbar-btn'>Delete</a></td>
									</tr>
									";
								$number++;	
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="text-center">
				<ul class="pagination">
					<li><a href="#">1</a></li>
					<li><a href="#">2</a></li>
					<li><a href="#">3</a></li>
					<li><a href="#">4</a></li>
					<li><a href="#">5</a></li>
					<li><a href="#">6</a></li>
				</ul>
			</div>
		</div>
		<footer></footer>
	</body>
</html>
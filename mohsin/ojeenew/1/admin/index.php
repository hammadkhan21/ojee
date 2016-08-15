<?php session_start();
	include 'includes/db.php';
	if(isset($_SESSION['user']) && isset($_SESSION['password']) == true){
		$sel_sql = "SELECT * FROM users WHERE user_email = '$_SESSION[user]' AND user_password = '$_SESSION[password]'";
		if($run_sql = mysqli_query($conn, $sel_sql)){
			while($rows = mysqli_fetch_assoc($run_sql)){
				$name = $rows['f_name'].' '.$rows['l_name'];
				$job = $rows['user_designation'];
				$gender = $rows['user_gender'];
				$contact_no = $rows['user_phone_no'];
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
		header('Location:../accounts/login.php');
	} 
	//// Counting Posts
	$sql = "SELECT * FROM posts WHERE product_status = '1'";
	$run = mysqli_query($conn,$sql);
	$total_posts = mysqli_num_rows($run);
	
	/// Counting Admins
	
	$sql = "SELECT * FROM admin";
	$run = mysqli_query($conn,$sql);
	$total_categories = mysqli_num_rows($run);
	///Counting Users
	
	$sql = "SELECT * FROM users";
	$run = mysqli_query($conn,$sql);
	$total_users = mysqli_num_rows($run);
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
		<?php 
			include 'includes/header.php';
			include 'includes/sidebar.php';
		?>
		<div class="col-lg-10">
		<div style="width:50px;height:50px;"></div>
			<div class="col-md-3">
				
				<div class="panel panel-danger">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3"><i class="glyphicon glyphicon-tags" style="font-size:4.5em"></i></div>
							<div class="col-xs-9 text-right">
								<div style="font-size:2.5em"><?php echo $total_posts; ?></div>
								<div>Items</div>
							</div>
						</div>
					</div>
					<a href="post_list.php">
						<div class="panel-footer">
							<div class="pull-left">View Posts</div>
							<div class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></div>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			
			<div class="col-md-3">
				<div class="panel panel-success">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3"><i class="glyphicon glyphicon-user" style="font-size:4.5em"></i></div>
							<div class="col-xs-9 text-right">
								<div style="font-size:2.5em"><?php echo $total_categories; ?></div>
								<div>Admins</div>
							</div>
						</div>
					</div>
					<a href="category_list.php">
						<div class="panel-footer">
							<div class="pull-left">Veiw Admins</div>
							<div class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></div>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			
			<div class="col-md-3">
				<div class="panel panel-warning">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3"><i class="glyphicon glyphicon-user" style="font-size:4.5em"></i></div>
							<div class="col-xs-9 text-right">
								<div style="font-size:2.5em"><?php echo $total_users; ?></div>
								<div>Users</div>
							</div>
						</div>
					</div>
					<a href="#">
						<div class="panel-footer">
							<div class="pull-left">View Users</div>
							<div class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></div>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			
			<div class="col-md-3">
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3"><i class="glyphicon glyphicon-shopping-cart" style="font-size:4.5em"></i></div>
							<div class="col-xs-9 text-right">
								<div style="font-size:2.5em">6</div>
								<div>Orders</div>
							</div>
						</div>
					</div>
					<a href="#">
						<div class="panel-footer">
							<div class="pull-left">View Orders</div>
							<div class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></div>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="clearfix"></div>
			
			<!------ Top Blocks Ends----->
			

			<div class="clearfix"></div>
			<!------ Post lists Starts----->
			<div class="panel panel-primary">
				<div class="panel-heading"><h3>Latest Orders</h3></div>
				<div class="panel-body">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>S.No</th>
								<th>Date</th>
								<th>Product</th>
								<th>Full Name</th>
								<th>Email_address</th>
								<th>View Product</th>
								<th>Delete Order</th>
							</tr>
						</thead>
						<tbody>
							<?php
								//$sql = "SELECT * FROM posts ORDER BY ID DESC";
								$sql = "SELECT * FROM orders o JOIN posts p ON o.product_id = p.post_id";
								//$sql = "SELECT * FROM posts p JOIN users u ON p.author = u.user_email";
								$run = mysqli_query($conn,$sql);
								$number = 1;
								while($rows = mysqli_fetch_assoc($run)){
									echo '
									<tr>
										<td>'.$number.'</td>
										<td>'.$rows['post_time'].'</td>
										<td>'.$rows['post_heading'].'</td>
										<td>'.$rows['buyer_name'].'</td>
										<td>'.$rows['buyer_email'].'</td>
										<td><a href="../post.php?post_id='.$rows['post_id'].'" class="btn btn-success btn-sm navbar-btn">View Item</a></td>
										<td><a href="post_list.php?del_id='.$rows['post_id'].'" class="btn btn-danger btn-sm navbar-btn">Delete order</a></td>
									</tr>
									';
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
			<!------ Post lists Starts----->
			<div class="panel panel-primary">
				<div class="panel-heading"><h3>Latest Posts</h3></div>
				<div class="panel-body">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>S.No</th>
								<th>Date</th>
								<th>Image</th>
								<th>Title</th>
								<th>Description</th>
								<th>Author</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$sql = "SELECT * FROM posts p JOIN admin a ON a.id = p.seller WHERE p.product_status = '1'";
								$run = mysqli_query($conn,$sql);
								$number = 1;
								while($rows = mysqli_fetch_assoc($run)){
									echo '
									<tr>
										<td>'.$number.'</td>
										<td>'.$rows['post_time'].'</td>
										<td>'.$rows['post_heading'].'</td>
										<td>'.substr(strip_tags($rows['post_description']),0,50).'....</td>
										<td>'.$rows['f_name'].' '.$rows['l_name'].'</td>
									</tr>
									';
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
			<!------ Users Area --->
			<div class="col-lg-8">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h4>Users List</h4>
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>S.NO</th>
									<th>Name</th>
									<th>Role</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$sql = "SELECT * FROM admin LIMIT 5";
								$run = mysqli_query($conn,$sql);
								$number = 1;
								while ($rows = mysqli_fetch_assoc($run)){
									echo '
										<tr>
											<td>'.$number.'</td>
											<td>'.$rows['f_name'].' '.$rows['l_name'].'</td>
											<td>Admin</td>
										
										</tr>
									';
									$number++;
								}
							?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
		</div>
		<footer></footer>
	</body>
</html>
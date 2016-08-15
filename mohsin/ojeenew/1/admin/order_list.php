<?php session_start();
	include 'includes/db.php';
	if(isset($_SESSION['user']) && isset($_SESSION['password'])){
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
	if(isset($_GET['del_id'])){
		$del_id = $_GET['del_id'];
		$sql = "DELETE FROM orders WHERE order_id = '$del_id'";
		if($run = mysqli_query($conn,$sql)){
			$result = '<div class="alert alert-danger">You Deleted Row no. '.$del_id.'</div>';
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
		<script>
			
		</script>
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
				<div class="panel-heading"><h3>Orders</h3></div>
				<div class="panel-body">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>S.No</th>
                                <th>Order ID</th>
								<th>Product</th>
								<th>Deal Price</th>
								<th>Full Name</th>
								<th>Email_address</th>
								<th>Cell</th>
								<th>City</th>
								<th>Address</th>
								<th>Order Data</th>
								<th>View Product</th>
								<th>Delete Order</th>
							</tr>
						</thead>
						<tbody>
							<?php
								//$sql = "SELECT * FROM order o JOIN posts p ON o.product_id = p.post_id";
								$sql = "SELECT * FROM orders o JOIN posts p ON o.post_url = p.post_url ORDER BY o.order_id DESC";
								$run = mysqli_query($conn,$sql);
								$number = 1;
								while($rows = mysqli_fetch_assoc($run)){
									echo '
									<tr>
										<td>'.$number.'</td>
										<td>'.$rows['order_id'].'</td>
										<td>'.$rows['post_heading'].'</td>
										<td>'.$rows['post_offer_price'].'</td>
										<td>'.$rows['buyer_name'].'</td>
										<td>'.$rows['buyer_email'].'</td>
										<td>'.$rows['buyer_cell'].'</td>
										<td>'.$rows['buyer_city'].'</td>
										<td><span style="word-wrap:break-word;">'.$rows['buyer_address'].'</span></td>
										<td>'.$rows['order_time'].'</td>
										<td><a href="../post.php?post_id='.$rows['post_id'].'" class="btn btn-success btn-sm navbar-btn">View Item</a></td>
										<td><a href="order_list.php?del_id='.$rows['order_id'].'" class="btn btn-danger btn-sm navbar-btn">Delete order</a></td>
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
			
		</div>
		<footer></footer>
	</body>
</html>
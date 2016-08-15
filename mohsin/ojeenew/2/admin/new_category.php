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
	if(isset($_POST['submit_category'])){
		$cat_name = strip_tags($_POST['cat_name']);
		$cat_title = strip_tags($_POST['cat_title']);
		$cat_description = strip_tags($_POST['cat_description']);
		$sql = "INSERT INTO categories (cat_name, cat_title, cat_description) VALUES ('$cat_name', '$cat_title', '$cat_description')";
		if(mysqli_query($conn,$sql)){
			$result = '<div class="alert alert-success">You&apos;ve created a new Cateogry named &apos;'.$category.'&apos;</div>';
			
		} else {
			$result = '<div class="alert alert-danger">There&apos;s something wrong with the query</div>';
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
		<script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>
		<script>tinymce.init({selector:'textarea'});</script>
	</head>
	<body>
		<?php include 'includes/header.php';?>
		<div style="width:50px;height:50px;"></div>
		<?php  include 'includes/sidebar.php';?>
		<div class="col-lg-10">
			<?php echo $result;?>
			<div class="page-header"><h1>New Category</h1></div>
			<div class="container-fluid">
				<form class="form-horizontal col-lg-5" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="category">Name</label>
						<input id="category" type="text" name="cat_name" class="form-control">
					</div>
					<div class="form-group">
						<label for="category">Title</label>
						<input id="category" type="text" name="cat_title" class="form-control">
					</div>
					<div class="form-group">
						<label for="category">Description</label>
						<input id="category" type="text" name="cat_description" class="form-control">
					</div>
					<div class="form-group">
						<input type="submit" name="submit_category" class="btn btn-danger btn-block">
					</div>
				</form>
			
		</div>
		<footer></footer>
	</body>
</html>
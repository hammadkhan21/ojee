<?php session_start();
	date_default_timezone_set('Asia/Karachi');
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
	$error = '';

	if(isset($_POST['submit_item'])){
		$title = strip_tags($_POST['title']);
		$item_url_base = str_replace(' ','-',$title);
		$item_url = strtolower($item_url_base);
		function unixToMySQL($timestamp)
			{
			return date('Y-m-d H:i:s', $timestamp);
			}
		$time = time();
		$converted_time = unixToMySQL($time);
		if(isset($_FILES['product_img'])){
			$errors= array();
			foreach($_FILES['product_img']['tmp_name'] as $key => $tmp_name ){
				$file_name = $key.$_FILES['product_img']['name'][$key];
				$file_size = $_FILES['product_img']['size'][$key];
				$file_tmp = $_FILES['product_img']['tmp_name'][$key];
				$file_type= $_FILES['product_img']['type'][$key];
				$path = "../images/"; // Upload directory
				$db_path = "images/".$file_name; // Upload directory
				move_uploaded_file($file_tmp,"$path/".$file_name);
				$ins_image="INSERT into post_images (image_time, image_path) VALUES('$converted_time','$db_path')";
				mysqli_query($conn,$ins_image);			
			}
			$ins_product = "INSERT INTO posts (post_category, post_time, post_url, post_heading, post_description, meta_title, post_short_description, post_keyword, post_retail, post_offer_price, post_cost, product_status) VALUES ('$_POST[category]', '$converted_time', '$item_url', '$title', '$_POST[description]', '$_POST[meta_title]', '$_POST[meta]', '$_POST[keyword]', '$_POST[original_price]', '$_POST[deal_price]', '$_POST[cost_price]', '$_POST[status]')";
			mysqli_query($conn,$ins_product);
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
		<?php echo $error; include 'includes/sidebar.php';?>
		<div class="col-lg-10">
			<div class="page-header"><h1>New Item</h1></div>
			<div class="container-fluid">
				<form class="form-horizontal" action="new_post.php" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="image">Upload an Image</label>
						<input id="image" type="file" name="product_img[]" multiple class="btn btn-primary">
					</div>
					<div class="form-group">
						<label for="title">Title</label>
						<input id="title" type="text" name="title" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="category">Category</label>
						<select id="category" name="category" class="form-control" >
							<option value="">Select Any Category</option>
							<?php
								$sel_sql = "SELECT * FROM categories";
								$run_sql = mysqli_query($conn,$sel_sql);
								while($rows = mysqli_fetch_assoc($run_sql)){
									if($rows['cat_name'] == 'home'){
										continue;
									}
									echo '<option value="'.$rows['cat_id'].'">'.ucfirst($rows['cat_name']).'</option>';
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="description">Description</label>
						<textarea id="description" name="description"></textarea>
					</div>
					<div class="form-group">
						<label for="meta_title">Meta Title</label>
						<textarea id="meta_title" name="meta_title"></textarea>
					</div>
					<div class="form-group">
						<label for="meta">Meta</label>
						<textarea id="meta" name="meta"></textarea>
					</div>
					<div class="form-group">
						<label for="keyword">Keyword</label>
						<textarea id="keyword" name="keyword"></textarea>
					</div>
					<div class="form-group">
						<label for="description">Deal Price</label>
						<input id="title" type="number" name="deal_price" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="description">Price</label>
						<input id="title" type="number" name="original_price" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="description">Cost Price</label>
						<input id="title" type="number" name="cost_price" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="status">Status</label>
						<select id="status" name="status" class="form-control">
							<option value="0">Draft</option>
							<option value="1">Publish</option>
						</select>
					</div>
					<div class="form-group">
						<input type="submit" name="submit_item" class="btn btn-danger btn-block">
					</div>
				</form>
			</div>
		</div>
		<footer></footer>
	</body>
</html>
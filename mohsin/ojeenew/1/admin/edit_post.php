<?php session_start();
	include 'includes/db.php';
	if(isset($_SESSION['user']) && isset($_SESSION['password']) == true){
		$sel_sql = "SELECT * FROM admin WHERE user_email = '$_SESSION[user]' AND user_password = '$_SESSION[password]'";
		if($run_sql = mysqli_query($conn, $sel_sql)){
			while($rows = mysqli_fetch_assoc($run_sql)){
				if(mysqli_num_rows($run_sql) == 1 ){
					if($rows['role'] == 'admin'){
					} else {
						//header('Location:../index.php');
						?> <script>window.location = '../index.php';</script><?php
					}
				} else{
					//header('Location:../index.php');
					?> <script>window.location = '../index.php';</script><?php
				}
			}
		}
	} else {
		//header('Location:../index.php');
		?> <script>window.location = '../index.php';</script><?php
	}
	$error = '';
	if(isset($_POST['update_post'])){
		$title = strip_tags($_POST['title']);
		$date = date('Y-m-d h:i:s');
		$meta_title = strip_tags($_POST['meta_title']);
		$meta_description = strip_tags($_POST['meta_description']);
		$meta_keyword = strip_tags($_POST['meta_keyword']);
		$up_sql = "UPDATE posts SET post_heading='$title', post_description='$_POST[description]', meta_title='$meta_title', post_short_description='$meta_description', post_keyword='$meta_keyword', post_category='$_POST[category]', product_status='$_POST[status]' WHERE post_id = '$_POST[post_id]'";
		if(mysqli_query($conn,$up_sql)){
			//header('Location: post_list.php');
			?> <script>window.location = 'post_list.php';</script><?php
			$result = '<div class="alert alert-danger">You&apos;ve Edited the post no. '.$_POST['id'].'</div>';
		}else {
			$error = '<div class="alert alert-danger">The Query Was not Working!</div>';
		}
		
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Edit Post</title>
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
		<div class="col-md-10">
			<?php
				if(isset($_GET['edit_id'])){
				$sql = "SELECT * FROM posts WHERE post_id = '$_GET[edit_id]'";
				$run = mysqli_query($conn,$sql);
				while($rows = mysqli_fetch_assoc($run)){ ?>
					<div class="page-header"><h1><?php echo $rows['post_heading']; ?></h1></div>
			<div class="container-fluid">
				<form class="form-horizontal" action="edit_post.php" method="post" enctype="multipart/form-data">
					<input type="hidden" name="post_id" value="<?php echo $rows['post_id']; ?>">
					<div class="form-group">
						<label for="title">Title</label>
						<input id="title" type="text" name="title" value="<?php echo $rows['post_heading']; ?>" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="category">Category</label>
						<select id="category" name="category" class="form-control" required>
							<?php
								$sel_sql = "SELECT * FROM categories";
								$run_sql = mysqli_query($conn,$sel_sql);
								while($c_rows = mysqli_fetch_assoc($run_sql)){
									if($c_rows['cat_id'] == $rows['post_category']){
										echo '<option value="'.$c_rows['cat_id'].'" selected>'.ucfirst($c_rows['cat_name']).'</option>';
									} else {
										echo '<option value="'.$c_rows['cat_id'].'">'.ucfirst($c_rows['cat_name']).'</option>';
									}
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="description">Description</label>
						<textarea id="description" name="description"><?php echo $rows['post_description']; ?></textarea>
					</div>
					<div class="form-group">
						<label for="meta_title">Meta Title</label>
						<textarea id="meta_title" name="meta_title" ><?php echo $rows['meta_title']; ?></textarea>
					</div>
					<div class="form-group">
						<label for="meta">Meta</label>
						<textarea id="meta" name="meta_description"><?php echo $rows['post_short_description']; ?></textarea>
					</div>
					<div class="form-group">
						<label for="keyword">Keyword</label>
						<textarea id="keyword" name="meta_keyword"><?php echo $rows['post_keyword']; ?></textarea>
					</div>
					<div class="form-group">
						<label for="status">Status</label>
						<select id="status" name="status" class="form-control">
							<?php 
								if($rows['product_status'] == 'draft'){
									echo '<option value="0" selected>Draft</option>
									<option value="1">Publish</option>';
								} else{
									echo '<option value="0">Draft</option>
									<option value="1" selected>Publish</option>';
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<input type="submit" name="update_post" class="btn btn-danger btn-block">
					</div>
				</form>
			</div>
				<?php }
				} else {
					echo '<div class="alert alert-danger">Please Select A post to edit!</div>';
					
				}
			?>
		</div>
		<footer></footer>
	</body>
</html>
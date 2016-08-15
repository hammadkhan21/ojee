<?php include 'includes/db.php';?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<title>Chill Yaar - Online Shopping in Pakistan</title>
		<meta name="description" content="Chill Yaar is one of the Pakistan&#39;s leading online shopping store for Clothing, Shoes, Watches, Perfumes, Gadgets &amp; Other Products at best affordable prices with huge discounts. Free Shipping &amp; Cash on Delivery Available.">
		<meta name="keywords" content="deals, discounted deals, deals in Pakistan, clothing, shoes, perfumes, watches, gadgets">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/flat-ui.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
	</head>
	<body>
	<?php include 'includes/header.php';?>
	<div class="container box">
		<div class="row">
			<br>
			<?php
				if(isset($_GET['cat_name'])){
					$get_cat = "SELECT * FROM categories WHERE cat_name = '$_GET[cat_name]'";
					$run_get_cat = mysqli_query($conn, $get_cat);
					while($get_cat_row = mysqli_fetch_assoc($run_get_cat)){
						$cat_id = $get_cat_row['cat_id'];
						$sql = "SELECT * FROM posts WHERE post_category = '$cat_id' AND product_status = '1'";
					}
				} else {
					$sql = "SELECT * FROM posts WHERE product_status = '1' ORDER BY RAND()";
				}
				$run = mysqli_query($conn, $sql);
				while($rows = mysqli_fetch_assoc($run)){
					
					$sel_img_sql = "SELECT * FROM post_images WHERE image_time = '$rows[post_time]' ORDER by image_id ASC LIMIT 1";
					$run_img_sql = mysqli_query($conn, $sel_img_sql);
					while($img_row = mysqli_fetch_assoc($run_img_sql)){
						$image_path = $img_row['image_path'];
					}
					$sel_cat_sql = "SELECT * FROM categories WHERE cat_id = '$rows[post_category]'";
					$run_cat_sql = mysqli_query($conn, $sel_cat_sql);
					while($cat_rows = mysqli_fetch_assoc($run_cat_sql)){
						$cat_name = $cat_rows['cat_name'];
					}
					?>
					<div class="alldeals col-md-4 col-sm-6 col-xs-12">
						<div class="deals" id="deal-170">
							<a href="<?php echo $rows['post_url']; ?>">
								<div class="image">
									<img src="<?php echo $image_path; ?>" data-src="<?php echo $image_path; ?>" alt="<?php echo $rows['post_heading']; ?>">
								</div>
								<h3><?php echo $rows['post_heading']; ?></h3>
								<div class="meta">
									<ul>
										<li><span class="block"><i class="fa fa-bookmark"></i> <?php echo $cat_name; ?></span><span class="block"><br></span></li><li><span class="block old-price">Rs. <?php echo $rows['post_retail']; ?>/-</span><span class="block price">Rs. <?php echo $rows['post_offer_price']; ?>/-</span></li>
									</ul>
								</div>
							</a>
							<div class="buy">
								<a class="btn btn-primary btn-block btn-lg" href="<?php echo $rows['post_url']; ?>">Buy Now</a>
							</div>
						</div>
					</div>
			<?php	}
			?>
			
		</div>
	</div>
	<footer>
		<div class="container footer-container box2">
		<div class="row">
			<div class="col-xs-12" id="copyright">
				<p>Copyright 2014-2016 © <a href="./Chill Yaar - Online Shopping in Pakistan_files/Chill Yaar - Online Shopping in Pakistan.html">Chill Yaar</a> All Rights Reserved. An <a href="http://www.oddpals.com/">OddPals</a> venture.</p>
			</div>
		</div></div>
	</footer> 
	<script src="js/jquery.min.js"></script>
	</body>
</html>
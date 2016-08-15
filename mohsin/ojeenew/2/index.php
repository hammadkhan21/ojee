<?php include 'includes/db.php';?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<title>Ojee - Online Shopping in Pakistan</title>
		<meta name="description" content="Ojee.pk is one of the Pakistan;s leading online shopping store for Clothing, Shoes, Watches, Perfumes, Gadgets; Other Products at best affordable prices with huge discounts. Free Shipping; Cash on Delivery Available.">
		<meta name="keywords" content="deals, discounted deals, deals in Pakistan, clothing, shoes, perfumes, watches, gadgets">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/flat-ui.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
        <!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','//connect.facebook.net/en_US/fbevents.js');

fbq('init', '425196207682257');
fbq('track', "PageView");</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=425196207682257&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->


<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-57910883-1', 'auto');
  ga('send', 'pageview');


</script>

	</head>
	<body>
	<?php include 'includes/header2.php';?>
	<div class="container box">
		<div class="row">
			<br>
			<?php $sql = "SELECT * FROM posts WHERE Product_status = '1'";
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
									<img src="<?php echo $image_path; ?>" data-src="<?php echo $image_path; ?>" alt="Rolex Skeleton Automatic Two-Tone Wrist Watch">
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
				<p>Copyright 2014-2016 © <a href="./Ojee- Online Shopping in Pakistan_files/Ojee - Online Shopping in Pakistan.html">Ojee</a></p>
			</div>
		</div></div>
	</footer> 
	<script src="js/jquery.min.js"></script>
	</body>
</html>
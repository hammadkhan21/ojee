<?php include 'includes/db.php';
	if(isset($_GET['cat_name'])){
		$get_cat = "SELECT * FROM categories WHERE cat_name = '$_GET[cat_name]'";
		$run_get_cat = mysqli_query($conn, $get_cat);
		while($get_cat_row = mysqli_fetch_assoc($run_get_cat)){
			$cat_id = $get_cat_row['cat_id'];
			$cat_title = $get_cat_row['cat_title'];
			$cat_description = $get_cat_row['cat_description'];
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Ojee.pk - Online Shopping in Pakistan <?php echo $cat_title?></title>
		<meta name="description" content="<?php echo $cat_description; ?>">
		<meta name="keywords" content="deals, discounted deals, deals in Pakistan, clothing, shoes, perfumes, watches, gadgets">
		<link href="ojee/bootstrap.css" rel="stylesheet">
		<link href="ojee/style.css" rel="stylesheet">
		<link href="ojee/flat-ui.css" rel="stylesheet">
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
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="header">
				<div class="logo">
					<a href="http://www.ojee.pk/">
						<img src="./images/site/logo.png" alt="Ojee Deals">
					</a>
				</div>
				<div class="slogan">
					<a href="http://www.ojee.pk/"><img src="./ojee/newdeal_slogan.png" alt="ojee"></a>
				</div>
				<div class="contact">
					<span id="timing">call us (mon-sat 10am - 6pm)</span>
					<div id="callnow"><span>0331-2223887 | 0312-2080020</span></div>
				</div>
			</div>
		</nav><br><br><br><br>
		
				<div class="navbar navbar-inverse">
					<div class="container-fluid">
						<ul class="nav navbar-nav">
					<?php
						$c_sql = "SELECT * FROM categories";
						$c_run = mysqli_query($conn, $c_sql);
						while($c_rows = mysqli_fetch_assoc($c_run)){
							$cat_name = ucwords($c_rows['cat_name']);
							echo "<li><a href='category.php?cat_name=$c_rows[cat_name]'>$cat_name</li>";
						}
					?>
				</ul>
					</div>
				</div>
		<div class="container">
			<div class="row">
			
			<?php
				if(isset($_GET['cat_name'])){
					$get_cat = "SELECT * FROM categories WHERE cat_name = '$_GET[cat_name]'";
					$run_get_cat = mysqli_query($conn, $get_cat);
					while($get_cat_row = mysqli_fetch_assoc($run_get_cat)){
						$cat_id = $get_cat_row['cat_id'];
						$sel_post_sql = "SELECT * FROM posts WHERE post_category = '$cat_id' AND product_status = '1'";
					}
				} else {
					$sel_post_sql = "SELECT * FROM posts WHERE product_status = '1' ORDER BY RAND()";
				}
				$run_post_sql = mysqli_query($conn,$sel_post_sql);
				while($rows = mysqli_fetch_assoc($run_post_sql)){
					$sel_img_sql = "SELECT * FROM post_images WHERE image_time = '$rows[post_time]' ORDER by image_id ASC LIMIT 1";
					$run_img_sql = mysqli_query($conn, $sel_img_sql);
					while($img_row = mysqli_fetch_assoc($run_img_sql)){
						$image_path = $img_row['image_path'];
					}
					//Getting The offered price in PERCENTAGEs
					$decrease_amount =  $rows['post_retail'] - $rows['post_offer_price'];
					$deal_in_percent = $decrease_amount / $rows['post_retail'] * 100;
					echo '
					<div class="col-md-4">
						<div class="box-main deals" >
							<a href="'.$rows['post_url'].'">
								<div class="image">
									<img src="'.$image_path.'" alt="'.$rows['post_heading'].'">
								</div>
								<h3>'.$rows['post_heading'].'</h3>
								<div class="meta">
									<ul>
										<li><span class="strike">Rs. '.$rows['post_retail'].'/-</span>Retail Price</li>
										<li><span><strong>'.round($deal_in_percent).'%</strong></span> OFF Discount</li>
										<li><span>Rs. '.$rows['post_offer_price'].'/-</span>Deal Price</li>
									</ul>
								</div>
							</a>
							<div class="buy">
								<a class="btn btn-primary btn-sm btn-block submit" href="'.$rows['post_url'].'">Buy Now</a>
							</div>
						</div>
					</div>
					';
				}
			?>
			</div>
			
			<div class="row">
				<div class="col-md-12" id="footer">
					<p>Contact us: <a href="mailto:admin@ojee.pk">Admin@ojee.pk</a></p>
				</div>
			</div>
		</div>
	</body>
</html>
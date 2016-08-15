<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<?php include 'includes/db.php';
			date_default_timezone_set('Asia/Karachi');
			$sel_post_sql = "SELECT * FROM posts WHERE post_url = '$_GET[title]'";
			$run_post_sql = mysqli_query($conn,$sel_post_sql);
			while($title_rows = mysqli_fetch_assoc($run_post_sql)){
				if($title_rows['meta_title'] == ''){
					$title_row = $title_rows['post_heading'];
				} else {
					$title_row = $title_rows['meta_title'];
				} ?>
		<title><?php echo $title_row; ?></title>
		<meta name="description" content="<?php echo $title_rows['post_short_description']; ?>">
		<meta name="keywords" content="<?php echo $title_rows['post_keyword']; ?>">
		<?php } ?>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="keywords" content="deals, discounted deals, deals in Pakistan, clothing, shoes, perfumes, watches, gadgets">
		<meta http-equiv="Pragma" content="no-cache">
		<meta http-equiv="Expires" content="-1">
		<meta name="robots" content="index,follow">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/flat-ui.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet" type="text/css">
		<link href="css/tooltipster.css" rel="stylesheet">
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.js"></script>
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
	<?php include 'includes/header2.php';
		$sel_post_sql = "SELECT * FROM posts WHERE post_url = '$_GET[title]'";
		$run_post_sql = mysqli_query($conn,$sel_post_sql);
		while($rows = mysqli_fetch_assoc($run_post_sql)){
	?>
<div class="container box deal" itemscope="" itemtype="http://schema.org/Product">
<div class="row deal-header">
<div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
<ol class="breadcrumb hidden-xs">
<li><a href="#/">All Deals</a></li>
<li class="active"><a href="#/">Women's Fashion</a></li>
</ol>
<h1 class="deal-title" itemprop="name"><?php echo $rows['post_heading']; ?></h1>
</div>
<div class="price-block col-lg-3 col-md-4 col-sm-4 col-xs-12" itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
<span class="old-price">Rs. <?php echo $rows['post_retail']; ?></span><span class="price"><meta itemprop="priceCurrency" content="PKR">Rs. <span itemprop="price"><?php echo $rows['post_offer_price']; ?></span>/-</span>
<a class="btn btn-primary btn-block btn-xlg buy-btn" href="buy.php?title=<?php echo $_GET['title']; ?>">Buy Now</a>
</div>
</div>
<div class="row deal-content">
<div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
<div  class="row">
<div class="col-lg-12">
<?php
	$img_sql = "SELECT * FROM post_images WHERE image_time = '$rows[post_time]' ORDER by image_id ASC";
	$img_run = mysqli_query($conn, $img_sql);
	$res = mysqli_num_rows($img_run);
	
		
		$y=0;
	echo "
		<div class='carousel slide' id='carousel1' data-ride='carousel'>
			<ol class='carousel-indicators'>		
	";
	for($x=0;$x<$res;$x++){
		if($x==0){
			echo "<li data-target='#carousel1' data-slide-to='$x' class='active'></li>";
		} else {
			echo "<li data-target='#carousel1' data-slide-to='$x'></li>";
		}
	}
	echo "
	</ol>
	<div class='carousel-inner'>
	";
	while($img_row = mysqli_fetch_assoc($img_run)){
		if($y==0){
			echo "
				<div class='item active'>
					<img src='$img_row[image_path]'>
					<div class='carousel-caption'>
					</div>
				</div>
		";
		} else {
			echo "
				<div class='item'>
					<img src='$img_row[image_path]'>
					<div class='carousel-caption'>
						
						<p></p>
					</div>
				</div>
		";
		}
		
		$y++;
	}
	echo "
		</div>
	<a class='left carousel-control' href='#carousel1' data-slide='prev'>
				<span class='glyphicon glyphicon-chevron-left'></span>
				<span class='sr-only'>Previous</span>
			</a>
			<a class='right carousel-control' href='#carousel1' data-slide='next'>
				<span class='glyphicon glyphicon-chevron-right'></span>
				<span class='sr-only'>Next</span>
			</a>
	</div>
	";

	
?>
</div>
<div class="col-lg-2">
</div>
</div>
<div id="description" class="row">
<div class="col-lg-12" itemprop="description">
<?php echo $rows['post_description'];?> </div>
</div>
</div>
<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
<ul class="deal-meta">
<li class="tip tooltipstered"><span class="head">Express Delivery</span><span class="details"><i class="fa fa-truck"></i>Delivered in <strong>5</strong> working days</span></li>
<li class="tip tooltipstered"><span class="head">Easy Returns</span><span class="details"><i class="fa fa-undo"></i>Easy <strong>3</strong> days Return and Refund</span></li>
<li class="tip tooltipstered"><span class="head">Order on Phone</span><span class="details"><i class="fa fa-phone"></i>Call at <strong>0331-2223887</strong><br> to order via Phone</span></li>
</ul>
<div class="recently-viewed hidden-xs">
<h3 class="recently-viewed-head">Recently Viewed Deals</h3>
<?php
	$sel_related_post = "SELECT * FROM posts ORDER BY RAND() LIMIT 3";
		$run_related_post = mysqli_query($conn,$sel_related_post);
		
		while($rel_rows = mysqli_fetch_assoc($run_related_post)){
			$rel_sel_img_sql = "SELECT * FROM post_images WHERE image_time = '$rel_rows[post_time]' ORDER by image_id ASC LIMIT 3";
			$rel_run_img_sql = mysqli_query($conn, $rel_sel_img_sql);
			while($rel_img_row = mysqli_fetch_assoc($rel_run_img_sql)){
				$rel_image_path = $rel_img_row['image_path'];
			}
	?>
			<div class="more-deals" id="deal-91">
				<a href="deal.php?title=<?php echo $rel_rows['post_url']; ?>">
				<div class="image">
				<div class="meta"><span class="old-price">Rs. <?php echo $rel_rows['post_retail']; ?>/-</span><span class="price">Rs. <?php echo $rel_rows['post_offer_price']; ?>/-</span></div>
				<img src="<?php echo $rel_image_path; ?>" data-src="<?php echo $rel_image_path; ?>" alt="Pack of 4 Pocket Perfumes for HER">
				</div>
				<h3><?php echo $rel_rows['post_heading']; ?></h3>
				</a>
			</div>
		<?php } ?>
</div>
</div>
</div>
</div>
	<?php } ?>
<footer>
	<div class="container footer-container box2">
		<div class="row">
			<div class="col-xs-12" id="copyright">
				<p>Copyright 2014-2016 © <a href="https://www.ojee.pk/">Ojee</a></p>
			</div>
		</div>
	</div>
</footer>

<script src="js/flat-ui.min.js"></script>
<script src="js/jquery.countdown.min.js"></script>
<script src="js/unveil.js"></script>
<script src="js/jquery.bxslider.min.js"></script>
<script src="js/jquery.tooltipster.min.js"></script>
<script src="js/main.js"></script>
<script type="text/javascript">
	$('.deal-meta li').hover(function() {
		$( this ).find('i').toggleClass('hover');
	});
		$('#countdown').countdown({until: new Date($('#countdown').attr('time')), labels: ['years', 'months', 'weeks', 'days', 'hours', 'minutes', 'seconds'],labels1: ['year', 'month', 'week', 'day', 'hour', 'minute', 'second'] , layout:'{dn} {dl} {hnn}:{mnn}:{snn}'});
		</script>
<script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    
      ga('create', 'UA-34839748-1', 'auto');
      ga('send', 'pageview');
    
    </script>
<script type="text/javascript">
	    adroll_adv_id = "SCPBHN2WGFFS7NGKN2TGOS";
	    adroll_pix_id = "GDRJMRAOUBDUVBJNTICBFJ";
	    (function () {
	        var _onload = function(){
	            if (document.readyState && !/loaded|complete/.test(document.readyState)){setTimeout(_onload, 10);return}
	            if (!window.__adroll_loaded){__adroll_loaded=true;setTimeout(_onload, 50);return}
	            var scr = document.createElement("script");
	            var host = (("https:" == document.location.protocol) ? "https://s.adroll.com" : "http://a.adroll.com");
	            scr.setAttribute('async', 'true');
	            scr.type = "text/javascript";
	            scr.src = host + "/j/roundtrip.js";
	            ((document.getElementsByTagName('head') || [null])[0] ||
	                document.getElementsByTagName('script')[0].parentNode).appendChild(scr);
	        };
	        if (window.addEventListener) {window.addEventListener('load', _onload, false);}
	        else {window.attachEvent('onload', _onload)}
	    }());
	</script>
</body></html>
<!DOCTYPE html>
<html>
<head>
<?php include 'includes/db.php';
			date_default_timezone_set('Asia/Karachi');
			$sql = "SELECT * FROM posts WHERE post_url = '$_GET[link]'";
			$run = mysqli_query($conn,$sql);
			while($rows = mysqli_fetch_assoc($run)){
				if($rows['meta_title'] == ''){
					$title_row = $rows['post_heading'];
				} else {
					$title_row = $rows['meta_title'];
			} 
		?>
		<title><?php echo $title_row; ?></title>
		<meta name="description" content="<?php echo $rows['post_short_description']; ?>">
		<meta name="keywords" content="<?php echo $rows['post_keyword']; ?>">

		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/flat-ui.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet" type="text/css">
		<link href="css/tooltipster.css" rel="stylesheet">
		<link rel="stylesheet" href="css/font-awesome.min.css">
 
<link href="css/nprogress.css" rel="stylesheet">
<link href="css/jquery.bxslider.css" rel="stylesheet">
 </head>
<body>
<?php include 'includes/header.php';?>
<div class="container box padding-top checkout">
<div class="row">
<div class="col-xs-12">
<h3 id="thanks-head">Yay! Order Successfully Placed</h3>
</div>
<div class="col-xs-12">
<div class="row">
<div class="col-sm-12 col-md-6" id="messsage-box">
<div class="content-box">
<div class="box-head">
Order Placed
</div>
<div class="box-content">
<div class="check">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="61" height="52" viewBox="0 0 61 52" class="check-icon">
<path d="M56.560,-0.010 C37.498,10.892 26.831,26.198 20.617,33.101 C20.617,33.101 5.398,23.373 5.398,23.373 C5.398,23.373 0.010,29.051 0.010,29.051 C0.010,29.051 24.973,51.981 24.973,51.981 C29.501,41.166 42.502,21.583 60.003,6.565 C60.003,6.565 56.560,-0.010 56.560,-0.010 Z" id="path-1" class="cls-2" fill-rule="evenodd"></path>
</svg>
</div>
<div class="thanks-message">
<h4>Your Order has been Placed</h4>
<p class="hidden-xs">Please enter 4 digit cofirmation code on the right to confirm your order and process it for dispatch immediately.</p>
<p class="visible-xs">Please enter 4 digit cofirmation code on the bottom to confirm your order and process it for dispatch immediately.</p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<footer>
			<div class="container footer-container box2">
				<div class="row">
					<div class="col-xs-12" id="copyright">
						<p>Copyright 2014-2016 © <a href="./Chill Yaar - Online Shopping in Pakistan_files/Chill Yaar - Online Shopping in Pakistan.html">Chill Yaar</a> All Rights Reserved. An <a href="http://www.oddpals.com/">OddPals</a> venture.</p>
					</div>
				</div>
			</div>
		</footer>
<script src="js/jquery.min.js"></script>
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
<script>
setInterval(function() {
	var order_id = $('#order_id').val();
	$.post( 'https://www.chillyaar.com/coderesend.php?gettime', { order_id: order_id })
	  .done(function(data) {
		  if(data == 'Show'){
		  $('#resendlink_div').html('<a href="#" id="resend">Resend confirmation code</a>');
		  } else {
			  $('#resendlink_div').html('');
		  }
	  })
}, 5000);	
	</script><script>ga('send', 'event', 'Products', 'order');</script> 
</body></html> <?php }?>
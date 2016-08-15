<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<?php include 'includes/db.php';
			date_default_timezone_set('Asia/Karachi');
			$sql = "SELECT * FROM posts WHERE post_url = '$_GET[title]'";
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
		<link href="css/nprogress.css" rel="stylesheet">
		<link href="css/tooltipster.css" rel="stylesheet">
		<link href="css/jquery.bxslider.css" rel="stylesheet">
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
		<?php include 'includes/header.php';?>
		<div class="container box padding-top checkout">
			<div class="row">
				<div class="col-xs-12">
					<h3>Checkout</h3>
				</div>
				<div class="col-xs-12">
					<div class="row">
						<form role="form" method="post" id="order_form" novalidate="novalidate">
							<input type="hidden" name="deal_id" value="<?php echo $rows['post_id'];?>">
							<input type="hidden" name="deal_permalink" value="<?php echo $rows['post_url']; ?>">
							<input type="hidden" name="deal" value="Camera Lens Coffee Mug">
							<div class="col-sm-12 col-md-5">
								<div class="content-box">
									<div class="box-head">Your Order</div>
									<div class="box-content">
										<table class="table">
											<thead>
												<tr>
													<th>Product</th>
													<th width="20%" class="text-center">
														<span class="">Qty</span>
													</th>
													<th width="30%" class="text-right">Total</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td class="vert-align" id="product" data-value="<?php echo $rows['post_offer_price']?>"><?php echo $rows['post_heading']; ?></td>
													<td class="text-center">
														<select name="qty" class="form-control form-control-inline" id="qty" aria-invalid="false">
															<option>1</option>
															<option>2</option>
															<option>3</option>
															<option>4</option>
															<option>5</option>
														</select>
													</td>
													<td class="text-right vert-align" id="total_price"></td>
												</tr>
											</tbody>
											<tfoot>
												<tr>
													<th colspan="3" class="text-center">Order Summary</th>
												</tr>
												<tr>
													<td>Delivery Charges:</td>
													<input type="hidden" name="delivery" value="0" id="delivery">
													<td></td>
													<td class="text-right"><strong>Free</strong></td>
												</tr>
												<tr>
													<td>Totals:</td>
													<td></td>
													<td id="total" class="text-right"></td>
												</tr>
											</tfoot>
										</table>
									</div>
								</div>
							</div>
							<?php } ?>
							<div class="col-sm-12 col-md-7">
								<div class="content-box">
									<div class="box-head">Order Form</div>
									<div id="hloader"></div>
									<div class="box-content">
										<div class="form-group">
											<label class="" for="name">Full Name</label>
											<div class="input-group">
												<div class="input-group-addon"><i class="fa fa-user"></i></div>
												<input type="text" name="name" class="form-control" placeholder="Full Name" value="" required="" aria-required="true">
											</div>
										</div>
										<div class="form-group">
											<label class="" for="email">Email Address</label>
											<div class="input-group">
												<div class="input-group-addon"><i class="fa fa-envelope"></i></div>
												<input type="email" name="email" class="form-control" placeholder="Email Address" value="" required="" email="true" aria-required="true">
											</div>
										</div>
										<div class="form-group" id="mobile_main">
										<label class="" for="mobile">Mobile Number</label>
										<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-phone"></i></div>
										<input type="tel" name="mobile" class="form-control" placeholder="Mobile Number" minlength="11" maxlength="12" value="" required="" number="true" aria-required="true">
										</div>
										</div>
										<div class="form-group">
										<label class="" for="address">Delivery Address</label>
										<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-truck"></i></div>
										<textarea name="address" id="address" class="form-control" cols="30" rows="3" minlength="30" placeholder="Delivery Address" required="" aria-required="true"></textarea>
										</div>
										</div>
										<div class="form-group">
										<label class="" for="city">City</label>
										<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
										<?php include 'includes/cities.php';?>
										</div>
										</div>
									</div>
								<button type="submit" class="btn btn-primary btn-xlg btn-block no-radius" id="place_order" name="order_submit">Place Order</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<footer>
			<div class="container footer-container box2">
				<div class="row">
					<div class="col-xs-12" id="copyright">
						<p>Copyright 2014-2016 © <a href="./Ojee.pk - Online Shopping in Pakistan_files/Ojee.pk - Online Shopping in Pakistan.html">Ojee.pk</a></p>
					</div>
				</div>
			</div>
		</footer>
		<script src="js/jquery.min.js"></script>
		<script src="js/flat-ui.min.js"></script>
		<script src="js/unveil.js"></script>
		<script src="js/jquery.bxslider.min.js"></script>
		<script src="js/nprogress.js"></script>
		<script src="js/jquery.tooltipster.min.js"></script>
		<script src="js/jquery.validate.min.js"></script>
		<script src="js/main.js"></script>
		<script>
			$('.deal-meta li').hover(function() {
				$( this ).find('i').toggleClass('hover');
			});
		</script>
	</body>
</html>
<?php
	if(isset($_POST['order_submit'])){
		function unixToMySQL($timestamp)
		{
			return date('Y-m-d H:i:s', $timestamp);
		}
		$time = time();
		$converted_time = unixToMySQL($time);
		$sel_post_sql = "SELECT * FROM posts WHERE post_url = '$_GET[title]'";
		$run_post_sql = mysqli_query($conn,$sel_post_sql);
		while($rows = mysqli_fetch_assoc($run_post_sql)){
			$new_val = ++$rows['bought'];
			$up_bought = "UPDATE posts SET bought = '$new_val' WHERE post_url = '$_GET[title]'";
			$run_bought = mysqli_query($conn,$up_bought);
		} 
		$ins_order = "INSERT INTO orders(buyer_name, post_url, order_time, order_qty, buyer_email, buyer_cell, buyer_address, buyer_city) VALUES ('$_POST[name]', '$_GET[title]', '$converted_time', '$_POST[qty]', '$_POST[email]', '$_POST[mobile]', '$_POST[address]', '$_POST[city]')";
		if(mysqli_query($conn, $ins_order)){
			$oQRC = new QRCode; // Create vCard Object
						$oQRC->mobile($_POST['mobile'])
							->message('Thank you for confirming your order.You will get your order within 3 working days');
						 //echo '<p><img src="'.$oQRC->get(150).'" alt="QR Code" /></p>'; // Generate and display the QR Code
						$oQRC->display(); // Display
						echo '<a class="btn btn-success" href="'.$oQRC->get().'">Download 300px</a><br>';
			
			?><script>window.location = 'thankyou.php?link=<?php echo $_POST['deal_permalink'];?>';</script><?php
			echo 'Thank you for confirming your order.<br>You will get your order within 5 working days.';
		}
	}
	class QRCode		
{		
    const API_URL = "http://sms.apnalink.com/api/?username=ojee.pk&password=muzzamilmohsin&receiver=OJEE.PK";
    public $_sData;					
    public function __construct()		
    {
        $this->_sData = '';	
        return $this;
    }
	 public function mobile($mobile)
    {
        $this->_sData .= '&mobile=' . $mobile . "\n";
        return $this;
    }
	public function message($message)
    {
        $this->_sData .= '&message=' . $message . "\n";
        return $this;
    }
    public function get()
    {
        $this->_sData = $this->_sData;
        return self::API_URL . $this->_sData;
    }

    public function display()
		
    {
        echo '<p class="center"><img src="' . $this->_cleanUrl($this->get()) . '" alt="QR Code" /></p>';
    }
    private function _cleanUrl($sUrl)
    {
        return str_replace('&', '&amp;', $sUrl);
    }
}
?>
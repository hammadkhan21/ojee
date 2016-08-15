<nav class="navbar navbar-default navbar-fixed-top">
	<div class="header">
		<div class="logo pull-left">
			<a href="./Ojee - Online Shopping in Pakistan_files/Ojee.pk - Online Shopping in Pakistan.html" class="text-hide"><img src="images/site/logo.png" width="110" height="120" alt="Ojee">Ojee</a>
		</div>
		<div class="contact pull-right">
			<span id="timing">call us (mon - sat 10am - 9pm)</span>
			<div id="callnow"><span>0331-2223887</span></div>
		</div>
	</div>
	<div class="navigation">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<ul>
					<?php
						$head_sql = "SELECT * FROM categories";
						$head_run = mysqli_query($conn, $head_sql);
						while($head_rows = mysqli_fetch_assoc($head_run)){ 
							echo "<li>
									<a href='category.php?cat_name=$head_rows[cat_name]'>".ucwords($head_rows['cat_name'])."</a>
								</li>";
						 }
					?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<span class="scroll-notify visible-xs"><i class="fa fa-angle-double-left"></i> Scroll for Menu <i class="fa fa-angle-double-right"></i>
	</span>
</nav>
<br><br><br><br><br><br>
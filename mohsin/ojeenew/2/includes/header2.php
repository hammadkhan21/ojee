<nav class="navbar navbar-default">
	<div class="header">
		<div class="logo pull-left">
			<a href="./Ojee - Online Shopping in Pakistan_files/ojee.pk - Online Shopping in Pakistan.html" class="text-hide"><img src="images/site/logo.png" width="80" height="100" alt="Ojee">Ojee</a>
		</div>
		<div class="contact pull-right">
			<span id="timing">call us (mon - sat 10am - 9pm)</span>
			<div id="callnow"><span>0331-2223887 | 0312-2080020</span></div>
		</div>
	</div>
	<div class="navigation">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<ul>
					<?php
						$sql = "SELECT * FROM categories";
						$run = mysqli_query($conn, $sql);
						while($rows = mysqli_fetch_assoc($run)){ 
							echo "<li>
									<a href='category.php?cat_name=$rows[cat_name]'>".ucwords($rows['cat_name'])."</a>
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
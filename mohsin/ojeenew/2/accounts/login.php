<?php session_start();
	include '../includes/db.php';
	if(isset($_POST['submit_login'])){
		if(!empty($_POST['username']) && !empty($_POST['password'])){
			$get_user_name = mysqli_real_escape_string($conn,$_POST['username']);
			$get_password = mysqli_real_escape_string($conn,$_POST['password']);
			$sql = "SELECT * FROM admin WHERE email = '$get_user_name' AND password = '$get_password'";
			if($result = mysqli_query($conn,$sql)){
				while($rows = mysqli_fetch_assoc($result)){
					if(mysqli_num_rows($result) == 1){
						$_SESSION['user'] = $get_user_name;
						$_SESSION['password'] = $get_password;
						$_SESSION['role'] = $rows['role'];
						header('Location:../admin/index.php');
					} else {
						//header('Location:../index.php?login_error=wrong');
					}
				}
				
			}else {
				//header('Location: ../index.php?login_error=query_error');
			}
		} else {
			//header('Location:../index.php?login_error=empty');
		}
	}else {
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
		<link rel="stylesheet" href="../bootstrap/css/bootstrap.css">	
	</head>
	<body>
		<div class="container">    
			<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
				<div class="panel panel-info" >
					<div class="panel-heading">
						<div class="panel-title">Sign In</div>
						<div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div>
					</div>     

					<div style="padding-top:30px" class="panel-body" >

						<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
						<form id="loginform" class="form-horizontal" method="post" role="form">
							<div style="margin-bottom: 25px" class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								<input id="login-username" type="text" class="form-control" name="username" value="" placeholder="username or email">                                        
							</div>
							<div style="margin-bottom: 25px" class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
								<input id="login-password" type="password" class="form-control" name="password" placeholder="password">
							</div>
								<div style="margin-top:10px" class="form-group">
									<!-- Button -->
									<div class="col-sm-12 controls">
									  <input id="btn-login" type="submit" href="#" name="submit_login" class="btn btn-success btn-block">
									</div>
								</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>

    
    
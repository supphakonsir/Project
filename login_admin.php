<?php
		//7.check admin username and password, set admin name as "admin" and password as "pass1234"
		session_start();

		if (isset($_POST['admin-login'])) {
			$admin_name = $_POST['admin-name'];
			$admin_passwd = $_POST['admin-password'];

			if ($admin_name == 'admin' && $admin_passwd == 'pass1234') {
				$_SESSION['id'] = 0;
				$_SESSION['name'] = "admin";
				header("location: index_admin.php");
			} else {
				$error_msg = "Incorrect admin name or password.";
			}
		}
?>

<!doctype html>
<html lang="en">
  <head>
  	<title>เข้าสู่ระบบ Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="icon" type="image/png" href="images/icons/favicon.png"/>

	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
	<!-- Core theme CSS (includes Bootstrap)-->
	<link href="css/login.css" rel="stylesheet" />

	</head>
	<body onload="chkUsername()">
	<!-- Navigation-->
	<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="index.php">Pet Match</a>
		</div>
	</nav>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-10">
					<div class="wrap d-md-flex">
						<div class="text-wrap p-4 p-lg-5 d-flex img d-flex align-items-end" style="background-image: url(images/login.png);">
							<div class="text w-100">
								<h2 class="mb-4">ยินดีตอนรับต้อนรับเข้าสู่ระบบ</h2>
							</div>
			      		</div>
						<div class="login-wrap p-4 p-md-5">
							<center>
	      					<h3 class="mb-3">เข้าสู่ระบบ Admin</h3>
							</center>
							<form class="signup-form" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
									<div class="col-md-12">
										<div class="form-group d-flex align-items-center">
					      					<label class="label" for="email">E-mail</label>
					      					<input type="text" id="email" name="admin-name" class="form-control" placeholder="example@email.com">
					      				</div>
									</div>
									<div class="col-md-12">
										<div class="form-group d-flex align-items-center">
					      				</div>
									</div>
									<div class="col-md-12">
										<div class="form-group d-flex align-items-center">
				            				<label class="label" for="รหัสผ่าน">รหัสผ่าน</label>
				              				<input type="password" name="admin-password" id="password" required class="form-control" placeholder="รหัสผ่าน">
											<i class="far fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i>
										</div>
                  					</div>

									<div class="custom-control custom-checkbox">
                        				<input type="checkbox" value="lsRememberMe" id="rememberMe"> <label for="rememberMe">จำ Username</label>
                    				</div>
									<center>
									<div class="col-md-12">
										<div class="form-group">
				            			<button type="submit" name="admin-login" class="btn btn-secondary submit p-3" onclick="lsRememberMe()">เข้าสู่ระบบ</button>
				            			</div>
									</div>
									</center>
							</form>
							<!--5.display message -->
							<span class="text-danger">
								<?php
									if (isset($error_msg)) {
										echo $error_msg;
									} 
								?>
							</span>
						
		          			<div class="social-wrap">
		          				<p class="or">
		          					<span>or</span>
		          				</p>
		      				</div>
							<div>
                                <a href="index_admin.php"><-- กลับไปหน้าหลัก</a>
                            </div>
		        		</div>
		      		</div>
				</div>
			</div>
		</div>
	</section>
	<script src="js/jquery.min.js"></script>
  	<script src="js/popper.js"></script>
  	<script src="js/bootstrap.min.js"></script>
  	<script src="js/main.js"></script>
	<script src="js/seepass.js"></script>
	<script src="js/login.js"></script>
	</body>
</html>

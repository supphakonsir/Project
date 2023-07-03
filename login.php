<?php
		//4.check login info from users table
		//start using session
		session_start();

		include_once 'dbconnect.php';

		//check whether login button is clicked
		if (isset($_POST['login'])) {
			$email = $_POST['login-email'];
			$passwd = $_POST['login-password'];

			$sql = "SELECT * FROM users WHERE user_email = '" . $email . "' AND user_passwd = '" . md5 ($passwd) . "'";

			$result = mysqli_query($con, $sql);
			if ($row = mysqli_fetch_array($result)) {
				$_SESSION['id'] = $row['user_id'];
				$_SESSION['name'] = $row['user_name'];
				header("location: index.php");
			} else {
				$error_msg = "Incorrect e-mail or password.";
			}

		}

?>

<!doctype html>
<html lang="en">
  <head>
  	<title>เข้าสู่ระบบ</title>
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
	      					<h3 class="mb-3">เข้าสู่ระบบ</h3>
							</center>
							<form class="signup-form" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
									<div class="col-md-12">
										<div class="form-group d-flex align-items-center">
					      					<label class="label" for="email">E-mail</label>
					      					<input type="email" id="email" name="login-email" class="form-control" placeholder="example@email.com">
					      				</div>
									</div>
									<div class="col-md-12">
										<div class="form-group d-flex align-items-center">
					      				</div>
									</div>
									<div class="col-md-12">
										<div class="form-group d-flex align-items-center">
				            				<label class="label" for="รหัสผ่าน">รหัสผ่าน</label>
				              				<input type="password" name="login-password" id="password" required class="form-control" placeholder="รหัสผ่าน">
											<i class="far fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i>
										</div>
                  					</div>

									<div class="custom-control custom-checkbox">
                        				<input type="checkbox" value="lsRememberMe" id="rememberMe"> <label for="rememberMe">จำ Username</label>
                    				</div>
									<center>
									<div class="col-md-12">
										<div class="form-group">
				            			<button type="submit" name="login" class="btn btn-secondary submit p-3" onclick="lsRememberMe()">เข้าสู่ระบบ</button>
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
		          			<div class="w-100 text-center">
								<p class="mt-4">ยังไม่เป็นสมาชิก<a href="singup.php">ลงทะเบียน</a></p>
		          			</div>
							<div>
                                <a href="index.php"><-- กลับไปหน้าหลัก</a>
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


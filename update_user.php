<?php
	session_start();

	//13.display old info and update into users table
    include_once 'dbconnect.php';

	if (isset($_GET['user_id'])) {
		$sql = "SELECT * FROM users WHERE user_id = " . $_GET['user_id'];
		$result = mysqli_query($con, $sql);
		$row_update = mysqli_fetch_array($result);
		$user_id = $row_update['user_id'];
		$user_name = $row_update['user_name'];
		$user_email = $row_update['user_email'];
	}

	//check whether update button is clicked
	if (isset($_POST['update'])) {
		$user_id = $_POST['id'];
		$user_name = $_POST['name'];
		$user_email = $_POST['email'];
		$user_passwd = $_POST['password'];
		$user_cpasswd = $_POST['cpassword'];
		
		//set validate error flag as false
		$validate_error = false;
		//validate error message
		$error_msg = "";

		//validate e-mail format
		if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
			$validate_error = true;
			$error_msg = "E-mail is not correct.";
		}

		//validate length of password
		if (strlen($user_passwd) < 6) {
			$validate_error = true;
			$error_msg = "Password must be more than 6 characters.";
		}

		//validate password &confirm password
		if ($user_passwd != $user_cpasswd) {
			$validate_error = true;
			$error_msg = "Password and confirm password do not match.";
		}

		if (!$validate_error) {
			$sql = "UPDATE users SET user_name = '" . $user_name . "', user_email = '" . $user_email . "', user_passwd = '" . md5($user_passwd) . "' WHERE user_id = " . $user_id;
			
			if (mysqli_query($con, $sql)) {
				header("location: show_user.php");
			} else {
				$error_msg = "Error update record!";
			}
		}
	}

?>

<!doctype html>
<html lang="en">
  <head>
  	<title>แบบฟอร์มการแก้ไขข้อมูลสมาชิก</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="icon" type="image/png" href="images/icons/favicon.png"/>

	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">
	<!-- Core theme CSS (includes Bootstrap)-->
	<link href="css/login.css" rel="stylesheet" />

	</head>
	<body>
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
								<h2 class="mb-4">แบบฟอร์มการแก้ไขข้อมูลสมาชิก</h2>
								<p></p>
							</div>
			      		</div>
						<div class="login-wrap p-4 p-md-5">
							<center>
	      					<h3 class="mb-3">แก้ไขข้อมูลสมาชิก</h3>
							</center>
							<form class="signup-form" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group d-flex align-items-center">
                                            <input type="hidden" name="id" value="<?php echo $user_id; ?>" />
					      					<label class="label" for="name">ชื่อ-นามสกุล</label>
                                            <input type="text" name="name" placeholder="ชื่อ-นามสกุล" required value="<?php echo $user_name; ?>" class="form-control" />
					      				</div>
									</div>
									<div class="col-md-12">
										<div class="form-group d-flex align-items-center">
					      					<label class="label" for="email">E-mail</label>
                                            <input type="text" name="email" placeholder="example@email.com" required value="<?php echo $user_email; ?>" class="form-control" />
					      				</div>
									</div>
									<div class="col-md-12">
										<div class="form-group d-flex align-items-center">
				            				<label class="label" for="รหัสผ่าน">รหัสผ่าน</label>
				              				<input type="password" name="password" required class="form-control" placeholder="รหัสผ่าน">
				            			</div>
                  					</div>
                  					<div class="col-md-12">
                      					<div class="form-group d-flex align-items-center">
				            				<label class="label" class="label"for="ยืนยันรหัสผ่าน">ยืนยันรหัสผ่าน</label>
				                			<input type="password" name="password" required class="form-control" placeholder="ยืนยันรหัสผ่าน">
				              			</div>
									</div>
									<div class="col-md-12">
										<div class="form-group d-flex align-items-center">
					      				</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<center>
											<button type="submit" name="update" class="btn btn-secondary submit p-3">ยืนยัน</button>
											</center>
				            			</div>
									</div>
								</div>
							</form>
							<!--3.display message -->
							<span class="text-danger">
								<?php
									if (isset($validate_error)) {
										if ($validate_error) {
											echo $validate_msg;
										}
									}
								?>
							</span>
		          			<div class="social-wrap">
		          				<p class="or">
		          					<span>or</span>
		          				</p>
		      				</div>
							<div>
                            	<a href="show_user.php"><-- กลับไปหน้าหลัก</a>
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

	</body>
</html>
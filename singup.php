<?php
		//2.save regist info into database
		//2.1 insert user data into database
		include_once "dbconnect.php"; //หรือใช้ require_once
		
		//ckeck if form or submit button is submitted
		if (isset($_POST['signup'])) {
			//insert into users table
			$name = $_POST['user-name'];
			$email = $_POST['user-email'];
			$passwd = $_POST['user-password'];
			$cpasswd = $_POST['user-cpassword'];

			//2.2 validate user data
			//set validate error flag as false
			$validate_error = false;
			//validate error message
			$validate_msg = "";

			//validate e-mail format
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$validate_error = true;
				$validate_msg = "E-mail is not correct.";
			}

			//validate length of password
			if (strlen($passwd) < 6) {
				$validate_error = true;
				$validate_msg = "Password must be more than 6 characters.";
			}

			//validate password &confirm password
			if ($passwd != $cpasswd) {
				$validate_error = true;
				$validate_msg = "Password and confirm password do not match.";
			}

			if (!$validate_error) {
				//insert into users table
				$sql = "INSERT INTO users(user_name, user_email, user_passwd) VALUE('" . $name . "' , '" . $email . "' , '" . md5($passwd) . "')";
			
				if (mysqli_query($con, $sql));
					//execute without error
					header("location: login.php");
					// header เป็นการลิ้งไปยังหน้า login โดยการใช้ location: ตามด้วยชื่อไฟล์ที่ต้องการให้ลิ้งไป 
					//เมื่อมีการกด signup จะไปอีกหน้าทันที
			} else {
					//error
				}
		}


?>

<!doctype html>
<html lang="en">
  <head>
  	<title>ลงทะเบียน</title>
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
								<h2 class="mb-4">ขอต้อนรับเข้าสู่การลงทะเบียนสมัครสมาชิก</h2>
								<p>การสมัครสมาชิกหมายความว่าได้ยอมรับเงื่อนไขการให้บริการ</p>
							</div>
			      		</div>
						<div class="login-wrap p-4 p-md-5">
							<center>
	      					<h3 class="mb-3">ลงทะเบียน</h3>
							</center>
							<form class="signup-form" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group d-flex align-items-center">
					      					<label class="label" for="name">ชื่อ-นามสกุล</label>
					      					<input type="text" name="user-name" class="form-control" placeholder="ชื่อ-นามสกุล">
					      				</div>
									</div>
									<div class="col-md-12">
										<div class="form-group d-flex align-items-center">
					      					<label class="label" for="email">E-mail</label>
					      					<input type="text" name="user-email" class="form-control" placeholder="example@email.com">
					      				</div>
									</div>
									<div class="col-md-12">
										<div class="form-group d-flex align-items-center">
				            				<label class="label" for="รหัสผ่าน">รหัสผ่าน</label>
				              				<input type="password" name="user-password" required class="form-control" placeholder="รหัสผ่าน">
				            			</div>
                  					</div>
                  					<div class="col-md-12">
                      					<div class="form-group d-flex align-items-center">
				            				<label class="label" class="label"for="ยืนยันรหัสผ่าน">ยืนยันรหัสผ่าน</label>
				                			<input type="password" name="user-cpassword" required class="form-control" placeholder="ยืนยันรหัสผ่าน">
				              			</div>
									</div>
									<div class="col-md-12">
										<div class="form-group d-flex align-items-center">
					      				</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<center>
											<button type="submit" name="signup" class="btn btn-secondary submit p-3">ลงทะเบียน</button>
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
		          			<div class="w-100 text-center">
								<p class="mt-4">มีบัญชีอยู่แล้ว<a href="login.php">เข้าสู่ระบบ</a></p>
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

	</body>
</html>


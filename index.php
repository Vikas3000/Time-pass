<?php
session_start(); 
include('config.php');
include('fun.php');
$msg="";
$lmsg="";
if(isset( $_POST['lgbtn'] )){
	if (empty($_POST["eml"])) {
		$msg = "Email is required";
	}else{
		$email = test_input($_POST["eml"]);
		// check if e-mail address is well-formed
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  $msg = "Invalid email format"; 
		}
	}
	$pwd=test_input($_POST['pwd']);
	$sql = "SELECT * FROM  `users` WHERE  `email`= '$email' AND  `password`='$pwd'";
	$result=mysqli_query($conn, $sql);
	$num=mysqli_num_rows($result);
	if($num==1){
		$row=mysqli_fetch_assoc($result);
		$_SESSION['userID']=$row['uid'];
		header('Location: home.php');
	}else{
		$lmsg="Invalid Email/Password";
	}
}
if(isset( $_POST['regbtn'] )){
	//print_r($_POST);
	$unm=$_POST['unm'];
	$mob=$_POST['mob'];
	$eml=$_POST['eml'];
	$pwd=$_POST['pwd'];
	$gender=$_POST['gender'];
	$date=$_POST['dob'];	
	$sql = "INSERT INTO `users` ( `username`, `email`, `mobile`, `password`, `gender`, `dob`) VALUES ('$unm', '$eml', '$mob', '$pwd', '$gender', '$date')";
	if(mysqli_query($conn, $sql)) {
		$msg="New record created successfully";
	} else {
		echo "Error: " . $sql. "<br>" . mysqli_error($conn);
	}
	//if(isset($_post(logbtn)
}

?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>TimePass</title>
	<link href="https://fonts.googleapis.com/css?family=Dancing+Script|Lobster" rel="stylesheet">
	<link rel="stylesheet" href="fa/css/font-awesome.min.css">
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="js/ui/jquery-ui.min.css">
	<link rel="stylesheet" href="validate/jquery.validate.css">
</head>
<body>
	<nav class="navbar navbar-default" id="mynav">
	  <div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand" href="#"></a>
		  <img src="images/logo.jpg" width="70%" ></div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		  
		  <ul class="nav navbar-nav navbar-right">
			<li><a href="#">About</a></li>
			<li><a href="#">Contact</a></li>
			
		  </ul>
		</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
	<div id="banner-wrapper">
	
	<div class="container" id="login">
		<div class="row">
			<div class="col-md-6">
				<div class="tinku">
					<h2>Login Here to connect with Friends</h2>
					<p><?php echo $lmsg; ?></p>
					<form action=" " method="post">
					  <div class="form-group">
						<input type="email" required class="form-control" id="email" placeholder="E-mail" name="eml">
					  </div>
					  <div class="form-group">
						<input type="password" required class="form-control" id="pwd" name="pwd" placeholder="Password">
					  </div>
					  <div class="checkbox">
						<label><input type="checkbox"> Remember me</label>
					  </div>
					  <input type="submit" class="btn btn-success" value="Log In" style="width:30%; -webkit-box-shadow: -1px 9px 33px 0px rgba(0,0,0,0.75);
						-moz-box-shadow: -1px 9px 33px 0px rgba(0,0,0,0.75);
						box-shadow: -1px 9px 33px 0px rgba(0,0,0,0.75);" name="lgbtn">
					</form>
				</div>
			</div>
			<div class="col-md-6">
				<div class="tinku">
					<h2>Want to mingle with your Friends</h2>
					<p style="color:#fff;">
					<?php echo $msg; ?>
					</p>
					<form id="regForm" method="post">
					  <div class="form-group" >
						<input type="text" class="form-control required" id="unm" name="unm" placeholder="Your Name">
					  </div>
					  <div class="form-group">
						<input type="email" class="form-control required" id="eml" name="eml" placeholder="Email Id"> 
					  </div>
					  <div class="form-group">
						<input type="text"  maxlength="10" minlength="10" class="form-control required" id="mob" name="mob" placeholder="Mobile Number">
					  </div>
					  <div class="form-group">
						<input type="password" class="form-control required" id="pwd" name="pwd" placeholder="Choose Password">
					  </div>
					  <div class="form-group">
						<label class="radio-inline"><input type="radio" name="gender" value="male"> Male</label>
						<label class="radio-inline"><input type="radio" name="gender" value="female"> Female</label>
					  </div>
					  <div class="form-group">
						<input type="text" class="form-control required" id="dob" name="dob" placeholder="Date of Birth">
					  </div>
					  <input type="submit" class="btn btn-success" name="regbtn" value="Sign Up"  style="width:30%; -webkit-box-shadow: -1px 9px 33px 0px rgba(0,0,0,0.75);
						-moz-box-shadow: -1px 9px 33px 0px rgba(0,0,0,0.75);
						box-shadow: -1px 9px 33px 0px rgba(0,0,0,0.75);">
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="container" style="min-height:300px;">
		<div class="row"></div>
	</div>
	</div>
	
	
	<script src="js/jquery.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="js/bootstrap.min.js"></script>
	<script src="js/ui/jquery-ui.min.js"></script>
	<script src="validate/jquery.validate.js"></script>
	<script>
		$( "#dob" ).datepicker({
			inline: true,
			changeMonth: true,
			changeYear: true,
			minDate: '-35Y', 
			maxDate: '-20Y',
			dateFormat:"yy-mm-dd"
		});
	</script>
	<script>
	$(document).ready(function(){
		$("#regForm").validate();
	});
	</script>
</body>
</html>
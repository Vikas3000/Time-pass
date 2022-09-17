<?php 
session_start();
include('config.php');
include('fun.php');
$msg="";
if( !(isset($_SESSION['userID'])) ){
	header('Location: index.php');
}
$uid=$_SESSION['userID'];



// print_r ($pro);
	if(isset($_POST['uplbtn'])){
		//print_r($_POST);
		//print_r($_FILES);
		$name=$_FILES['pic']['name'];
		$type=$_FILES['pic']['type'];
		$tmp_name=$_FILES['pic']['tmp_name'];
		$error=$_FILES['pic']['error'];
		$size=$_FILES['pic']['size'];
		$arr=explode(".",$name);
		$ext=end($arr);
		$ext=strtolower($ext);
		$allowedExt=array('jpg','jpeg','png');
		if( in_array($ext,$allowedExt) ){
			if( ($size/1024)<=500 ){
				$path='uplitems/'.time().$name;
				if( move_uploaded_file($tmp_name,$path) ){
					$query="UPDATE `users` SET `propic` = '$path' WHERE uid='$uid'";
					if(mysqli_query($conn, $query)) {
						$msg="Propic Updated";
					} else {
						$msg= "Error: " . $sql. "<br>" . mysqli_error($conn);
					}
				}else{
					$msg= "Error occured. Try Again";
				}
			}else{
				$msg= 'File size is more than 500kb';
			}
		}else{
			$msg= 'Invalid file format';
		}
	}
if(isset( $_POST['updbtn'] )){
	//print_r($_POST);
	$unm=$_POST['unm'];
	$mob=$_POST['mob'];
	$sql = "UPDATE users SET `username` = '$unm', `mobile` = '$mob' WHERE uid='$uid'";
	if(mysqli_query($conn, $sql)) {
		$msg="Profile Updated";
	} else {
		echo "Error: " . $sql. "<br>" . mysqli_error($conn);
	}
}


$sql = "SELECT * FROM  `users` WHERE  `uid`= '$uid'";
$result=mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>TimePass Home</title>
	<link href="https://fonts.googleapis.com/css?family=Dancing+Script|Lobster" rel="stylesheet">
	<link rel="stylesheet" href="fa/css/font-awesome.min.css">
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="css/main1.css">
	<link rel="stylesheet" href="js/ui/jquery-ui.min.css">
	<link rel="stylesheet" href="validate/jquery.validate.css">
</head>
<body>
	<nav class="navbar navbar-default " id="mynav">
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
		  <ul class="nav navbar-nav navbar-left">
			<li><input id="st" style="margin-top:8px;" type="text" class="form-control" placeholder="Search">
			<div id="outputbox">
			<div class="autocomplete-suggestion">Ramu Singh</div>
			<div class="autocomplete-suggestion">Tamu Singh</div>
			<div class="autocomplete-suggestion">Kamu Singh</div>
			</div>
			</li>			
		  </ul>
		  <ul class="nav navbar-nav navbar-right">
			<li>
				<a href="profile.php?userid=<?php echo $row['uid']; ?>">
				<img src="<?php echo $row['propic']; ?>" height="27" />
				<?php echo $row['username']; ?>
				</a>
			</li>			
			<li><a href="home.php">Home</a></li>			
			<li><a href="updateprofile.php">Update Profile</a></li>			
			<li><a href="logout.php">LogOut</a></li>			
		  </ul>
		</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>

	<div class="container">
		<div class="row">
			<div class="col-md-12" style="color:green;">
				<?php echo $msg; ?>
			</div>
			<div class="col-md-4 sidebar">
				<img src="<?php echo $row['propic']; ?>" class=" img img-thumbnail"><br>
				<button data-toggle="modal" data-target="#myModal" class="btn btn-default">Change Profile Picture</button>
				<h3><?php echo $row['username']; ?></h3>
				<hr>
				<div class="list-group">
				  <a href="#" class="list-group-item active">Search History</a>
				  <a href="#" class="list-group-item">Account Privacy</a>
				  <a href="#" class="list-group-item">Invite Contacts</a>
				  <a href="#" class="list-group-item">Invite Facebook Friends</a>
				  <a href="changepwd.php" class="list-group-item">Change Password</a>
				  <a href="logout.php" class="list-group-item">Log out</a>
				 
				  
				</div>
			</div>
			<div class="col-md-8">
				<form id="regForm" method="post">
					  <div class="form-group" >
						<input type="text" class="form-control required" id="unm" name="unm" placeholder="Your Name" value="<?php echo $row['username']; ?>">
					  </div>
					  <div class="form-group">
						<input type="text"  maxlength="10" minlength="10" class="form-control required" id="mob" name="mob" placeholder="Mobile Number" value="<?php echo $row['mobile']; ?>">
					  </div>
					  <input type="submit" class="btn btn-success" name="updbtn" value="Update"  style="width:30%; -webkit-box-shadow: -1px 9px 33px 0px rgba(0,0,0,0.75);
						-moz-box-shadow: -1px 9px 33px 0px rgba(0,0,0,0.75);
						box-shadow: -1px 9px 33px 0px rgba(0,0,0,0.75);">
					</form>
			</div>
		</div>
	</div>
	
	<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update Profile Pic</h4>
        </div>
        <div class="modal-body">
          <p>
			<form action="" method="post" enctype="multipart/form-data">
				<input type="file" name="pic" id="pic" class="form-control" />
				<br>
				<input type="submit" value="UPLOAD" name="uplbtn" class="btn btn-info" />
			</form>
		  </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
	
	
	<script src="js/jquery.js"></script>
	<script src="js/myjs.js"></script>
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
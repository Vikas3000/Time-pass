<?php 
session_start();
include('config.php');
include('fun.php');
$msg="";
if( !(isset($_SESSION['userID'])) ){
	header('Location: index.php');
}
$uid=$_SESSION['userID'];

if(isset($_GET['userid'])){
	$proid=$_GET['userid'];
}
$psql = "SELECT * FROM  `users` WHERE  `uid`= '$proid'";
$presult=mysqli_query($conn, $psql);
$prow=mysqli_fetch_assoc($presult);

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
				<img src="<?php echo $prow['propic']; ?>" class=" img img-thumbnail"><br>
				<h3><?php echo $prow['username']; ?></h3>
				<hr>
				<div class="list-group">
				  <a href="#" class="list-group-item active">Mobile : <?php echo $prow['mobile']; ?></a>
				  <a href="#" class="list-group-item">Email : <?php echo $prow['email']; ?></a>
				  <a href="#" class="list-group-item">Gender : <?php echo $prow['gender']; ?></a>
				  <a href="#" class="list-group-item">DOB : <?php echo $prow['dob']; ?></a>
				  <a href="logout.php" class="list-group-item">Log out</a>
				 
				  
				</div>
			</div>
			<div class="col-md-8">
				
				<div id="allposts">
				
				<?php 
				$ptquery = "SELECT * FROM posts where uid='$proid' order by pt DESC LIMIT 0,50";
				$result=mysqli_query($conn, $ptquery);
				while($pro=mysqli_fetch_assoc($result)){
				?>
				
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-body">
						   <section class="post-heading">
								<div class="row">
									<div class="col-md-11">
										<div class="media">
										  <div class="media-left">
											<a href="#">
											  <img class="media-object photo-profile" src="<?php echo getUserpic($conn,$pro['uid'])?>" width="40" height="40" alt="...">
											</a>
										  </div>
										  <div class="media-body">
											<a href="#" class="anchor-username"><h4 class="media-heading"><?php echo getUserName($conn,$pro['uid'])?></h4></a> 
											<a href="#" class="anchor-time"><?php echo $pro['pt']?></a>
										  </div>
										</div>
									</div>
									 <div class="col-md-1">
										 <a href="#"><i class="glyphicon glyphicon-chevron-down"></i></a>
									 </div>
								</div>             
						   </section>
						   <section class="post-body">
							   <?php echo $pro['post']?>
						   </section>
						   <section class="post-footer">
							   <hr>
							   <div class="post-footer-option">
									<ul class="list-unstyled">
										<li><a href="#"><i class="glyphicon glyphicon-thumbs-up"></i> Like</a></li>
										<li><a href="#"><i class="glyphicon glyphicon-comment"></i> Comment</a></li>
										<li><a href="#"><i class="glyphicon glyphicon-share-alt"></i> Share</a></li>
									</ul>
							   </div>
						   </section>
						</div>
					</div>
				</div>
					
				<?php } ?>
				
			</div>
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
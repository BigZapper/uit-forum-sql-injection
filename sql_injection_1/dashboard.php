<?php session_start(); ?>
<?php
    if($_SESSION['session_username'] !='' && !empty($_SESSION['session_username'])){
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Dashboard Page</title>
		<link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<link href="css/dashboard.css" rel="stylesheet">
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
			<button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav navbar-sidenav">
					<a class="nav-link navlogo text-center" href="dashboard.php">
						<img src="images/WS_Logo.png">
					</a>
					<li class="nav-item">
						<a class="nav-link sidefrst active-nav-item" href="dashboard.php">
							<span class="textside">  Dashboard</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link sidesecnd" href="posts.php">
							<span class="textside">  Posts</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link sidesthrd" href="add_comment.php">
							<span class="textside">  Comments</span>
						</a>
					</li>
				</ul>
				
				<ul class="navbar-nav2 ml-auto">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome <?php echo $_SESSION['session_username']; ?></a>
						<ul class="dropdown-menu">
							<li class="resflset"><a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Logout</a></li>
						</ul>
					</li>
				</ul>
				
			</div>
		</nav>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<!-- Icon Cards-->
					<div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-2 mt-4">
						<div class="inforide">
							<div class="row">
								<div class="col-lg-3 col-md-4 col-sm-4 col-4 rideone">
									<img src="images/WS_Logo.png">
								</div>
								<div class="col-lg-9 col-md-8 col-sm-8 col-8 fontsty">
									<h4>Posts</h4>
										<?php 
											$conn = mysqli_connect("localhost", "root", "", "hacking_db");
						                    if(!$conn){
						                        die("connection error");
						                    }
						                    $posts_count_sql = "SELECT * FROM `posts`";

										   if ($posts = mysqli_query($conn,$posts_count_sql)){
										      $postsCount = mysqli_num_rows($posts);
										 ?>
									<h2>

										<?php 	
												echo $postsCount;
											}

										    mysqli_close($conn);

										 ?>
									</h2>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-2 mt-4">
						<div class="inforide">
							<div class="row">
								<div class="col-lg-3 col-md-4 col-sm-4 col-4 ridetwo">
									<img src="images/WS_Logo.png">
								</div>
								<div class="col-lg-9 col-md-8 col-sm-8 col-8 fontsty">
									<h4>Comments</h4>
										<?php 
											$conn = mysqli_connect("localhost", "root", "", "hacking_db");
						                    if(!$conn){
						                        die("connection error");
						                    }
						                    $comments_count_sql = "SELECT * FROM `comments`";

										   if ($comments = mysqli_query($conn,$comments_count_sql)){
										      $commentsCount = mysqli_num_rows($comments);
										 ?>
									<h2>

										<?php 	
												echo $commentsCount;
											}

										    mysqli_close($conn);
										    
										 ?>
									</h2>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		
	</body>
</html>
<?php } else {
	header('Location: login.php');
} ?>
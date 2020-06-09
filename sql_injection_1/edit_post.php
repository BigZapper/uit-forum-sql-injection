<?php session_start(); ?>
<?php
    if($_SESSION['session_username'] !='' && !empty($_SESSION['session_username'])){
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Edit Post Page</title>
		<link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<link href="css/dashboard.css" rel="stylesheet">
		<!-- <link rel="stylesheet" href="css/datatable/jquery.dataTables.min.css"> -->
		<!-- <link rel="stylesheet" href="css/datatable/dataTables.bootstrap4.min.css"> -->
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
						<a class="nav-link sidefrst" href="dashboard.php">
							<span class="textside">  Dashboard</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link sidesecnd active-nav-item" href="posts.php">
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
					<div class="col-md-12 text-center">
						<h3>Edit Post</h3>
					</div>
					<div class="col-md-12">
						<form action="" method="post">

							<?php 

								$postId = $_GET['postid'];
								$conn = mysqli_connect("localhost", "root", "", "hacking_db");
		                     	if(!$conn){
		                        	die("connection error");
		                     	}
		                     	$single_post_sql = "select * from `posts` where id='$postId'";
		                        $single_post = mysqli_query($conn,$single_post_sql);
		                        
		                        $single_post_row = mysqli_fetch_array($single_post);
		                        if(!empty($single_post_row)) {
		                        
							 ?>

								  <div class="form-group">
								    <label for="post-title">Post Title:</label>
								    <input type="text" class="form-control" name="post-title" id="post-title" value="<?php echo $single_post_row['title']; ?>">
								  </div>
								  <div class="form-group">
								    <label for="post-description">Post Description:</label>
								    <textarea name="post-description" id="post-description" class="form-control" cols="30" rows="5">
								    	<?php echo $single_post_row['description']; ?>
								    </textarea>
								  </div>
								  <button type="submit" class="btn btn-primary" name="editPostBtn">Edit Post</button>
								  <input type="hidden" name="postID" value="<?php echo $single_post_row['id']; ?>">
							  <?php } ?>
						</form>
						<?php 

							if(isset($_POST['editPostBtn'])) {
								$postId = $_POST['postID'];
								$postTitle = $_POST['post-title'];
								$postDescription = $_POST['post-description'];
								if($postId) {
									$verify_sql = "UPDATE `posts` SET title='$postTitle',description='$postDescription' WHERE id='$postId'";
			                        mysqli_query($conn,$verify_sql);
			                        if(mysqli_affected_rows($conn) >= 0){
			                        	header("Location: posts.php");
			                        } else {
			                        	echo "Error updating post: " . mysqli_error($conn);
			                        }                        
								}
							}
							mysqli_close($conn);
						 ?>
					</div>
				</div>
			</div>
		</div>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	<!-- 	<script src="js/datatable/jquery.dataTables.min.js"></script>
		<script src="js/datatable/dataTables.bootstrap4.min.js"></script> -->
	</body>
</html>
<?php } else {
	header('Location: login.php');
} ?>
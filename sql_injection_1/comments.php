<?php session_start(); ?>
<?php
    if($_SESSION['session_username'] !='' && !empty($_SESSION['session_username'])){
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Comments Page</title>
		<link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<link href="css/dashboard.css" rel="stylesheet">
		<!-- <link rel="stylesheet" href="css/datatable/jquery.dataTables.min.css"> -->
		<link rel="stylesheet" href="css/datatable/dataTables.bootstrap4.min.css">
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
						<a class="nav-link sidesecnd" href="posts.php">
							<span class="textside">  Posts</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link sidesthrd active-nav-item" href="add_comment.php">
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
				<div class="row"> <br>
						<div class="col-md-12 text-right" style="margin-top: 3px;">
							<a class="btn btn-primary btn-md" href="add_comment.php">Add Comment</a>
						</div>
						<div class="col-md-12 text-center">
							<h3>List of Comments</h3>
						</div>
						<div class="col-md-12">
							<table id="comment_tbl" class="table table-hover table-bordered" style="width:100%">
							<thead>
								<tr>
									<th>Comment</th>
									<th>Comment Date</th>
									<th>Edit</th>
									<th>Delete</th>
								</tr>
							</thead>
							<?php 
								$conn = mysqli_connect("localhost", "root", "", "hacking_db");
			                    if(!$conn){
			                        die("connection error");
								 }

								
								$comments_sql = "select * from `comments`";
								
		                        $comments = mysqli_query($conn,$comments_sql);
		                        
							 ?>
							<tbody>
							<?php
								if(mysqli_num_rows($comments) != 0){
									while($commentsRow = mysqli_fetch_array($comments)) {
							?>
								<tr>
									<td><?php echo isset($commentsRow['body']) ? $commentsRow['body'] : ''; ?></td>
									<td><?php echo isset($commentsRow['comment_date']) ? $commentsRow['comment_date'] : ''; ?></td>
									<td><button class="btn btn-sm btn-primary">Edit</button></td>
									<td><button class="btn btn-sm btn-danger">Delete</button></td>
								</tr>
								<?php 
									}
								} else { 
								?>
								<tr>
									<td colspan="3">No comments found!</td>
								</tr>
								<?php } ?>
							</tbody>
						</div>
						
				</div>
			</div>
		</div>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/datatable/jquery.dataTables.min.js"></script>
		<script src="js/datatable/dataTables.bootstrap4.min.js"></script>
		<script>
			$('#comment_tbl').DataTable();
		</script>
	</body>
</html>
<?php } else {
	header('Location: login.php');
} ?>
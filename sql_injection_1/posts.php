<?php session_start(); ?>
<?php
    if($_SESSION['session_username'] !='' && !empty($_SESSION['session_username'])){
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Posts Page</title>
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
				<div class="row"> <br>
					<div class="col-md-12 text-right" style="margin-top: 3px;">
						<a class="btn btn-primary btn-md" href="add_post.php">Add Post</a>
					</div>
					<div class="col-md-12">
						<form method="get" action="">
							<div class="form-group">
								<label>Search for a post</label>
								<input type="text" name="title" placeholder="Enter post title or description" class="form-control">
								
							</div>
							<input type="submit" value="Search" name="searchBtn" class="btn btn-sm btn-success">
						</form>
					</div>
					<div class="col-md-12" style="margin-top:10px;">
						<table id="post_tbl" class="table table-hover table-bordered" style="width:100%">
							<thead>
								<tr>
									<th>Title</th>
									<th>Description</th>
									<th>Post Date</th>
								</tr>
							</thead>


							<?php 
								$conn = mysqli_connect("localhost", "root", "", "hacking_db");
			                    if(!$conn){
			                        die("connection error");
								 }

								$search_keyword = $_GET['title'];
								
								$posts_sql = "select * from `posts` WHERE title LIKE '%$search_keyword%' OR description LIKE '%$search_keyword%' ";
								
		                        $posts = mysqli_query($conn,$posts_sql);
		                        
							 ?>

							<tbody>

								 <?php
									if(!$posts) { ?>

										<tr>
											<td><?php die("Error: " . mysqli_error($conn)); ?></td>
										</tr>

								<?php	} ?>




								<?php 
									if(mysqli_num_rows($posts) != 0){
										while($postsRow = mysqli_fetch_array($posts)) {
								 ?>
										<tr>
											<td><?php echo isset($postsRow['title']) ? $postsRow['title'] : ''; ?></td>
											<td>
												<?php echo isset($postsRow['description']) ? mb_strimwidth($postsRow['description'], 0, 35, "...") : ''; ?>
											</td>
											<td>
												<?php echo isset($postsRow['post_date']) ? $postsRow['post_date'] : ''; ?>
											</td>
										</tr>
								<?php 
										}
									}  else {

								?> 

								<tr>
									<td colspan="3">No posts found!</td>
								</tr>

								<?php	
									}
									mysqli_close($conn);
								?>
								
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<!-- <script src="js/datatable/jquery.dataTables.min.js"></script> -->
		<!-- <script src="js/datatable/dataTables.bootstrap4.min.js"></script> -->
		<script>
			// $('#post_tbl').DataTable();
		</script>
	</body>
</html>
<?php } else {
	header('Location: login.php');
} ?>

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
					
					<div class="col-md-12">
						<form method="post" action="" enctype="multipart/form-data">
							<div class="form-group">
								<label>Post Title</label>
								<input type="text" name="title" placeholder="Enter post title" class="form-control">
							</div>
							<div class="form-group">
								<label>Post Description</label>
								<input type="text" name="description" placeholder="Enter post title" class="form-control">
							</div>
                            <div class="form-group">
								<label>Upload Post Image</label>
								<input type="file" name="post_image" placeholder="Enter post title" class="form-control">
							</div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-md">Add</button>
                            </div>
						</form>
					</div>
                    <?php
                        
                        // Example on Stored XSS attack 
						$conn = mysqli_connect("localhost", "root", "", "hacking_db");
						
						if(!$conn){
							die("connection error!");
						}

						// $post_title = mysqli_real_escape_string($conn, $_POST['title']);

						$post_title = isset($_POST['title']) ?  mysqli_real_escape_string($conn, $_POST['title']) : '';
						
						// $post_description = mysqli_real_escape_string($conn, $_POST['description']);

                        $post_description = isset($_POST['description']) ? mysqli_real_escape_string($conn, $_POST['description']) : '';

                        $post_temp_image_file = isset($_FILES['post_image']['tmp_name']) && !empty($_FILES['post_image']['tmp_name']) ? $_FILES['post_image']['tmp_name'] : '' ;

                        $post_image_original_name = isset($_FILES['post_image']['name']) ? $_FILES['post_image']['name'] : '';

                        $full_path = './uploads/' . $post_image_original_name;
                        if(move_uploaded_file($post_temp_image_file, $full_path)) {
							
							

							$insert_sql = "insert into `posts`(title,description,post_image) values('$post_title','$post_description', '$post_image_original_name')";

							mysqli_query($conn,$insert_sql);
							if(mysqli_affected_rows($conn) > 0){
								echo "Post Image uploaded successfully";
								header("Location: add_post.php");
							}

						}
						
                        // echo $full_path;die;

                        // print_r($_FILES['post_image']); die;

                    ?>
					<div class="col-md-12" style="margin-top:10px;">
						<table id="post_tbl" class="table table-hover table-bordered" style="width:100%">
							<thead>
								<tr>
									<th>Post Image</th>
                                    <th>Title</th>
								</tr>
							</thead>


							<?php 
								
			                    

								$posts_sql = "select * from `posts`";
								
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
											<td><img src="uploads/<?php echo $postsRow['post_image']; ?>" class="img-responsive" height="40px" width="40px" /></td>
											<td>
												<?php echo isset($postsRow['title']) ? mb_strimwidth($postsRow['title'], 0, 35, "...") : ''; ?>
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



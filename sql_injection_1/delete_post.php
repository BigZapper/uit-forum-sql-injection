<?php 
	
	$postId = $_GET['postid'];
	$conn = mysqli_connect("localhost", "root", "", "hacking_db");
 	if(!$conn){
    	die("connection error");
 	}

 	$delete_post_sql = "DELETE FROM `posts` WHERE id='$postId'";
	$res = mysqli_query($conn,$delete_post_sql);
	if($res){
		header("Location: posts.php");
	}
	else{
		echo "Error deleting post: " . mysqli_error($conn);
	}


 	mysqli_close($conn);

 ?>
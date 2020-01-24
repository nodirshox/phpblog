<?php
    require '../include/header.php';
    //Get the initial values
    if( isset($_GET['id']) ) {
        $id = $_GET['id'];
		$res = mysqli_query($conn, "SELECT * FROM comment WHERE id='$id'");
		$row = mysqli_fetch_array($res);
    }
    
    //Update databse
	if( isset($_POST['title']) ){
        $title = $_POST['title'];
        $id = $_POST['id'];
        $post_id = $_POST['post_id'];
		$sql = "DELETE FROM comment WHERE id='$id'";
		$res = mysqli_query($conn, $sql) or die("Could not update".mysql_error());
        echo "Deleted. <a href='post.php?id={$post_id}'> View the post</a>";
	}
    //Show the form only method GET
    if ($_SERVER['REQUEST_METHOD'] === 'GET') { ?>
        <h2>Delete</h2>
        Are you sure to delete this post?
        <form action="delete_comment.php" method="POST">
            <div>
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <input type="hidden" name="post_id" value="<?php echo $row['post_id']; ?>">
                <label>Comment</title><br />
                <input type="text" name="title" id ="title" placeholder="Amazing Title" autocomplete="off" value="<?php echo $row["body"]; ?>" readonly>
            </div>
            <input type="submit" value="DELETE">
        </form>
<?php
    }
    require '../include/footer.php';
?>
<?php
    require '../include/header.php';
    //Get the initial values
    if( isset($_GET['id']) ) {
        $id = $_GET['id'];
		$res = mysqli_query($conn, "SELECT id, title, body FROM post WHERE id='$id'");
		$row = mysqli_fetch_array($res);
    }
    
    //Update databse
	if( isset($_POST['title']) ){
        $title = $_POST['title'];
        $id = $_POST['id'];
        $delete_comments = "DELETE FROM comment WHERE post_id='$id'";
        $res = mysqli_query($conn, $delete_comments);
        $sql = "DELETE FROM post WHERE id='$id'";
		$res = mysqli_query($conn, $sql) or die("Could not update".mysql_error());
        echo "Deleted. <a href='../new.php'>Write new one :).</a>";
	}
    //Show the form only method GET
    if ($_SERVER['REQUEST_METHOD'] === 'GET') { 
        $title = mysqli_real_escape_string($conn, $row["title"]);
        $body = mysqli_real_escape_string($conn, $row["body"]);
        ?>
        <h2>Delete</h2>
        Are you sure to delete this post?
        <form action="delete.php" method="POST">
            <div>
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <label>Title</title><br />
                <input type="text" name="title" id ="title" placeholder="Amazing Title" autocomplete="off" value="<?php echo str_replace("\\", "", $title); ?>" readonly>
            </div>
            <div>
                <label>Body</label><br />
                <input type="text" name="body" id ="body" placeholder="Write Funny Post :)" autocomplete="off"  value ="<?php echo str_replace("\\", "", $body); ?>" readonly>
                </div>
            <input type="submit" value="DELETE">
        </form>
<?php
    }
    require '../include/footer.php';
?>
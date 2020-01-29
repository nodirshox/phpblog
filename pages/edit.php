<?php
    require '../include/header.php';
    //Update databse
	if( isset($_POST['title']) ){
        $id = $_POST['id'];
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $title = str_replace('"', "'", $title);
        $body = mysqli_real_escape_string($conn, $_POST['body']);
        $body = str_replace('"', "'", $body); 
		$sql = "UPDATE post SET title='$title', body='$body' WHERE id='$id'";
		$res = mysqli_query($conn, $sql) or die("Could not update".mysql_error());
        echo "Edited. <a href='../index.php'>View this post.</a>";
	}
    //Get the initial values
    if( isset($_GET['id']) ) {
        $id = $_GET['id'];
		$res = mysqli_query($conn, "SELECT * FROM post WHERE id='$id'");
		$row = mysqli_fetch_array($res);
    }

    //Show the form only method GET
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $title = mysqli_real_escape_string($conn, $row["title"]);
        $body = mysqli_real_escape_string($conn, $row["body"]);
        ?>
        <h2>Edit</h2>
        <form action="edit.php" method="POST">
            <div>
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>" >
                <label>Title</label><br />
                <input type="text" name="title" id ="title" placeholder="Amazing Title" autocomplete="off" value="<?php echo str_replace("\\", "", $title); ?>" required>
            </div>
            <div>
                <label>Body</label><br />
                <input type="text" name="body" id ="body" placeholder="Write Funny Post :)" autocomplete="off"  value ="<?php echo str_replace("\\", "", $body); ?>" required>
            </div>
            <input type="submit" value="SAVE">
        </form>
<?php
    }
    require '../include/footer.php';
?>
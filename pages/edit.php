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
        header( "Location: post.php?id={$id}" );
        exit;
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
        <!--Begin form -->
        <div class="container content">
            <div class="row">
                <div class="col">
                    <span class="heading-text">Edit</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <div class="container">
                        <form action="edit.php" method="POST">
                            <div class="row">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>" >
                                <input type="text" name="title" id="title" placeholder="Title" class="text-input" autocomplete="off" value="<?php echo str_replace("\\", "", $title); ?>" required>
                            </div>
                            <div class="row">
                                <textarea name="body" id="body" cols="40" rows="5" class="text-input" placeholder="Body" autocomplete="off" required><?php echo str_replace("\\", "", $body); ?></textarea>
                            </div>
                            <div class="row">
                                <input type="submit" value="SAVE" id="submit-form">
                            </div>
                        </form>
                    </div>
                </div>
                <?php include '../include/statistics.php'; ?>
            </div>
            <div class="row">
                <div class="col">
                    <div><span class="home"><a href="../index.php">Home</a></span></div>
                </div>
            </div>
        </div>
        <!-- End form -->
<?php
    }
    require '../include/footer.php';
?>
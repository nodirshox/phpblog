<?php
    require 'include/header.php';
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $title = str_replace('"', "'", $title);
        $body = mysqli_real_escape_string($conn, $_POST['body']);
        $body = str_replace('"', "'", $body); 
        //SQL
        $sql = "INSERT INTO post (title, body) VALUES ('$title', '$body')";
        //Insert
        if (mysqli_query($conn, $sql)) {
            echo "Posted. <a href='index.php'>View all posts.</a>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
    //Show the form only method GET
    if ($_SERVER['REQUEST_METHOD'] === 'GET') { ?>
        <h2>Write a new post</h2>
        <hr>
        <form action="new.php" method="POST">
            <div>
                <label>Title</title><br />
                <input type="text" name="title" id ="title" placeholder="Amazing Title" autocomplete="off" required>
            </div>
            <div>
                <label>Body</label><br />
                <input type="text" name="body" id ="body" placeholder="Write Funny Post :)" autocomplete="off" onkeydown="return event.key != 'Enter';" required>
            </div>
            <input type="submit" value="SUBMIT">
        </form>
<?php
    }
    require 'include/footer.php';
?>
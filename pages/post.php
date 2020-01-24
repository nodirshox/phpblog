<?php
    require '../include/header.php';
    //Show the body
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if( isset($_GET['id']) ) {
            $id = $_GET['id'];
            $res = mysqli_query($conn, "SELECT title, body, id, date FROM post WHERE id='$id'"); 
            $row = mysqli_fetch_array($res);

            $com = "SELECT * FROM comment WHERE post_id='$id' ORDER BY id DESC";
            $comments = $conn->query($com);
        }
        $timeStamp = $row['date'];
        $timeStamp = date( "m/d/Y", strtotime($timeStamp));
    }
    //Add comment
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $author = mysqli_real_escape_string($conn, $_POST['author']);
        $author = str_replace('"', "'", $author);
        $body = mysqli_real_escape_string($conn, $_POST['comment']);
        $body = str_replace('"', "'", $body);

        $post_id =  $_POST['post_id'];
        $sql = "INSERT INTO comment (author, body, post_id) VALUES ('$author', '$body', '$post_id')";
        //Insert
        if (mysqli_query($conn, $sql)) {
            echo "Commented. <a href='post.php?id={$post_id}'> View the post</a>";
            header('Refresh: 5; URL=post.php?id=<?php $post_id; ?>');
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
    //Show body if method GET
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
?>
    <b>Published date:</b><br />
    <?= $timeStamp; ?><br />
    <b>Title:</b><br />
    <?php echo $row["title"]; ?> <br />
    <b>Body:</b><br />
    <?php echo $row['body']; ?>
    <hr>
    <b>Comments:</b><br />
    <?php
        if ($comments->num_rows > 0) {
            // Output data of each post
            while($comm = $comments->fetch_assoc()) {
                ?>
                <p>
                    <b><?= $comm['author']; ?></b><br />
                    <?= $comm["body"]; ?> <u><a href="delete_comment.php?id=<?= $comm['id']; ?>">Delete</a></u></p>
                <hr>
                <?php
            }
        } else {
        echo "There is no comments.<br />";
        }
        $conn->close();
    ?>
    <b>Add comment:</b>
    <form action="post.php" method="POST">
        <input type="hidden" name="post_id" value="<?php echo $row['id']; ?>">
        Name:<br />
        <input type="text" name="author" id="author" placeholder="Your name, Please..." autocomplete="off" required><br />
        Comment:<br />
        <input type="text" name="comment" id="comment" placeholder="Ideas about post" autocomplete="off" required><br />
        <input type="submit" value="COMMENT">
    </form>

<?php
    }
    require '../include/footer.php';
?>
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
            header( "Location: post.php?id={$post_id}" );
            exit ;
            echo "Commented. <a href='post.php?id={$post_id}'> View the post</a>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
    //Show body if method GET
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    ?>
    <!-- Starting page -->
    <div class="container content">
      <div class="row">
        <div class="col">
          <div><span class="heading-text"><?php echo $row["title"]; ?></span></div>
          <div><span class="published-date">Published date: <?= $timeStamp; ?></span> <a href="edit.php?id=<?= $row['id']; ?>" class="action"><b>Edit</b></a> | <a href="delete.php?id=<?= $row['id']; ?>" class="action"><b>Delete</b></a></div>
          <div><span class="body-text"><?php echo $row['body']; ?></span></div>
        </div>
      </div>
      <div class="row">
          <div class="col-md-4">
              <hr>
              <div class="add-comment">Comments</div>
              <div>
              <?php
                if ($comments->num_rows > 0) {
                    // Output data of each post
                    while($comm = $comments->fetch_assoc()) {
                        ?>
                        <div class="comment">
                            <span class="comment-title"><?= $comm['author']; ?></span><br />
                            <span class="comment-body"><?= $comm["body"]; ?></span>
                            <a href="delete_comment.php?id=<?= $comm['id']; ?>"><img src="<?=$home; ?>/public/img/trash.png" alt="delete"></a>
                          </div>
                        <?php
                    }
                } else { echo "There is no comments.<br />"; }
        $conn->close();
        ?>
              </div>
          </div>
      </div>
      <div class="row">
        <div class="col-md-4">
            <div class="add-comment">Add comment</div>
              <div class="container">
                    <form action="post.php" method="POST">
                        <input type="hidden" name="post_id" value="<?php echo $row['id']; ?>">
                        <div class="row"><input type="text" name="author" id="author" placeholder="Name" class="text-input" autocomplete="off" required></div>
                        <div class="row"><textarea name="comment" id="comment" cols="40" rows="5" class="text-input" placeholder="Body" autocomplete="off" required></textarea></div>
                        <div class="row"><input type="submit" value="COMMENT" id="submit-form"></div>
                    </form>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div><span class="home"><a href="../index.php">Home</a></span></div>
            </div>
        </div>
      </div>
    <!-- Ending page -->
<?php
    }
    require '../include/footer.php';
?>
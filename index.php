<?php
    require 'include/header.php';
?>
    <h1>Welcome to My Blog by Nodirbek Ergashev</h1>
    <h2>Last posts</h2>
    <hr>
    <?php
        $sql = "SELECT * FROM post ORDER BY id DESC";
        $result = $conn->query($sql);
        $total = 0;
        if ($result->num_rows > 0) {
                // Output data of each post
                while($row = $result->fetch_assoc()) {
                    $total+=1;
                    $timeStamp = $row['date'];
                    $timeStamp = date( "m/d/Y", strtotime($timeStamp));
                    ?>
                    <h4><b><a href="pages/post.php?id=<?= $row['id']; ?>"><?= $row["title"]; ?></a></b> on <small><?= $timeStamp; ?></small></h4>
                    <p><?= $row["body"]; ?> <u><a href="pages/edit.php?id=<?= $row['id']; ?>">Edit</a></u> | <u><a href="pages/delete.php?id=<?= $row['id']; ?>">Delete</a></u></p>
                    <hr>
                <?php
                    }
        } else {
            echo "There is nothing to read. Write at least one post :)<br />";
        }
        $conn->close();
    ?>
    Total posts: <?php echo $total; ?><br>
    <a href="new.php">Write a post</a>
<?php
    require 'include/footer.php';
?>
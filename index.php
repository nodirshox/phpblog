<?php
    require 'include/header.php';
?>
    <h1>Welcome to My Blog by Nodirbek Ergashev</h1>
    <h2>Last posts</h2>
    <hr>
    <?php
        if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 2;
        $offset = ($pageno-1) * $no_of_records_per_page;

        $total_pages_sql = "SELECT COUNT(*) FROM post";
        $result = mysqli_query($conn,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);

        $sql = "SELECT * FROM post LIMIT $offset, $no_of_records_per_page";
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
    <ul class="pagination">
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
        </li>
    </ul><br />
    Total posts: <?php echo $total; ?><br>
    <a href="new.php">Write a post</a>
<?php
    require 'include/footer.php';
?>
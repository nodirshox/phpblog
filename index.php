<?php
    require 'include/header.php';
?>
    <div class="container content">
        <div class="row">
            <div class="col">
                <span class="heading-text">Welcome!</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10">
                <div class="container">
                    <div class="row">
                        <?php
                            if (isset($_GET['pageno'])) {
                                $pageno = $_GET['pageno'];
                            } else {
                                $pageno = 1;
                            }
                            $no_of_records_per_page = 6;
                            $offset = ($pageno-1) * $no_of_records_per_page;
                            $total_pages_sql = "SELECT COUNT(*) FROM post";
                            $result = mysqli_query($conn,$total_pages_sql);
                            $total_rows = mysqli_fetch_array($result)[0];
                            $total_pages = ceil($total_rows / $no_of_records_per_page);
                            $sql = "SELECT * FROM post ORDER BY id DESC LIMIT $offset, $no_of_records_per_page";
                            $result = $conn->query($sql);
                            $total_page = 0;
                            if ($result->num_rows > 0) {
                                // Output data of each post
                                while($row = $result->fetch_assoc()) {
                                    $total_page += 1;
                                    $timeStamp = $row['date'];
                                    $timeStamp = date( "m/d/Y", strtotime($timeStamp));
                                    //Starting one post
                                    ?>
                                        <div class="col-md post">
                                            <div class="row post-text"><?= $row["title"]; ?></div>
                                                <div class="row date-text">
                                                <div class="col">
                                                    <span class="view"><a href="pages/post.php?id=<?= $row['id']; ?>">VIEW</a></span>
                                                </div><?= $timeStamp; ?>
                                            </div>
                                        </div>
                                    <?php 
                                    //Ending one post
                                    if($total_page==3) { ?>
                                            <div class="w-100"></div>
                                    <?php
                                    }
                                } ?>
                                </div>
                                <div class="row">
                                    <div class="col pagination">
                                        <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>"><span class="newer">NEWER</span></a>
                                        <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>"><span class="older">OLDER</span></a>
                                    </div>
                                </div>
                                <?php } else {
                                echo "</div><span class='home'>There is nothing to read. Write at least one post :)</span><br />";
                            }
                            $conn->close();
                        ?>
                </div>
            </div>
            <?php include 'include/statistics.php'; ?>
            </div>
        </div>
    </div>
<?php
    require 'include/footer.php';
?>
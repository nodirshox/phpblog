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
            header( "Location: index.php" );
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
    //Show the form only method GET
    if ($_SERVER['REQUEST_METHOD'] === 'GET') { ?>
        <div class="container content">
            <div class="row">
                <div class="col">
                    <span class="heading-text">Write a post!</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <div class="container">
                        <form action="new.php" method="POST">
                            <div class="row">
                                <input type="text" name="title" id="title" placeholder="Title" class="text-input" autocomplete="off" required>
                            </div>
                            <div class="row">
                                <textarea name="body" id="body" cols="40" rows="5" class="text-input" placeholder="Body" autocomplete="off"></textarea>
                            </div>
                            <div class="row">
                                <input type="submit" value="POST" id="submit-form">
                            </div>
                        </form>
                    </div>
                </div>
                <?php include 'include/statistics.php'; ?>
                </div>
                <div class="row">
                    <div class="col">
                        <div><span class="home"><a href="index.php">Home</a></span></div>
                    </div>
                </div>
        </div>
<?php
    }
    require 'include/footer.php';
?>
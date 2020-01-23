<?php
    require '../include/header.php';
    if( isset($_GET['id']) ) {
        $id = $_GET['id'];
		$res = mysqli_query($conn, "SELECT title, body, date FROM post WHERE id='$id'");
		$row = mysqli_fetch_array($res);
    }
    $timeStamp = $row['date'];
    $timeStamp = date( "m/d/Y", strtotime($timeStamp));
?>
    <b>Published date:</b><br />
    <?= $timeStamp; ?><br />
    <b>Title:</b><br />
    <?php echo $row["title"]; ?> <br />
    <b>Body:</b><br />
    <?php echo $row['body']; ?>

<?php
    require '../include/footer.php';
?>
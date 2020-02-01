<?php
    require '../include/header.php';

    //Get the initial values
    if( isset($_GET['id']) ){
        $id = $_GET['id'];
		$res = mysqli_query($conn, "SELECT * FROM comment WHERE id='$id'");
		$row = mysqli_fetch_array($res);
    }
        
    //Show the form only method GET
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $id = $_GET['id'];
        $sql = "DELETE FROM comment WHERE id='$id'";
        $res = mysqli_query($conn, $sql) or die("Could not update".mysql_error());
        $my_id = $row['post_id'];
        header( "Location: post.php?id={$my_id}" );
        exit;
    }
    require '../include/footer.php';
?>
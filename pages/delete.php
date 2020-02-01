<?php
    require '../include/header.php';
    //Get the initial values
    if( isset($_GET['id']) ) {
        $id = $_GET['id'];
		$res = mysqli_query($conn, "SELECT id, title, body FROM post WHERE id='$id'");
		$row = mysqli_fetch_array($res);
    }
    
    //Show the form only method GET
    if ($_SERVER['REQUEST_METHOD'] === 'GET') { 
        $id = $_GET['id'];
        $delete_comments = "DELETE FROM comment WHERE post_id='$id'";
        $res = mysqli_query($conn, $delete_comments);
        $sql = "DELETE FROM post WHERE id='$id'";
        $res = mysqli_query($conn, $sql) or die("Could not update".mysql_error());
        header( "Location: ../index.php" );
        exit;
    }
    require '../include/footer.php';
?>
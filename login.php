<?php require "includes/header.php"; ?>
<?php require "config.php"; ?>


<?php 

    if(isset($_SESSION['username'])) {
        header("location: index.php");
    }

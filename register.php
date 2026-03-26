<?php require "includes/header.php"; ?>

<?php require "config.php"; ?>

<?php 



    if(isset($_SESSION['username'])) {
      header("location: index.php");
    }

    if(isset($_POST['submit'])) {

      if($_POST['email'] == '' OR $_POST['username'] == '' OR $_POST['password'] == '') {
        echo "some inputs are empty";
        echo "some inputs are empty";
        
      } else {


        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];


































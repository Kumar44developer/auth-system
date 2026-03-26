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
        $insert = $conn->prepare("INSERT INTO users (email, username, mypassword) 
         VALUES (:email, :username, :mypassword)");


         $insert->execute([
          ':email' => $email,
          ':username' => $username,
          ':mypassword' => password_hash($password, PASSWORD_DEFAULT),
         ]);

      }
    }

?>
<main class="form-signin w-50 m-auto">
  <form method="POST" action="register.php">
    <!-- <img class="mb-4 text-center" src="/docs/5.2/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> -->
    <h1 class="h3 mt-5 fw-normal text-center">Please Register</h1>



























<?php require "includes/header.php"; ?>
<?php require "config.php"; ?>


<?php 

    if(isset($_SESSION['username'])) {
        header("location: index.php");
    }

    if(isset($_POST['submit'])) {
      if($_POST['email'] == '' OR $_POST['password'] == '') {
        echo "some inputs are empty";
      } else {

        $email = $_POST['email'];
        $password = $_POST['password'];

        $login = $conn->query("SELECT * FROM users WHERE email = '$email'");


        $login->execute();

        $data = $login->fetch(PDO::FETCH_ASSOC);

        if($login->rowCount() > 0) {
          
            if(password_verify($password, $data['mypassword'])) {














































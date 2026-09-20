<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

require "config.php";

$error = "";
$email = "";
$username = "";

if (isset($_POST['submit'])) {
    $email = trim($_POST['email'] ?? "");
    $username = trim($_POST['username'] ?? "");
    $password = $_POST['password'] ?? "";

    if (empty($email) || empty($username) || empty($password)) {
        $error = "Please fill in all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";
    } elseif (strlen($password) < 4) {
        $error = "Password must be at least 4 characters long.";
    } else {
        $checkEmail = $conn->prepare("SELECT id FROM users WHERE email = :email");
        $checkEmail->execute([':email' => $email]);

        if ($checkEmail->rowCount() > 0) {
            $error = "An account with this email already exists.";
        } else {
            $insert = $conn->prepare("INSERT INTO users (email, username, mypassword) VALUES (:email, :username, :mypassword)");
            $success = $insert->execute([
                ':email' => $email,
                ':username' => $username,
                ':mypassword' => password_hash($password, PASSWORD_DEFAULT),
            ]);

            if ($success) {
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                header("Location: index.php");
                exit();
            } else {
                $error = "Registration failed. Please try again.";
            }
        }
    }
}

require "includes/header.php";
?>

<main class="form-auth">
  <form method="POST" action="register.php">
    <div class="text-center mb-4">
      <i class="bi bi-person-plus-fill display-4 text-primary"></i>
      <h1 class="h3 mt-2 fw-bold">Create Account</h1>
      <p class="text-muted">Join AuthSys by creating a free account</p>
    </div>

    <?php if (!empty($error)) : ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i><?php echo htmlspecialchars($error); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>

    <div class="form-floating mb-3">
      <input name="email" type="email" class="form-control" id="floatingEmail" placeholder="name@example.com" value="<?php echo htmlspecialchars($email); ?>" required>
      <label for="floatingEmail">Email address</label>
    </div>

    <div class="form-floating mb-3">
      <input name="username" type="text" class="form-control" id="floatingUsername" placeholder="username" value="<?php echo htmlspecialchars($username); ?>" required>
      <label for="floatingUsername">Username</label>
    </div>

    <div class="form-floating mb-3">
      <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password" required>
      <label for="floatingPassword">Password</label>
    </div>

    <button name="submit" class="w-100 btn btn-lg btn-primary mb-3" type="submit">Create Account</button>
    
    <div class="text-center text-muted">
      Already have an account? <a href="login.php" class="text-decoration-none fw-semibold">Sign In</a>
    </div>
  </form>
</main>

<?php require "includes/footer.php"; ?>

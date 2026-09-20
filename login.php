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

if (isset($_POST['submit'])) {
    $email = trim($_POST['email'] ?? "");
    $password = $_POST['password'] ?? "";

    if (empty($email) || empty($password)) {
        $error = "Please fill in all fields.";
    } else {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['mypassword'])) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid email or password.";
        }
    }
}

require "includes/header.php";
?>

<main class="form-auth">
  <form method="POST" action="login.php">
    <div class="text-center mb-4">
      <i class="bi bi-box-arrow-in-right display-4 text-primary"></i>
      <h1 class="h3 mt-2 fw-bold">Sign In</h1>
      <p class="text-muted">Enter your credentials to access your account</p>
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
      <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password" required>
      <label for="floatingPassword">Password</label>
    </div>

    <button name="submit" class="w-100 btn btn-lg btn-primary mb-3" type="submit">Sign In</button>
    
    <div class="text-center text-muted">
      Don't have an account? <a href="register.php" class="text-decoration-none fw-semibold">Create an account</a>
    </div>
  </form>
</main>

<?php require "includes/footer.php"; ?>

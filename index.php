<?php require "includes/header.php"; ?>

<?php if (isset($_SESSION['username'])) : ?>
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 mb-4 bg-white">
        <div class="d-flex align-items-center mb-4">
          <div class="bg-primary text-white rounded-circle p-3 d-flex align-items-center justify-content-center me-3" style="width: 64px; height: 64px;">
            <i class="bi bi-person-fill fs-2"></i>
          </div>
          <div>
            <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 rounded-pill mb-1">Authenticated</span>
            <h1 class="h2 fw-bold mb-0">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
          </div>
        </div>
        
        <p class="text-muted lead">You are securely signed in to the application. Your session is active and protected.</p>
        
        <hr class="my-4">

        <div class="row g-3 mb-4">
          <div class="col-md-6">
            <div class="p-3 bg-light rounded-3 border">
              <div class="text-muted small">Username</div>
              <div class="fw-bold fs-5 text-dark"><?php echo htmlspecialchars($_SESSION['username']); ?></div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="p-3 bg-light rounded-3 border">
              <div class="text-muted small">Email Address</div>
              <div class="fw-bold fs-5 text-dark"><?php echo htmlspecialchars($_SESSION['email'] ?? 'Not set'); ?></div>
            </div>
          </div>
        </div>

        <div class="d-flex gap-2">
          <a href="logout.php" class="btn btn-outline-danger">
            <i class="bi bi-box-arrow-right me-2"></i>Sign Out
          </a>
        </div>
      </div>
    </div>
  </div>
<?php else : ?>
  <div class="px-4 py-5 my-3 text-center">
    <div class="d-inline-flex p-3 bg-primary bg-opacity-10 text-primary rounded-circle mb-3">
      <i class="bi bi-shield-check display-4"></i>
    </div>
    <h1 class="display-5 fw-bold text-dark">Secure PHP Authentication System</h1>
    <div class="col-lg-7 mx-auto">
      <p class="lead text-muted mb-4">
        A production-grade, lightweight authentication starter featuring MySQL PDO connectivity, modern Bcrypt password hashing, prepared statement protection, and responsive Bootstrap 5 UI.
      </p>
      <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
        <a href="register.php" class="btn btn-primary btn-lg px-4 gap-3">
          <i class="bi bi-person-plus-fill me-2"></i>Get Started Free
        </a>
        <a href="login.php" class="btn btn-outline-secondary btn-lg px-4">
          <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
        </a>
      </div>
    </div>
  </div>

  <div class="row g-4 py-4 row-cols-1 row-cols-lg-3">
    <div class="col">
      <div class="card h-100 border-0 shadow-sm rounded-3 p-4 bg-white">
        <div class="text-primary fs-2 mb-3">
          <i class="bi bi-key-fill"></i>
        </div>
        <h4 class="fw-bold">Bcrypt Password Hashing</h4>
        <p class="text-muted">Passwords are cryptographically secured using PHP's native password_hash algorithm with adaptive salt derivation.</p>
      </div>
    </div>
    <div class="col">
      <div class="card h-100 border-0 shadow-sm rounded-3 p-4 bg-white">
        <div class="text-primary fs-2 mb-3">
          <i class="bi bi-shield-lock"></i>
        </div>
        <h4 class="fw-bold">Prepared SQL Queries</h4>
        <p class="text-muted">Built with PDO prepared statements and parameter binding to protect entirely against SQL injection vulnerabilities.</p>
      </div>
    </div>
    <div class="col">
      <div class="card h-100 border-0 shadow-sm rounded-3 p-4 bg-white">
        <div class="text-primary fs-2 mb-3">
          <i class="bi bi-bootstrap-fill"></i>
        </div>
        <h4 class="fw-bold">Modern Bootstrap 5</h4>
        <p class="text-muted">Clean responsive design featuring mobile-first grids, floating labels, toast/alert feedback, and dropdown menus.</p>
      </div>
    </div>
  </div>
<?php endif; ?>

<?php require "includes/footer.php"; ?>

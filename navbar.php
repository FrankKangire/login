<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="index.php">
        <span style="color: #27ae60;">Jungle</span>Professor
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navRes">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navRes">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="welcome.php">Dashboard</a></li>
        <!-- NEW LINK -->
        <li class="nav-item"><a class="nav-link" href="view_history.php">Game History</a></li>
      </ul>
      <div class="d-flex align-items-center">
        <?php if(isset($_SESSION['user_id'])): ?>
            <span class="text-light me-3">Hi, <b><?php echo $_SESSION['username']; ?></b></span>
            <a class="btn btn-sm btn-outline-info me-2" href="server.php">Game Center</a>
            <a class="btn btn-sm btn-danger" href="logout.php">Logout</a>
        <?php else: ?>
            <a class="btn btn-sm btn-outline-success me-2" href="login.php">Login</a>
            <a class="btn btn-sm btn-primary" href="signup.php">SignUp</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>
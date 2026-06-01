<?php
session_start();
require_once 'koneksi.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username && $password) {
        // --- DI-BYPASS AGAR MUDAH MASUK ---
        // Anda bisa login langsung menggunakan username: admin dan password: admin
        if ($username === 'admin' && $password === 'admin') {
            $_SESSION['admin_id']   = 1;
            $_SESSION['admin_nama'] = 'Administrator Desa';
            $_SESSION['admin_role'] = 'admin';
            header('Location: dashboard-admin.php');
            exit;
        } else {
            $error = 'Username atau password salah! (Gunakan username: admin & password: admin)';
        }
    } else {
        $error = 'Mohon isi username dan password.';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login | Admin Desa</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    body { background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); min-height: 100vh; }
    .login-box { margin-top: 10vh; margin-left: auto; margin-right: auto; }
    .login-logo a { color: #fff; font-size: 1.8rem; font-weight: 700; }
    .login-logo small { display: block; font-size: 0.9rem; font-weight: 300; opacity: .8; }
    .card { border-radius: 12px; box-shadow: 0 10px 40px rgba(0,0,0,.3); }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><i class="fas fa-landmark mr-2"></i>Admin Desa<small>Sistem Informasi Administrasi</small></a>
  </div>
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg text-muted">Masuk ke akun Anda (Bypass Mode)</p>
      <?php if ($error): ?>
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <i class="fas fa-exclamation-circle mr-1"></i><?= htmlspecialchars($error) ?>
        </div>
      <?php endif; ?>
      <form method="POST">
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username (Isi: admin)" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" required autofocus>
          <div class="input-group-append"><div class="input-group-text"><i class="fas fa-user"></i></div></div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password (Isi: admin)" required>
          <div class="input-group-append"><div class="input-group-text"><i class="fas fa-lock"></i></div></div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">
              <i class="fas fa-sign-in-alt mr-1"></i> Masuk
            </button>
          </div>
        </div>
      </form>
      <p class="mt-3 mb-0 text-center text-muted" style="font-size:.8rem;">
        &copy; <?= date('Y') ?> Sistem Informasi Admin Desa
      </p>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
// header.php - Include di setiap halaman
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. Proteksi login menggunakan JavaScript agar tidak memicu "headers already sent"
if (!isset($_SESSION['admin_id'])) {
    echo "<script>window.location.href='/admin-desa/login.php';</script>";
    exit;
}

$adminNama = $_SESSION['admin_nama'] ?? 'Admin';
$adminRole = $_SESSION['admin_role'] ?? 'operator';

// 2. Mengunci base path ke root folder local project Anda
$base = '/admin-desa/';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $pageTitle ?? 'Admin Desa' ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <ul class="navbar-nav">
    <li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a></li>
  </ul>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#"><i class="fas fa-user-circle mr-1"></i><?= htmlspecialchars($adminNama) ?></a>
      <div class="dropdown-menu dropdown-menu-right">
        <a href="<?= $base ?>pengaturan/pengguna.php" class="dropdown-item"><i class="fas fa-user mr-2"></i>Profil</a>
        <div class="dropdown-divider"></div>
        <a href="<?= $base ?>logout.php" class="dropdown-item"><i class="fas fa-sign-out-alt mr-2"></i>Keluar</a>
      </div>
    </li>
  </ul>
</nav>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="<?= $base ?>dashboard-admin.php" class="brand-link">
    <i class="fas fa-landmark ml-3 mr-2" style="font-size:1.5rem;opacity:.8"></i>
    <span class="brand-text font-weight-light">Admin Desa</span>
  </a>
  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="<?= $base ?>dashboard-admin.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'dashboard-admin.php' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item has-treeview <?= strpos($_SERVER['PHP_SELF'], '/penduduk/') !== false ? 'menu-open' : '' ?>">
          <a href="#" class="nav-link <?= strpos($_SERVER['PHP_SELF'], '/penduduk/') !== false ? 'active' : '' ?>">
            <i class="nav-icon fas fa-users"></i><p>Data Penduduk<i class="fas fa-angle-left right"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item"><a href="<?= $base ?>penduduk/daftar.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) === 'daftar.php' && strpos($_SERVER['PHP_SELF'],'/penduduk/') !== false ? 'active':'' ?>"><i class="far fa-circle nav-icon"></i><p>Daftar Penduduk</p></a></li>
            <li class="nav-item"><a href="<?= $base ?>penduduk/tambah.php" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Tambah Penduduk</p></a></li>
            <li class="nav-item"><a href="<?= $base ?>penduduk/kk.php" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Kartu Keluarga</p></a></li>
          </ul>
        </li>
        <li class="nav-item has-treeview <?= strpos($_SERVER['PHP_SELF'], '/surat/') !== false ? 'menu-open' : '' ?>">
          <a href="#" class="nav-link <?= strpos($_SERVER['PHP_SELF'], '/surat/') !== false ? 'active' : '' ?>">
            <i class="nav-icon fas fa-file-alt"></i><p>Surat & Administrasi<i class="fas fa-angle-left right"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item"><a href="<?= $base ?>surat/permohonan.php" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Permohonan Surat</p></a></li>
            <li class="nav-item"><a href="<?= $base ?>surat/arsip.php" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Arsip Surat</p></a></li>
          </ul>
        </li>
        <li class="nav-item has-treeview <?= strpos($_SERVER['PHP_SELF'], '/keuangan/') !== false ? 'menu-open' : '' ?>">
          <a href="#" class="nav-link <?= strpos($_SERVER['PHP_SELF'], '/keuangan/') !== false ? 'active' : '' ?>">
            <i class="nav-icon fas fa-wallet"></i><p>Keuangan Desa<i class="fas fa-angle-left right"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item"><a href="<?= $base ?>keuangan/pendapatan.php" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Pendapatan</p></a></li>
            <li class="nav-item"><a href="<?= $base ?>keuangan/pengeluaran.php" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Pengeluaran</p></a></li>
            <li class="nav-item"><a href="<?= $base ?>keuangan/apbdes.php" class="nav-link"><i class="far fa-circle nav-icon"></i><p>APBDes</p></a></li>
          </ul>
        </li>
        <li class="nav-item has-treeview <?= strpos($_SERVER['PHP_SELF'], '/pembangunan/') !== false ? 'menu-open' : '' ?>">
          <a href="#" class="nav-link <?= strpos($_SERVER['PHP_SELF'], '/pembangunan/') !== false ? 'active' : '' ?>">
            <i class="nav-icon fas fa-hard-hat"></i><p>Pembangunan<i class="fas fa-angle-left right"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item"><a href="<?= $base ?>pembangunan/proyek.php" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Data Proyek</p></a></li>
            <li class="nav-item"><a href="<?= $base ?>pembangunan/aset-desa.php" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Aset Desa</p></a></li>
          </ul>
        </li>
        <li class="nav-item has-treeview <?= strpos($_SERVER['PHP_SELF'], '/laporan/') !== false ? 'menu-open' : '' ?>">
          <a href="#" class="nav-link <?= strpos($_SERVER['PHP_SELF'], '/laporan/') !== false ? 'active' : '' ?>">
            <i class="nav-icon fas fa-chart-bar"></i><p>Laporan<i class="fas fa-angle-left right"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item"><a href="<?= $base ?>laporan/penduduk.php" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Lap. Penduduk</p></a></li>
            <li class="nav-item"><a href="<?= $base ?>laporan/keuangan.php" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Lap. Keuangan</p></a></li>
          </ul>
        </li>
        <li class="nav-item has-treeview <?= strpos($_SERVER['PHP_SELF'], '/pengaturan/') !== false ? 'menu-open' : '' ?>">
          <a href="#" class="nav-link <?= strpos($_SERVER['PHP_SELF'], '/pengaturan/') !== false ? 'active' : '' ?>">
            <i class="nav-icon fas fa-cog"></i><p>Pengaturan<i class="fas fa-angle-left right"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item"><a href="<?= $base ?>pengaturan/profil-desa.php" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Profil Desa</p></a></li>
            <li class="nav-item"><a href="<?= $base ?>pengaturan/pengguna.php" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Kelola Pengguna</p></a></li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</aside>
<div class="content-wrapper">
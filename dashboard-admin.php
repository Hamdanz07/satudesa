<?php
$pageTitle = 'Dashboard | Admin Desa';
require_once 'koneksi.php';
require_once 'header.php';

// Ambil statistik dari database
$totalPenduduk  = $pdo->query("SELECT COUNT(*) FROM penduduk WHERE status_hidup='Hidup'")->fetchColumn();
$totalKK        = $pdo->query("SELECT COUNT(*) FROM kartu_keluarga")->fetchColumn();
$suratBulanIni  = $pdo->query("SELECT COUNT(*) FROM surat WHERE MONTH(tanggal)=MONTH(CURDATE()) AND YEAR(tanggal)=YEAR(CURDATE())")->fetchColumn();
$totalPendapatan= $pdo->query("SELECT COALESCE(SUM(jumlah),0) FROM keuangan WHERE jenis='Pendapatan'")->fetchColumn();
$totalPengeluaran=$pdo->query("SELECT COALESCE(SUM(jumlah),0) FROM keuangan WHERE jenis='Pengeluaran'")->fetchColumn();
$sisaAnggaran   = $totalPendapatan - $totalPengeluaran;
?>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><h1 class="m-0">Dashboard</h1></div>
        <div class="col-sm-6"><ol class="breadcrumb float-sm-right"><li class="breadcrumb-item active">Beranda</li></ol></div>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="container-fluid">

      <!-- Statistik -->
      <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box shadow-sm">
            <span class="info-box-icon bg-primary"><i class="fas fa-users"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Total Penduduk</span>
              <span class="info-box-number"><?= number_format($totalPenduduk) ?></span>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box shadow-sm">
            <span class="info-box-icon bg-success"><i class="fas fa-home"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Kartu Keluarga</span>
              <span class="info-box-number"><?= number_format($totalKK) ?></span>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box shadow-sm">
            <span class="info-box-icon bg-warning"><i class="fas fa-file-alt"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Surat Bulan Ini</span>
              <span class="info-box-number"><?= number_format($suratBulanIni) ?></span>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box shadow-sm">
            <span class="info-box-icon <?= $sisaAnggaran >= 0 ? 'bg-info' : 'bg-danger' ?>"><i class="fas fa-wallet"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Sisa Anggaran</span>
              <span class="info-box-number" style="font-size:1rem;">Rp <?= number_format($sisaAnggaran,0,',','.') ?></span>
            </div>
          </div>
        </div>
      </div>

      <!-- Welcome & Akses Cepat -->
      <div class="row">
        <div class="col-md-8">
          <div class="card card-primary card-outline">
            <div class="card-header"><h3 class="card-title"><i class="fas fa-landmark mr-2"></i>Selamat Datang, <?= htmlspecialchars($_SESSION['admin_nama']) ?>!</h3></div>
            <div class="card-body">
              <p class="text-muted">Ini adalah Sistem Informasi Administrasi Desa. Gunakan menu di sebelah kiri untuk mengelola data penduduk, surat, keuangan, dan pembangunan desa.</p>
              <hr>
              <h6>Akses Cepat</h6>
              <div class="row">
                <div class="col-6 col-md-4 mb-2"><a href="penduduk/tambah.php" class="btn btn-block btn-outline-primary btn-sm py-2"><i class="fas fa-user-plus d-block mb-1"></i>Tambah Penduduk</a></div>
                <div class="col-6 col-md-4 mb-2"><a href="surat/permohonan.php" class="btn btn-block btn-outline-success btn-sm py-2"><i class="fas fa-file-signature d-block mb-1"></i>Buat Surat</a></div>
                <div class="col-6 col-md-4 mb-2"><a href="keuangan/pendapatan.php" class="btn btn-block btn-outline-warning btn-sm py-2"><i class="fas fa-plus-circle d-block mb-1"></i>Catat Keuangan</a></div>
                <div class="col-6 col-md-4 mb-2"><a href="pembangunan/proyek.php" class="btn btn-block btn-outline-info btn-sm py-2"><i class="fas fa-hard-hat d-block mb-1"></i>Data Proyek</a></div>
                <div class="col-6 col-md-4 mb-2"><a href="laporan/penduduk.php" class="btn btn-block btn-outline-secondary btn-sm py-2"><i class="fas fa-chart-bar d-block mb-1"></i>Lihat Laporan</a></div>
                <div class="col-6 col-md-4 mb-2"><a href="pengaturan/profil-desa.php" class="btn btn-block btn-outline-dark btn-sm py-2"><i class="fas fa-cog d-block mb-1"></i>Pengaturan</a></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-header"><h3 class="card-title"><i class="fas fa-history mr-1"></i>Surat Terbaru</h3></div>
            <div class="card-body p-0">
              <ul class="list-group list-group-flush">
              <?php
              $suratTerbaru = $pdo->query("SELECT * FROM surat ORDER BY created_at DESC LIMIT 5")->fetchAll();
              if ($suratTerbaru):
                foreach ($suratTerbaru as $s):
                  $badge = ['Diajukan'=>'warning','Diproses'=>'info','Selesai'=>'success','Ditolak'=>'danger'][$s['status']] ?? 'secondary';
              ?>
                <li class="list-group-item d-flex justify-content-between align-items-center py-2 px-3" style="font-size:.85rem;">
                  <span><?= htmlspecialchars($s['nama_pemohon']) ?><br><small class="text-muted"><?= htmlspecialchars($s['jenis_surat']) ?></small></span>
                  <span class="badge badge-<?= $badge ?>"><?= $s['status'] ?></span>
                </li>
              <?php endforeach; else: ?>
                <li class="list-group-item text-muted text-center py-3">Belum ada data surat</li>
              <?php endif; ?>
              </ul>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
<?php require_once 'footer.php'; ?>

===================================================
  SISTEM INFORMASI ADMINISTRASI DESA
  Cara Instalasi di Laragon
===================================================

LANGKAH 1 - SALIN FOLDER
  - Extract zip ini
  - Salin folder "admin-desa" ke:
    C:\laragon\www\admin-desa

LANGKAH 2 - BUAT DATABASE
  - Buka Laragon → klik "Database" atau buka browser ke:
    http://localhost/phpmyadmin
  - Klik "New" di sebelah kiri
  - Nama database: admin_desa
  - Klik "Create"
  - Setelah database dibuat, klik tab "Import"
  - Pilih file "admin_desa.sql" dari folder ini
  - Klik "Go" untuk import

LANGKAH 3 - KONFIGURASI KONEKSI
  - Buka file "koneksi.php"
  - Sesuaikan jika perlu:
      $db   = 'admin_desa';   // nama database
      $user = 'root';          // user default Laragon
      $pass = '';              // password default kosong

LANGKAH 4 - AKSES APLIKASI
  - Pastikan Laragon sudah running (Apache + MySQL hijau)
  - Buka browser ke:
    http://localhost/admin-desa/login.php

LANGKAH 5 - LOGIN
  Username : admin
  Password : password
  ⚠ Segera ganti password setelah login pertama!

===================================================
  STRUKTUR FOLDER
===================================================
admin-desa/
├── login.php              ← Halaman login
├── logout.php             ← Logout
├── dashboard-admin.php    ← Dashboard utama
├── koneksi.php            ← Konfigurasi database
├── header.php             ← Template header & sidebar
├── footer.php             ← Template footer & script
├── admin_desa.sql         ← File database (import ini!)
├── penduduk/
│   ├── daftar.php         ← Daftar penduduk + cari + hapus
│   ├── tambah.php         ← Form tambah penduduk
│   ├── kk.php             ← Data kartu keluarga
│   └── kk-simpan.php      ← Proses simpan KK
├── surat/
│   ├── permohonan.php     ← Form pengajuan surat
│   └── arsip.php          ← Arsip & update status surat
├── keuangan/
│   ├── pendapatan.php     ← Catat & lihat pendapatan
│   ├── pengeluaran.php    ← Catat & lihat pengeluaran
│   └── apbdes.php         ← Rekap APBDes
├── pembangunan/
│   ├── proyek.php         ← Data proyek pembangunan
│   └── aset-desa.php      ← Inventaris aset desa
├── laporan/
│   ├── penduduk.php       ← Statistik penduduk
│   └── keuangan.php       ← Rekap keuangan bulanan
└── pengaturan/
    ├── profil-desa.php    ← Profil desa
    └── pengguna.php       ← Kelola akun pengguna

===================================================

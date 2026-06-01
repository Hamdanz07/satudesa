-- ============================================================
-- DATABASE: admin_desa
-- Cara pakai: Buat database 'admin_desa' di phpMyAdmin,
--             lalu import file ini.
-- ============================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+07:00";

-- --------------------------------------------------------
-- Tabel: penduduk
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `penduduk` (
  `id`            INT(11) NOT NULL AUTO_INCREMENT,
  `nik`           VARCHAR(16)  NOT NULL UNIQUE,
  `nama`          VARCHAR(100) NOT NULL,
  `tempat_lahir`  VARCHAR(60)  NOT NULL,
  `tanggal_lahir` DATE         NOT NULL,
  `jenis_kelamin` ENUM('L','P') NOT NULL,
  `agama`         VARCHAR(20)  NOT NULL,
  `status_kawin`  ENUM('Belum Kawin','Kawin','Cerai Hidup','Cerai Mati') NOT NULL DEFAULT 'Belum Kawin',
  `pekerjaan`     VARCHAR(60)  DEFAULT NULL,
  `alamat`        TEXT         NOT NULL,
  `no_kk`         VARCHAR(16)  DEFAULT NULL,
  `status_hidup`  ENUM('Hidup','Meninggal','Pindah') NOT NULL DEFAULT 'Hidup',
  `created_at`    TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Tabel: kartu_keluarga
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `kartu_keluarga` (
  `id`         INT(11)     NOT NULL AUTO_INCREMENT,
  `no_kk`      VARCHAR(16) NOT NULL UNIQUE,
  `kepala_kk`  VARCHAR(100) NOT NULL,
  `alamat`     TEXT        NOT NULL,
  `rt`         VARCHAR(5)  DEFAULT NULL,
  `rw`         VARCHAR(5)  DEFAULT NULL,
  `created_at` TIMESTAMP   NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Tabel: surat
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `surat` (
  `id`           INT(11)      NOT NULL AUTO_INCREMENT,
  `no_surat`     VARCHAR(50)  NOT NULL,
  `jenis_surat`  VARCHAR(60)  NOT NULL,
  `nama_pemohon` VARCHAR(100) NOT NULL,
  `nik_pemohon`  VARCHAR(16)  DEFAULT NULL,
  `keperluan`    TEXT         DEFAULT NULL,
  `status`       ENUM('Diajukan','Diproses','Selesai','Ditolak') NOT NULL DEFAULT 'Diajukan',
  `tanggal`      DATE         NOT NULL,
  `created_at`   TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Tabel: keuangan
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `keuangan` (
  `id`          INT(11)        NOT NULL AUTO_INCREMENT,
  `jenis`       ENUM('Pendapatan','Pengeluaran') NOT NULL,
  `kategori`    VARCHAR(60)    NOT NULL,
  `keterangan`  TEXT           DEFAULT NULL,
  `jumlah`      DECIMAL(15,2)  NOT NULL,
  `tanggal`     DATE           NOT NULL,
  `created_at`  TIMESTAMP      NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Tabel: pembangunan
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `pembangunan` (
  `id`           INT(11)       NOT NULL AUTO_INCREMENT,
  `nama_proyek`  VARCHAR(150)  NOT NULL,
  `lokasi`       VARCHAR(150)  DEFAULT NULL,
  `anggaran`     DECIMAL(15,2) NOT NULL,
  `realisasi`    DECIMAL(15,2) NOT NULL DEFAULT 0,
  `progress`     TINYINT(3)    NOT NULL DEFAULT 0 COMMENT 'persentase 0-100',
  `status`       ENUM('Perencanaan','Berjalan','Selesai','Ditangguhkan') NOT NULL DEFAULT 'Perencanaan',
  `mulai`        DATE          DEFAULT NULL,
  `selesai`      DATE          DEFAULT NULL,
  `created_at`   TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Tabel: aset_desa
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `aset_desa` (
  `id`           INT(11)       NOT NULL AUTO_INCREMENT,
  `nama_aset`    VARCHAR(150)  NOT NULL,
  `jenis`        VARCHAR(60)   NOT NULL,
  `lokasi`       VARCHAR(150)  DEFAULT NULL,
  `nilai`        DECIMAL(15,2) DEFAULT NULL,
  `kondisi`      ENUM('Baik','Rusak Ringan','Rusak Berat') NOT NULL DEFAULT 'Baik',
  `created_at`   TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Tabel: pengguna (login admin)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `pengguna` (
  `id`         INT(11)      NOT NULL AUTO_INCREMENT,
  `nama`       VARCHAR(100) NOT NULL,
  `username`   VARCHAR(50)  NOT NULL UNIQUE,
  `password`   VARCHAR(255) NOT NULL,
  `role`       ENUM('superadmin','admin','operator') NOT NULL DEFAULT 'operator',
  `created_at` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Data awal: akun admin default
-- password: admin123  (di-hash dengan password_hash)
-- --------------------------------------------------------
INSERT INTO `pengguna` (`nama`, `username`, `password`, `role`) VALUES
('Super Admin', 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'superadmin');
-- ⚠ password default: "password" — segera ganti setelah login!

-- --------------------------------------------------------
-- Data contoh penduduk
-- --------------------------------------------------------
INSERT INTO `penduduk` (`nik`,`nama`,`tempat_lahir`,`tanggal_lahir`,`jenis_kelamin`,`agama`,`status_kawin`,`pekerjaan`,`alamat`,`no_kk`) VALUES
('3312010101900001','Budi Santoso','Tegal','1990-01-01','L','Islam','Kawin','Petani','Jl. Merdeka No. 1 RT 01/RW 01','3312010101900001'),
('3312010101950002','Siti Rahayu','Tegal','1995-05-15','P','Islam','Kawin','Ibu Rumah Tangga','Jl. Merdeka No. 1 RT 01/RW 01','3312010101900001'),
('3312010101980003','Ahmad Fauzi','Tegal','1998-08-20','L','Islam','Belum Kawin','Pelajar','Jl. Melati No. 5 RT 02/RW 01','3312010101980003');

-- --------------------------------------------------------
-- Data contoh keuangan
-- --------------------------------------------------------
INSERT INTO `keuangan` (`jenis`,`kategori`,`keterangan`,`jumlah`,`tanggal`) VALUES
('Pendapatan','Dana Desa','Transfer Dana Desa Tahap 1 2025','150000000.00','2025-01-10'),
('Pendapatan','PAD','Retribusi pasar desa Januari','2500000.00','2025-01-31'),
('Pengeluaran','Operasional','Pengadaan ATK kantor desa','1200000.00','2025-01-15'),
('Pengeluaran','Pembangunan','Pengaspalan jalan RT 03','45000000.00','2025-02-01');

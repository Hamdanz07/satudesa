<?php
// koneksi.php
$host = 'localhost';
$db   = 'admin_desa'; // <--- PASTIKAN SUDAH SAMA SEPERTI INI
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die('<div style="font-family:sans-serif;padding:20px;background:#f8d7da;color:#721c24;border:1px solid #f5c6cb;border-radius:5px;">
        <strong>Koneksi Database Gagal!</strong><br>
        Pastikan: <ul>
          <li>Laragon sudah dijalankan (Apache + MySQL hidup)</li>
          <li>Database <code><strong>' . $db . '</strong></code> sudah dibuat di phpMyAdmin</li>
          <li>Import file <code>admin_desa.sql</code> ke database tersebut</li>
        </ul>
        Error: ' . $e->getMessage() . '
    </div>');
}

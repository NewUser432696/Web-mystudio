<?php
session_start();
include 'koneksi.php';

// Proteksi halaman admin
if(!isset($_SESSION['admin_id'])){
    header("Location: login_admin.php");
    exit;
}

// Query JOIN untuk mengambil nama user dari tabel user
// Berdasarkan gambar image_8d7da0.png, kolom di tabel review adalah id_user
$query = "SELECT review.*, user.nama 
          FROM review 
          JOIN user ON review.id_user = user.id_user 
          ORDER BY review.id_review DESC";

$data = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Review - Admin</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            background: #f4f6f9;
        }

        .sidebar {
            width: 220px;
            background: #111;
            color: white;
            height: 100vh;
            padding: 20px;
            position: fixed;
            left: 0;
            top: 0;
        }

        .sidebar h2 { text-align: center; margin-bottom: 30px; }

        .sidebar a {
            display: block;
            color: white;
            padding: 12px;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 5px;
        }

        .sidebar a:hover { background: red; }

        .content {
            margin-left: 240px;
            padding: 40px;
            width: 100%;
        }

        h2 { margin-bottom: 20px; color: #333; }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        th {
            background: #333;
            color: white;
            padding: 15px;
            text-transform: uppercase;
            font-size: 14px;
        }

        td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #eee;
            color: #555;
        }

        .btn-hapus {
            background: #e74c3c;
            color: white;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 12px;
        }

        .btn-hapus:hover { background: #c0392b; }

        .stars { color: #f1c40f; font-size: 18px; }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>Admin</h2>
    <a href="admin.php">Dashboard</a>
    <a href="paket.php">Paket Foto</a>
    <a href="tambah_galeri.php">Galeri</a>
    <a href="booking_admin.php">Booking</a>
    <a href="review_admin.php">Review</a>
    <a href="logout.php">Logout</a>
</div>

<div class="content">
    <h2>Data Review User</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Rating</th>
                <th>Komentar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            if(mysqli_num_rows($data) > 0) {
                while($d = mysqli_fetch_array($data)){ 
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><strong><?= htmlspecialchars($d['nama']); ?></strong></td>
                <td class="stars"><?= str_repeat("★", $d['rating']); ?></td>
                <td>"<?= htmlspecialchars($d['komentar']); ?>"</td>
                <td>
                    <!-- Link hapus (buat file hapus_review.php nantinya) -->
                    <a href="hapus_review.php?id=<?= $d['id_review']; ?>" 
                       class="btn-hapus" 
                       onclick="return confirm('Hapus review ini?')">Hapus</a>
                </td>
            </tr>
            <?php 
                } 
            } else {
                echo "<tr><td colspan='5'>Belum ada review.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>

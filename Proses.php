<?php
session_start();
include __DIR__ . '/koneksi.php';

if (isset($_POST['booking'])) {

    if (!isset($_SESSION['user_id'])) {
        die("Harus login dulu!");
    }

    $id_user  = $_SESSION['user_id'];
    $id_paket = $_POST['id_paket'];
    $tanggal  = $_POST['tanggal'];
    $jam      = $_POST['jam'];

    $p = mysqli_fetch_array(mysqli_query(
        $conn,
        "SELECT * FROM paket_foto WHERE id_paket='$id_paket'"
    ));

    if (!$p) {
        die("Paket tidak ditemukan");
    }

    $total = $p['harga'];

    mysqli_query($conn, "INSERT INTO bookings
    (id_user,id_paket,tanggal,jam,total_harga,status)
    VALUES ('$id_user','$id_paket','$tanggal','$jam','$total','pending')");

    echo " Booking berhasil";
}
if (isset($_POST['tambah_paket'])) {
    $nama_paket = $_POST['nama_paket'];
    $harga = $_POST['harga'];

    // Pastikan nama kolom di database adalah 'harga'
    mysqli_query($conn, "INSERT INTO paket (nama_paket, harga) VALUES ('$nama_paket', '$harga')");

    header("Location: paket.php");
}

if (isset($_GET['id']) && isset($_GET['status'])) {

    $id     = $_GET['id'];
    $status = $_GET['status'];

    mysqli_query($conn, "UPDATE bookings 
    SET status='$status' 
    WHERE id_booking='$id'");

    header("Location: admin.php");
    exit;
}

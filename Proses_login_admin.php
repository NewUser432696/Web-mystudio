<?php
session_start();
include 'koneksi.php';

if(isset($_POST['login'])){

    $user = $_POST['username'];
    $pass = $_POST['password'];

    $cek = mysqli_query($conn,
    "SELECT * FROM admin WHERE username='$user' AND password='$pass'");

    if(mysqli_num_rows($cek) > 0){

        $data = mysqli_fetch_array($cek);

        $_SESSION['admin_id'] = $data['id_admin'];
        $_SESSION['admin_nama'] = $data['nama'];

        header("Location: admin.php");
        exit;

    } else {
        echo " Login admin gagal";
    }
}

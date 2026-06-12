<?php
include 'koneksi.php';

function kembali($pesan){
    echo "
    <html>
    <head>
    <title>Error</title>
    <style>
        body {
            font-family: Arial;
            background: #f5f5f5;
            text-align: center;
            padding-top: 100px;
        }
        .box {
            background: white;
            padding: 30px;
            display: inline-block;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: black;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn:hover {
            background: red;
        }
    </style>
    </head>
    <body>

    <div class='box'>
        <h3>$pesan</h3>
        <a href='tambah_galeri.php' class='btn'>← Kembali</a>
    </div>

    </body>
    </html>
    ";
    exit;
}

if(isset($_POST['upload'])){

    $judul = htmlspecialchars($_POST['judul']);

    if(isset($_FILES['foto']) && $_FILES['foto']['error'] == 0){

        $nama_file = $_FILES['foto']['name'];
        $tmp       = $_FILES['foto']['tmp_name'];
        $size      = $_FILES['foto']['size'];

        $ext = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png'];

        if(!in_array($ext, $allowed)){
            kembali(" Format harus JPG / PNG");
        }

        if($size > 2000000){
            kembali(" Ukuran terlalu besar (max 2MB)");
        }

        $nama_baru = uniqid() . '.' . $ext;

        if(!is_dir("upload")){
            mkdir("upload");
        }


if(move_uploaded_file($tmp, "upload/".$nama_baru)){


    $id_paket = $_POST['id_paket']; 

   
    $query = mysqli_query($conn, "INSERT INTO galeri (id_paket, file_foto, judul_foto) 
    VALUES ('$id_paket', '$nama_baru', '$judul')");

    if($query){
        header("Location: tambah_galeri.php");
        exit;
    } else {

        kembali("Gagal simpan ke database: " . mysqli_error($conn));
    }

}


    } else {
        kembali(" Pilih file dulu");
    }

} else {
    kembali(" Akses tidak valid");
}

<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login_user.php");
    exit();
}

if (!isset($_GET['id'])) {
    die("ID booking tidak ditemukan");
}

$id_booking = $_GET['id'];

$query = mysqli_query($conn,"
SELECT booking.*, paket_foto.nama_paket, paket_foto.harga
FROM booking
JOIN paket_foto ON booking.id_paket = paket_foto.id_paket
WHERE booking.id='$id_booking'
");

$data = mysqli_fetch_assoc($query);

if (!$data) {
    die("Data booking tidak ditemukan");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pembayaran</title>
</head>
<body>

<h2>Pembayaran Booking</h2>

<p>Paket: <?php echo $data['nama_paket']; ?></p>
<p>Tanggal: <?php echo $data['tanggal']; ?></p>
<p>Jam: <?php echo $data['jam']; ?></p>
<p>Total: Rp <?php echo number_format($data['harga']); ?></p>

<?php if($data['status'] == 'lunas'){ ?>

    <h3 style="color:green;">✓ Sudah Dibayar</h3>

    <?php if($data['bukti_bayar']){ ?>
        <img src="upload/<?php echo $data['bukti_bayar']; ?>" width="200">
    <?php } ?>

<?php } else { ?>

<form action="proses_pembayaran.php" method="POST" enctype="multipart/form-data">

    <input type="hidden" name="id_booking" value="<?php echo $data['id']; ?>">

    <label>Metode Pembayaran</label>
    <select name="metode_bayar" required>
        <option value="">Pilih Metode</option>
        <option value="Transfer Bank">Transfer Bank</option>
        <option value="E-Wallet">E-Wallet</option>
        <option value="Cash">Cash</option>
    </select>

    <br><br>

    <label>Upload Bukti</label>
    <input type="file" name="bukti" required>

    <br><br>

    <button type="submit" name="bayar">
        Bayar Sekarang
    </button>

</form>

<?php } ?>

</body>
</html>

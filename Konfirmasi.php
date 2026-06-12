<?php
include 'koneksi.php';

if (!isset($_GET['id']) || !isset($_GET['status'])) {
    die("Parameter tidak lengkap!");
}

$id = $_GET['id'];
$status = $_GET['status'];

$allowed_status = ['pending', 'lunas'];

if (!in_array($status, $allowed_status)) {
    die("Status tidak valid!");
}

$query = mysqli_query($conn, "
    UPDATE booking
    SET status='$status'
    WHERE id_booking='$id'
");

if (!$query) {
    die("Query error: " . mysqli_error($conn));
}

echo "
<script>
alert('Status berhasil diubah!');
window.location='booking_admin.php';
</script>
";
?>

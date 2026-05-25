<?php
include '../koneksi.php';

$id = $_GET['id'];

// hapus data
mysqli_query($koneksi, "DELETE FROM transaksi WHERE id_transaksi='$id'");

header("Location: transaksi.php");
?>
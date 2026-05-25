<?php
session_start();
if ($_SESSION['status'] != "login") {
    header("Location: ../index.php?pesan=belum_login");
    exit();
}

include '../koneksi.php';

$id = $_GET['id'] ?? '';

if ($id != '') {

    mysqli_query($koneksi, "DELETE FROM paket WHERE id_paket='$id'");
}

header("Location: paket.php?pesan=hapus");
exit();
?>
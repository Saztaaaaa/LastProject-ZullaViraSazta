<?php
include '../koneksi.php';

$id = $_GET['id'];

$id = intval($id);

mysqli_query($koneksi, "DELETE FROM absen WHERE id_absen='$id'");

header("Location: absen.php");
exit();
?>
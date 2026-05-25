<?php
session_start();

if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: ../index.php?pesan=belum_login");
    exit();
}

include '../koneksi.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: member.php?pesan=gagal");
    exit();
}

$id = $_GET['id'];

$id = mysqli_real_escape_string($koneksi, $id);

$cek = mysqli_query($koneksi, "SELECT * FROM member WHERE id_member='$id'");

if (mysqli_num_rows($cek) == 0) {
    header("Location: member.php?pesan=tidak_ada");
    exit();
}

mysqli_query($koneksi, "DELETE FROM absen WHERE id_member='$id'");

$hapus = mysqli_query($koneksi, "DELETE FROM member WHERE id_member='$id'");

if ($hapus) {
    header("Location: member.php?pesan=hapus_berhasil");
} else {
    header("Location: member.php?pesan=hapus_gagal");
}
?>
<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = md5($_POST['password']);

$data = mysqli_query($koneksi,
    "SELECT * FROM login WHERE username='$username' AND password='$password'"
);

$cek = mysqli_num_rows($data);

if ($cek > 0) {

    $user = mysqli_fetch_assoc($data);

    $_SESSION['user_id'] = $user['id_user'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['status'] = "login";

    header("Location: admin/index.php");
    exit();

} else {
    header("Location: index.php?pesan=gagal");
}
?>
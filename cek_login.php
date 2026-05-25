<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = md5($_POST['password']);

$data = mysqli_query($koneksi,
    "SELECT * FROM user WHERE username='$username' AND password='$password'"
);

$cek = mysqli_num_rows($data);

if ($cek > 0) {

    $user = mysqli_fetch_assoc($data);

    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['user_status'] = $user['user_status'];
    $_SESSION['status'] = "login";

    if ($user['user_status'] == 1) {
        header("Location: admin/index.php");
        exit();
    } 
    else if ($user['user_status'] == 2) {
        header("Location: user/index.php");
        exit();
    } 
    else {
        header("Location: index.php?pesan=unknown_role");
        exit();
    }

} else {
    header("Location: index.php?pesan=gagal");
}
?>
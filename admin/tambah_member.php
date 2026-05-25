<?php
session_start();

date_default_timezone_set('Asia/Jakarta');

if ($_SESSION['status'] != "login") {
    header("Location: ../index.php?pesan=belum_login");
    exit();
}

include '../koneksi.php';

if(isset($_POST['simpan'])){

    $nama   = $_POST['nama'];
    $nik    = $_POST['nik'];
    $alamat = $_POST['alamat'];
    $no_hp  = $_POST['no_hp'];
    $paket  = $_POST['paket'];
    $tgl    = $_POST['tanggal'];

    mysqli_query($koneksi,"INSERT INTO member 
    (nama, nik, alamat, no_hp, paket, tgl_daftar, status) 
    VALUES 
    ('$nama','$nik','$alamat','$no_hp','$paket','$tgl','aktif')");

    header("Location: member.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Tambah Member</title>

<!-- FONT AWESOME -->
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    background:#111;
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
    font-family:sans-serif;
}

/* IPHONE */
.phone{
    width:390px;
    height:760px;
    background:#eaeaea;
    border-radius:40px;
    box-shadow:0 0 40px rgba(0,0,0,0.6);
    padding:60px 15px 15px;
    position:relative;
}

/* NOTCH */
.phone::before{
    content:'';
    width:120px;
    height:25px;
    background:black;
    border-radius:20px;
    position:absolute;
    top:20px;
    left:50%;
    transform:translateX(-50%);
}

/* SCREEN */
.screen{
    width:100%;
    height:100%;
    background:#f4f6f9;
    border-radius:30px;
    overflow-y:auto;
    padding-bottom:100px;
}

/* HEADER */
.header{
    background:linear-gradient(135deg,#4a6cf7,#6f8cff);
    color:white;
    padding:18px;
    margin:10px 15px;
    border-radius:20px;
    display:flex;
    align-items:center;
    gap:12px;
}

/* BACK */
.back{
    color:white;
    text-decoration:none;
    font-size:20px;
}

/* FORM */
.form-box{
    margin:15px;
}

label{
    font-size:14px;
    font-weight:bold;
    margin-bottom:5px;
    display:block;
}

.input{
    width:100%;
    padding:12px;
    border:none;
    border-radius:10px;
    background:#eaeaea;
    margin-bottom:12px;
    font-size:14px;
}

/* TEXTAREA */
textarea.input{
    resize:none;
    height:90px;
}

/* ROW */
.row{
    display:flex;
    gap:10px;
}

.row .col{
    flex:1;
}

/* BUTTON */
.btn{
    width:100%;
    padding:14px;
    border:none;
    border-radius:12px;
    font-weight:bold;
    margin-top:10px;
    cursor:pointer;
    font-size:14px;
}

.btn-save{
    background:#4a6cf7;
    color:white;
}

.btn-cancel{
    background:#ddd;
    color:#333;
}

</style>
</head>

<body>

<div class="phone">
<div class="screen">

<!-- HEADER -->
<div class="header">

    <!-- BACK -->
    <a href="member.php" class="back">
        <i class="fa-solid fa-arrow-left"></i>
    </a>

    <!-- TITLE -->
    <h3>Tambah Member</h3>

</div>

<!-- FORM -->
<div class="form-box">

<form method="post">

<label>Nama</label>
<input type="text"
name="nama"
class="input"
placeholder="Masukkan nama lengkap"
required>

<label>NIK</label>
<input type="text"
name="nik"
class="input"
placeholder="Masukkan NIK (16 digit)">

<label>Alamat</label>
<textarea
name="alamat"
class="input"
placeholder="Masukkan alamat lengkap"></textarea>

<label>No HP</label>
<input type="text"
name="no_hp"
class="input"
placeholder="Masukkan nomor HP"
required>

<div class="row">

    <div class="col">

        <label>Paket Aktif</label>

        <select name="paket" class="input">

            <option value="Harian">Harian</option>

            <option value="Bulanan">Bulanan</option>

            <option value="Tahunan">Tahunan</option>

        </select>

    </div>

    <div class="col">

        <label>Bergabung</label>

        <input type="date"
        name="tanggal"
        class="input"
        required>

    </div>

</div>

<button type="submit"
name="simpan"
class="btn btn-save">

    Simpan

</button>

<button type="button"
onclick="history.back()"
class="btn btn-cancel">

    Batal

</button>

</form>

</div>

</div>
</div>

</body>
</html>
<?php
session_start();

if ($_SESSION['status'] != "login") {
    header("Location: ../index.php?pesan=belum_login");
    exit();
}

include '../koneksi.php';

$id = $_GET['id'] ?? '';

$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM paket WHERE id_paket='$id'"));

if (!$data) {
    echo "Data tidak ditemukan!";
    exit();
}

// PROSES UPDATE
if(isset($_POST['update'])){

    $nama   = $_POST['nama'];
    $harga  = $_POST['harga'];
    $durasi = $_POST['durasi'];

    mysqli_query($koneksi, "UPDATE paket SET 
        nama_paket='$nama',
        harga='$harga',
        durasi='$durasi'
        WHERE id_paket='$id'
    ");

    header("Location: paket.php?pesan=update");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Paket</title>

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

.phone{
    width:390px;
    height:760px;
    background:#eaeaea;
    border-radius:40px;
    box-shadow:0 0 40px rgba(0,0,0,0.6);
    padding:60px 15px 15px;
    position:relative;
}


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


.screen{
    width:100%;
    height:100%;
    background:#f4f6f9;
    border-radius:30px;
    overflow-y:auto;
    padding-bottom:20px;
}


.header{
    background:linear-gradient(135deg,#4a6cf7,#6f8cff);
    color:white;
    padding:18px;
    border-radius:20px;
    margin:10px 15px 20px;
    display:flex;
    align-items:center;
    gap:10px;
}

.back{
    text-decoration:none;
    color:white;
    font-size:20px;
}


.container-box{
    padding:0 15px;
}

.label{
    font-weight:bold;
    margin-bottom:5px;
    display:block;
    font-size:13px;
}

.input{
    width:100%;
    padding:12px;
    border-radius:12px;
    border:none;
    margin-bottom:15px;
    background:#eee;
    font-size:13px;
}


.btn-update{
    width:100%;
    padding:14px;
    border:none;
    border-radius:20px;
    background:#4a6cf7;
    color:white;
    font-size:15px;
    margin-top:10px;
    cursor:pointer;
}

.btn-kembali{
    width:100%;
    padding:12px;
    border:none;
    border-radius:15px;
    background:#ddd;
    margin-top:10px;
    text-align:center;
    display:block;
    text-decoration:none;
    color:black;
}

</style>
</head>

<body>

<div class="phone">
<div class="screen">

<!-- HEADER -->
<div class="header">
    <a href="paket.php" class="back">←</a>
    <h5>Edit Paket</h5>
</div>

<div class="container-box">

<form method="POST">

<label class="label">Nama Paket</label>
<input type="text"
name="nama"
class="input"
value="<?= $data['nama_paket']; ?>"
required>

<label class="label">Harga</label>
<input type="number"
name="harga"
class="input"
value="<?= $data['harga']; ?>"
required>

<label class="label">Durasi</label>

<select name="durasi" class="input" required>

    <option value="Harian"
    <?= ($data['durasi']=='Harian') ? 'selected' : ''; ?>>
    1 Bulan
    </option>

    <option value="Bulanan"
    <?= ($data['durasi']=='Bulanan') ? 'selected' : ''; ?>>
    2 Bulan
    </option>

    <option value="Tahunan"
    <?= ($data['durasi']=='Tahunan') ? 'selected' : ''; ?>>
    3 Bulan
    </option>

</select>

<button type="submit" name="update" class="btn-update">
    Update
</button>

<a href="paket.php" class="btn-kembali">
    Kembali
</a>

</form>

</div>

</div>
</div>

</body>
</html>
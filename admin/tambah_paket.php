<?php
include '../koneksi.php';

if (isset($_POST['simpan'])) {
    $nama   = $_POST['nama_paket'];
    $harga  = $_POST['harga'];
    $durasi = $_POST['durasi'];

    $query = mysqli_query($koneksi, "INSERT INTO paket (nama_paket, harga, durasi) 
                                    VALUES ('$nama', '$harga', '$durasi')");

    if ($query) {
        echo "<script>alert('Data berhasil ditambahkan!'); window.location='paket.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Tambah Paket</title>

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
    padding-bottom:20px;
}

/* HEADER */
.header{
    background:linear-gradient(135deg,#4a6cf7,#6f8cff);
    color:white;
    padding:18px;
    border-radius:20px;
    margin:10px 15px 20px;
    display:flex;
    align-items:center;
    gap:12px;
}

/* BACK */
.back{
    text-decoration:none;
    color:white;
    font-size:20px;
}

/* CONTAINER */
.container-box{
    padding:0 15px;
}

/* LABEL */
.label{
    font-weight:bold;
    margin-bottom:5px;
    display:block;
    font-size:13px;
}

/* INPUT */
.input{
    width:100%;
    padding:12px;
    border-radius:12px;
    border:none;
    margin-bottom:15px;
    background:#eee;
    font-size:13px;
}

/* BUTTON */
.btn-simpan{
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

.btn-batal{
    width:100%;
    padding:12px;
    border:none;
    border-radius:15px;
    background:#ddd;
    margin-top:10px;
    cursor:pointer;
}

</style>
</head>

<body>

<div class="phone">
<div class="screen">

<!-- HEADER -->
<div class="header">

    <!-- TANDA BACK -->
    <a href="paket.php" class="back">
        <i class="fa-solid fa-arrow-left"></i>
    </a>

    <!-- JUDUL -->
    <h3>Tambah Paket</h3>

</div>

<!-- FORM -->
<div class="container-box">

<form method="POST">

<label class="label">Nama Paket</label>
<input type="text" 
name="nama_paket" 
class="input" 
placeholder="Masukkan paket..." 
required>

<label class="label">Harga</label>
<input type="number" 
name="harga" 
class="input" 
placeholder="Masukkan harga..." 
required>

<label class="label">Durasi</label>

<select name="durasi" class="input" required>

    <option value="">-- Pilih Durasi --</option>

    <option value="1 Bulan">1 Bulan</option>

    <option value="2 Bulan">2 Bulan</option>

    <option value="3 Bulan">3 Bulan</option>

    <option value="1 Tahun">1 Tahun</option>

    <option value="2 Tahun">tempe tahu</option>

</select>

<button type="submit" 
name="simpan" 
class="btn-simpan">

    Simpan

</button>

<a href="paket.php">

<button type="button" class="btn-batal">

    Batal

</button>

</a>

</form>

</div>

</div>
</div>

</body>
</html>
<?php
session_start();
if ($_SESSION['status'] != "login") {
    header("Location: ../index.php?pesan=belum_login");
    exit();
}

include '../koneksi.php';

$data = mysqli_query($koneksi,"
    SELECT t.*, m.nama, m.no_hp 
    FROM transaksi t
    JOIN member m ON t.id_member = m.id_member
") or die(mysqli_error($koneksi));
?>
<!DOCTYPE html>
<html>
<head>
<title>Transaksi</title>
<link rel="stylesheet" href="../assets/css/bootstrap.css">

<style>
*{margin:0;padding:0;box-sizing:border-box;}
body{
    background:#111; display:flex; justify-content:center;
    align-items:center; min-height:100vh; font-family:sans-serif;
}
.phone{
    width:390px;height:760px;background:#eaeaea;border-radius:40px;
    box-shadow:0 0 40px rgba(0,0,0,0.6);
    padding:60px 15px 15px; position:relative;
}
.phone::before{
    content:''; width:120px;height:25px;background:black;
    border-radius:20px; position:absolute; top:20px;
    left:50%; transform:translateX(-50%);
}
.screen{
    width:100%; height:100%; background:#f4f6f9;
    border-radius:30px; overflow-y:auto; padding-bottom:90px;
}
.header{
    background:linear-gradient(135deg,#4a6cf7,#6f8cff);
    color:white; padding:20px; border-radius:20px;
    margin:10px 15px 15px;
}

.header-top{
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.tambah{
    background:white;
    color:#4a6cf7;
    padding:6px 12px;
    border-radius:10px;
    text-decoration:none;
    font-size:12px;
}


.bottom-nav{
    position:absolute;
    bottom:15px;
    left:15px;
    right:15px;

    background:white;
    display:flex;
    justify-content:space-around;
    padding:12px 0;

    border-radius:20px;
    box-shadow:0 10px 20px rgba(0,0,0,0.15);
}
.nav-item{ text-align:center; 
font-size:12px; 
color:#777; 
text-decoration:none; 

}

.nav-item div{
    font-size:20px;
}

.nav-item.active{
    color:#4a6cf7;
    font-weight:bold;
}

</style>
</head>

<body>
<div class="phone">
<div class="screen">

<div class="header">
    <div class="header-top">
        <h5>Kelola Paket</h5>
        <a href="tambah_transaksi.php" class="tambah">+ transaksi</a>
    </div>
     <p>Check-in member gym</p>
</div>

<?php while($m = mysqli_fetch_assoc($data)){ ?>
<div style="
    background:white; margin:0 15px 12px; padding:12px;
    border-radius:15px; display:flex;
    justify-content:space-between; align-items:center;
    box-shadow:0 3px 10px rgba(0,0,0,0.05);
">

<div>
    <b><?= $m['nama']; ?></b><br>
    <small><?= $m['no_hp']; ?></small><br>
    <small>Rp <?= number_format($m['total'],0,',','.'); ?></small>
</div>

<div style="display:flex; gap:8px;">

    <div style="
        background:#c6f6d5;
        color:#2f855a;
        padding:5px 12px;
        border-radius:10px;
        font-size:12px;">
        Sukses
    </div>

    <a href="hapus_transaksi.php?id=<?= $m['id_transaksi']; ?>" 
       onclick="return confirm('Yakin hapus transaksi ini?')"
       style="
        background:#feb2b2;
        color:#c53030;
        padding:5px 12px;
        border-radius:10px;
        font-size:12px;
        text-decoration:none;">
        Hapus
    </a>

</div>

</div>
<?php } ?>

<div class="bottom-nav">
    <a href="index.php" class="nav-item">
        <div>🏠</div>
        Home
    </a>
    <a href="member.php" class="nav-item">
        <div>👤</div>
        Member
    </a>
    <a href="paket.php" class="nav-item">
        <div>📦</div>
        Paket
    </a>
    <a href="transaksi.php" class="nav-item active">
        <div>📝</div>
        Transaksi
    </a>
    <a href="absen.php" class="nav-item">
        <div>✅</div>
        Absen
    </a>
</div>

</div>
</div>
</body>
</html>
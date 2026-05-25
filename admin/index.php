<?php
session_start();

if ($_SESSION['status'] != "login") {
    header("Location: ../index.php?pesan=belum_login");
    exit();
}

include '../koneksi.php';

$q1 = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM member");
$data_member = mysqli_fetch_assoc($q1);


$q2 = mysqli_query($koneksi, "SELECT COUNT(*) as aktif FROM member WHERE status='aktif'");
$data_aktif = mysqli_fetch_assoc($q2);


$q3 = mysqli_query($koneksi, "
    SELECT SUM(total) as total 
    FROM transaksi
") or die(mysqli_error($koneksi));

$data_transaksi = mysqli_fetch_assoc($q3);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard GYMFIT</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">

<style>

* { margin:0; padding:0; box-sizing:border-box; }


body {
    background:#111;
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
    font-family:sans-serif;
}


.phone {
    width:390px;
    height:760px;
    background:#eaeaea;
    border-radius:40px;
    box-shadow:0 0 40px rgba(0,0,0,0.6);
    padding:15px;
    padding-top:50px;
    position:relative;
}


.phone::before {
    content:'';
    width:120px;
    height:25px;
    background:black;
    border-radius:20px;
    position:absolute;
    top:10px;
    left:50%;
    transform:translateX(-50%);
    z-index:10;
}

/* SCREEN */
.screen {
    width:100%;
    height:100%;
    background:#f4f6f9;
    border-radius:30px;
    overflow:visible;
    padding-bottom:80px;
}


.header {
    background:linear-gradient(135deg,#4a6cf7,#6f8cff);
    color:white;
    padding:35px 20px 20px;
    border-radius:20px;
    margin:20px 15px 20px;
}


.card-box { margin:20px 15px 20px; }

.grid-card {
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:20px;
}

.card-info {
    box-shadow:0 10px 20px rgba(0,0,0,0.15);
    background:linear-gradient(135deg,#4a6cf7,#6f8cff);
    color:white;
    border-radius:20px;
    padding:25px;
    min-height:130px;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
}

.card-info.full { grid-column:span 2; }

.card-info h5 {
    font-size:14px;
    opacity:0.9;
}

.card-info p {
    font-size:20px;
    font-weight:bold;
}

/* NAVBAR (SUDAH DISAMAKAN) */
.bottom-nav {
    position: absolute;
    bottom: 15px;
    left: 15px;
    right: 15px;

    background: white;
    display: flex;
    justify-content: space-around;
    padding: 12px 0;

    border-radius: 20px;
    box-shadow: 0 10px 20px rgba(0,0,0,0.15);
    z-index: 10;
}

.nav-item {
    text-align: center;
    font-size: 12px;
    color: #777;
    text-decoration: none;
}

.nav-item div {
    font-size: 20px;
}

.nav-item.active {
    color: #4a6cf7;
    font-weight: bold;
}
</style>
</head>

<body>

<div class="phone">
<div class="screen">


<div class="header">

    <b style="font-size:24px;">
        Hi, <?php echo $_SESSION['username']; ?> 👋
    </b>

    <p>Welcome to GYMFIT</p>

</div>


<div class="card-box">
<div class="grid-card">

<div class="card-info">
    <h5>Total Member</h5>
    <p><?php echo $data_member['total'] ?? 0; ?> Orang</p>
</div>

<div class="card-info">
    <h5>Member Aktif</h5>
    <p><?php echo $data_aktif['aktif'] ?? 0; ?> Orang</p>
</div>

<div class="card-info full">
    <h5>Transaksi</h5>
    <p>Rp <?php echo number_format($data_transaksi['total'] ?? 0,0,',','.'); ?></p>
</div>

</div>
</div>

<!-- NAVBAR -->
<div class="bottom-nav">
    <a href="index.php" class="nav-item active">
        <div>🏠</div>
        <small>Home</small>
    </a>

    <a href="member.php" class="nav-item">
        <div>👤</div>
        <small>Member</small>
    </a>

    <a href="paket.php" class="nav-item">
        <div>📦</div>
        <small>Paket</small>
    </a>

    <a href="transaksi.php" class="nav-item">
        <div>📝</div>
        <small>Transaksi</small>
    </a>

    <a href="absen.php" class="nav-item">
        <div>✅</div>
        <small>Absen</small>
    </a>
</div>

</div>
</div>

</body>
</html>
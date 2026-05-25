<?php
session_start();
if ($_SESSION['status'] != "login") {
    header("Location: ../index.php?pesan=belum_login");
    exit();
}

include '../koneksi.php';
$data = mysqli_query($koneksi, "SELECT * FROM member");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Member</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">

<style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}


body {
    background: #111;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    font-family: sans-serif;
}

.phone {
    width: 390px;
    height: 760px;
    background: #eaeaea;
    border-radius: 40px;
    box-shadow: 0 0 40px rgba(0,0,0,0.6);
    padding: 60px 15px 15px;
    position: relative;
}

.phone::before {
    content: '';
    width: 120px;
    height: 25px;
    background: black;
    border-radius: 20px;
    position: absolute;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
}


.screen {
    width: 100%;
    height: 100%;
    background: #f4f6f9;
    border-radius: 30px;
    overflow-y: auto;
    padding-bottom: 90px;
}


.header {
    background: linear-gradient(135deg, #4a6cf7, #6f8cff);
    color: white;
    padding: 20px;
    border-radius: 20px;
    margin: 10px 15px 15px;
}

.header-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
}


.container-box {
    padding: 0 15px;
}


.member-card {
    background: #f1f3f5;
    border-radius: 15px;
    padding: 12px 15px;
    margin-bottom: 12px;

    display: flex;
    justify-content: space-between;
    align-items: center;
}


.member-left {
    display: flex;
    align-items: center;
    gap: 10px;
}

.avatar {
    width: 40px;
    height: 40px;
    background: #dcdcdc;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
}


.member-name {
    font-weight: bold;
    font-size: 14px;
}

.member-phone {
    font-size: 12px;
    color: #666;
}


.member-right {
    display: flex;
    align-items: center;
    gap: 10px;
}


.status {
    padding: 5px 10px;
    border-radius: 10px;
    font-size: 12px;
    font-weight: bold;
}

.status.aktif {
    background: #cfe2ff;
    color: #2f5eff;
}

.status.nonaktif {
    background: #ffd6d6;
    color: #d60000;
}


.arrow {
    font-size: 18px;
    color: #888;
}


.btn-tambah {
    position: absolute;
    bottom: 100px;
    right: 25px;
    background: #4a6cf7;
    color: white;
    border-radius: 50%;
    width: 55px;
    height: 55px;
    font-size: 28px;
    text-align: center;
    line-height: 55px;
    text-decoration: none;
    box-shadow: 0 8px 15px rgba(0,0,0,0.2);
}


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

<!-- HEADER -->
<div class="header">
    <div class="header-top">
        <b>Data Member</b>
    </div>
    <p>Kelola member gym kamu</p>
</div>


<div class="container-box">

<?php while($m = mysqli_fetch_assoc($data)) { ?>

<?php 
    $status = strtolower($m['status'] ?? 'aktif');
    $statusClass = ($status == 'aktif') ? 'aktif' : 'nonaktif';
?>


<a href="detail_member.php?id=<?php echo $m['id_member']; ?>" style="text-decoration:none; color:inherit;">

<div class="member-card">

    <div class="member-left">
        <div class="avatar">👤</div>
        <div>
            <div class="member-name"><?php echo $m['nama']; ?></div>
            <div class="member-phone"><?php echo $m['no_hp']; ?></div>
        </div>
    </div>

    <div class="member-right">
        <span class="status <?php echo $statusClass; ?>">
            <?php echo ucfirst($status); ?>
        </span>
        <span class="arrow">›</span>
    </div>

</div>

</a>

<?php } ?>

</div>


<a href="tambah_member.php" class="btn-tambah">+</a>

<!-- NAVBAR -->
<div class="bottom-nav">
    <a href="index.php" class="nav-item">
        <div>🏠</div>
        <small>Home</small>
    </a>

    <a href="member.php" class="nav-item active">
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
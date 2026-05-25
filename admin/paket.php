<?php
session_start();
if ($_SESSION['status'] != "login") {
    header("Location: ../index.php?pesan=belum_login");
    exit();
}

include '../koneksi.php';
$data = mysqli_query($koneksi, "SELECT * FROM paket");
?>

<!DOCTYPE html>
<html>
<head>
<title>Kelola Paket</title>
<link rel="stylesheet" href="../assets/css/bootstrap.css">

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
    padding-bottom:90px;
}


.header{
    background:linear-gradient(135deg,#4a6cf7,#6f8cff);
    color:white;
    padding:20px;
    border-radius:20px;
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

.container-box{
    padding:0 15px;
}

.card-paket{
    background:white;
    border-radius:15px;
    padding:12px 15px;
    margin-bottom:12px;
    box-shadow:0 5px 10px rgba(0,0,0,0.05);

    display:flex;
    justify-content:space-between;
    align-items:center;
}

/* LEFT */
.paket-info{
    display:flex;
    align-items:center;
    gap:10px;
}

.icon{
    width:40px;
    height:40px;
    background:#4a6cf7;
    color:white;
    border-radius:10px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:18px;
}


.nama{
    font-weight:bold;
    font-size:14px;
}

.harga{
    font-size:12px;
    color:#666;
}

.action a{
    padding:6px 8px;
    border-radius:8px;
    background:#f1f3f5;
    margin-left:5px;
    display:inline-block;
    text-decoration:none;
}

.action a:hover{
    background:#e0e3ff;
}

/* khusus tombol hapus */
.action a.hapus{
    background:#ffe5e5;
    color:red;
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

.nav-item{
    text-align:center;
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

<!-- HEADER -->
<div class="header">
    <div class="header-top">
        <b>Kelola Paket</b>
        <a href="tambah_paket.php" class="tambah">+ Paket</a>
    </div>
</div>


<div class="container-box">

<?php if(mysqli_num_rows($data) > 0){ ?>
    <?php while($p = mysqli_fetch_assoc($data)){ ?>

        <div class="card-paket">

            <div class="paket-info">
                <div class="icon">📦</div>

                <div>
                    <div class="nama"><?= $p['nama_paket']; ?></div>
                    <div class="harga">
                        Rp <?= number_format($p['harga']); ?> • <?= $p['durasi']; ?> hari
                    </div>
                </div>
            </div>

            
            <div class="action">

                <a href="edit_paket.php?id=<?= $p['id_paket']; ?>">
                    ✏️
                </a>
                
                <a href="hapus_paket.php?id=<?= $p['id_paket']; ?>" 
                   class="hapus"
                   onclick="return confirm('Yakin hapus paket ini?')">
                    🗑️
                </a>

            </div>

        </div>

    <?php } ?>
<?php } else { ?>
    <div class="card-paket">
        Belum ada paket
    </div>
<?php } ?>

</div>


<div class="bottom-nav">
    <a href="index.php" class="nav-item">
        <div>🏠</div>
        Home
    </a>
    <a href="member.php" class="nav-item">
        <div>👤</div>
        Member
    </a>
    <a href="paket.php" class="nav-item active">
        <div>📦</div>
        Paket
    </a>
    <a href="transaksi.php" class="nav-item">
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
<?php  
session_start();  

if ($_SESSION['status'] != "login") {  
    header("Location: ../index.php?pesan=belum_login");  
    exit();  
}  

include '../koneksi.php';  

$id = $_GET['id'];  

$query = mysqli_query($koneksi, "SELECT * FROM member WHERE id_member='$id'");  
$m = mysqli_fetch_assoc($query);  

if (!$m) {  
    echo "Data tidak ditemukan";  
    exit();  
}  
?>  

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Detail Member</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>


* {
    margin:0;
    padding:0;
    box-sizing:border-box;
}


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
    padding:60px 15px 15px;
    position:relative;
}


.phone::before {
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


.screen {
    width:100%;
    height:100%;
    background:#f4f6f9;
    border-radius:30px;
    overflow-y:auto;
    padding-bottom:100px;
}


.header {
    background:linear-gradient(135deg,#4a6cf7,#6f8cff);
    color:white;
    padding:15px;
    margin:10px 15px;
    border-radius:20px;
    display:flex;
    align-items:center;
    gap:10px;
}

.header i {
    cursor:pointer;
}


.profile {
    background:white;
    margin:0 15px 15px;
    padding:15px;
    border-radius:15px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    box-shadow:0 3px 10px rgba(0,0,0,0.05);
}

.profile-left {
    display:flex;
    align-items:center;
    gap:10px;
}

.profile i {
    font-size:30px;
    color:#bbb;
}

.status {
    padding:6px 12px;
    border-radius:10px;
    font-size:12px;
    font-weight:bold;
}

.status.aktif {
    background:#cfe2ff;
    color:#2f5eff;
}

.status.nonaktif {
    background:#ffd6d6;
    color:#d60000;
}


.section {
    background:white;
    margin:0 15px 15px;
    padding:15px;
    border-radius:15px;
    box-shadow:0 3px 10px rgba(0,0,0,0.05);
}

.section h3 {
    margin-bottom:10px;
    color:#4a6cf7;
}


.row {
    display:flex;
    justify-content:space-between;
    font-size:13px;
    margin-bottom:8px;
}


.line {
    border-bottom:1px solid #ddd;
    margin:10px 0;
}


.btn {
    width:90%;
    margin:10px auto;
    display:block;
    padding:12px;
    border:none;
    border-radius:12px;
    font-weight:bold;
    cursor:pointer;
}

.btn-edit {
    background:#4a6cf7;
    color:white;
}

.btn-delete {
    background:#ff4d4d;
    color:white;
}

</style>
</head>

<body>

<div class="phone">
<div class="screen">

<!-- HEADER -->
<div class="header">
    <i class="fas fa-arrow-left" onclick="history.back()"></i>
    <b>Detail Member</b>
</div>


<?php 
$status = strtolower($m['status'] ?? 'aktif');
$statusClass = ($status == 'aktif') ? 'aktif' : 'nonaktif';
?>

<div class="profile">
    <div class="profile-left">
        <i class="fas fa-user-circle"></i>
        <div>
            <b><?php echo $m['nama']; ?></b><br>
            <small>Member sejak <?php echo $m['tgl_daftar']; ?></small>
        </div>
    </div>

    <div class="status <?php echo $statusClass; ?>">
        <?php echo ucfirst($status); ?>
    </div>
</div>


<div class="section">
    <h3>Informasi</h3>

    <div class="row">
        <span>Nama</span>
        <span><?php echo $m['nama']; ?></span>
    </div>

    <div class="row">
        <span>NIK</span>
        <span><?php echo $m['nik']; ?></span>
    </div>

    <div class="row">
        <span>Alamat</span>
        <span><?php echo $m['alamat']; ?></span>
    </div>

    
    <div class="row">
        <span>No HP</span>
        <span><?php echo $m['no_hp']; ?></span>
    </div>

    <div class="line"></div>

    <h3>Riwayat</h3>

    <div class="row">
        <span>Paket Aktif</span>
        <span><?php echo $m['paket'] ?? '-'; ?></span>
    </div>

    <div class="row">
        <span>Bergabung</span>
        <span><?php echo $m['tgl_daftar']; ?></span>
    </div>

    <div class="row">
        <span>Check-in</span>
        <span><?php echo $m['last_checkin'] ?? '-'; ?></span>
    </div>

</div>


<button class="btn btn-edit" 
onclick="location.href='edit_member.php?id=<?php echo $m['id_member']; ?>'">
Edit Member
</button>

<button class="btn btn-delete" 
onclick="if(confirm('Yakin hapus member ini?')) location.href='hapus_member.php?id=<?php echo $m['id_member']; ?>'">
Hapus Member
</button>

</div>
</div>

</body>
</html>
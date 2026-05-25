<?php
session_start();
if ($_SESSION['status'] != "login") {
    header("Location: ../index.php?pesan=belum_login");
    exit();
}

include '../koneksi.php';

$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');

$tanggal_pilih = isset($_GET['tanggal']) 
    ? $_GET['tanggal'] 
    : date('Y-m-d');


$member = mysqli_query($koneksi, "SELECT * FROM member");


if(isset($_POST['simpan'])){
    $id_member = $_POST['id_member'];
    $tanggal = $tanggal_pilih; // 🔥 FIX DI SINI
    $jam_masuk = date('H:i:s');

    mysqli_query($koneksi, 
    "INSERT INTO absen VALUES (NULL,'$id_member','$tanggal','$jam_masuk','-')");
    
    header("Location: absen.php?tanggal=$tanggal&bulan=$bulan&tahun=$tahun");
    exit();
}

$qJumlah = mysqli_query($koneksi,"
SELECT COUNT(*) as total FROM absen 
WHERE tanggal='$tanggal_pilih'
");

$dataJumlah = mysqli_fetch_assoc($qJumlah);
$jumlah = $dataJumlah['total'] ?? 0;


$jumlah_hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
$hari_pertama = date('N', strtotime("$tahun-$bulan-01"));
?>

<!DOCTYPE html>
<html>
<head>
<title>Absen</title>
<link rel="stylesheet" href="../assets/css/bootstrap.css">

<style>
*{margin:0;padding:0;box-sizing:border-box;}

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

.calendar{
    display:grid;
    grid-template-columns: repeat(7,1fr);
    gap:5px;
    margin:0 15px 15px;
}

.day{
    text-align:center;
    padding:10px 0;
    border-radius:10px;
    font-size:12px;
}

.day.active{
    background:#4a6cf7;
    color:white;
}

.day.normal{
    background:#eee;
    color:#333;
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


<div class="header">

    <b style="font-size:22px;">
        Absensi
    </b>

</div>

<!-- PILIH BULAN -->
<div style="margin:0 15px 10px;">
<form method="get" style="display:flex; gap:10px;">
<select name="bulan" class="form-control">
<?php for($i=1;$i<=12;$i++){ ?>
<option value="<?= sprintf('%02d',$i); ?>" <?= $bulan==sprintf('%02d',$i)?'selected':'' ?>>
<?= date('F', mktime(0,0,0,$i,1)); ?>
</option>
<?php } ?>
</select>

<select name="tahun" class="form-control">
<?php for($t=2023;$t<=2030;$t++){ ?>
<option value="<?= $t; ?>" <?= $tahun==$t?'selected':'' ?>>
<?= $t; ?>
</option>
<?php } ?>
</select>

<button style="background:#4a6cf7;color:white;border:none;border-radius:10px;padding:8px 12px;">OK</button>
</form>
</div>

<!-- KALENDER -->
<div class="calendar">

<?php
for($i=1; $i<$hari_pertama; $i++){
    echo "<div></div>";
}

for($d=1; $d<=$jumlah_hari; $d++){
    $tgl_full = "$tahun-$bulan-".sprintf('%02d',$d);
    $aktif = ($tanggal_pilih == $tgl_full);
?>

<a href="?tanggal=<?= $tgl_full; ?>&bulan=<?= $bulan; ?>&tahun=<?= $tahun; ?>" style="text-decoration:none;">
<div class="day <?= $aktif ? 'active' : 'normal'; ?>">
<?= $d; ?>
</div>
</a>

<?php } ?>
</div>

<div style="text-align:center; margin-bottom:10px;">
<?= date('l, d F Y', strtotime($tanggal_pilih)); ?>
</div>


<div style="margin:0 15px 15px; background:white; padding:12px; border-radius:15px; text-align:center;">
<b><?= $jumlah; ?></b> Member Hadir
</div>

<!-- FORM -->
<div style="margin:0 15px 20px;">
<form method="post" action="?tanggal=<?= $tanggal_pilih; ?>&bulan=<?= $bulan; ?>&tahun=<?= $tahun; ?>">
<select name="id_member" class="form-control" required style="margin-bottom:10px;">
<option value="">-- pilih member --</option>
<?php while($m = mysqli_fetch_assoc($member)){ ?>
<option value="<?= $m['id_member']; ?>"><?= $m['nama']; ?></option>
<?php } ?>
</select>

<button type="submit" name="simpan" style="
width:100%;
padding:14px;
border:none;
border-radius:20px;
background:#4a6cf7;
color:white;">
+ Check-In Member
</button>
</form>
</div>


<?php
$data = mysqli_query($koneksi,"
SELECT absen.*, member.nama
FROM absen
JOIN member ON absen.id_member = member.id_member
WHERE tanggal='$tanggal_pilih'
ORDER BY id_absen DESC
");

while($a = mysqli_fetch_assoc($data)){
?>
<div style="background:white;margin:0 15px 12px;padding:12px;border-radius:15px;display:flex;justify-content:space-between;">
<div>
<b><?= $a['nama']; ?></b><br>
<small><?= substr($a['jam_masuk'],0,5); ?></small>
</div>

<div style="display:flex; gap:6px;">
<div style="background:#c6f6d5;color:#2f855a;padding:5px 10px;border-radius:10px;">
Masuk
</div>

<a href="hapus_absen.php?id=<?= $a['id_absen']; ?>"
onclick="return confirm('Yakin hapus data absen ini?')"
style="background:#feb2b2;color:#c53030;padding:5px 10px;border-radius:10px;text-decoration:none;">
Hapus
</a>
</div>
</div>
<?php } ?>


<div class="bottom-nav">
<a href="index.php" class="nav-item">
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

<a href="absen.php" class="nav-item active">
<div>✅</div>
<small>Absen</small>
</a>
</div>

</div>
</div>

</body>
</html>
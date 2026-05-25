<?php
session_start();

date_default_timezone_set('Asia/Jakarta');

if ($_SESSION['status'] != "login") {
    header("Location: ../index.php?pesan=belum_login");
    exit();
}

include '../koneksi.php';

$id = $_GET['id'];

$data = mysqli_query($koneksi, "SELECT * FROM member WHERE id_member='$id'");
$m = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){

    $nama   = $_POST['nama'];
    $nik    = $_POST['nik'];
    $alamat = $_POST['alamat'];
    $no_hp  = $_POST['no_hp'];
    $paket  = $_POST['paket'];
    $tgl    = $_POST['tanggal'];

    mysqli_query($koneksi, "
        UPDATE member SET
        nama='$nama',
        nik='$nik',
        alamat='$alamat',
        no_hp='$no_hp',
        paket='$paket',
        tgl_daftar='$tgl',
        last_checkin='$checkin'
        WHERE id_member='$id'
    ");

    header("Location: member.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Member</title>

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
    padding:15px;
    margin:10px 15px;
    border-radius:20px;
    display:flex;
    align-items:center;
    gap:10px;
}


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
}


.row{
    display:flex;
    gap:10px;
}

.row .col{
    flex:1;
}


.btn{
    width:100%;
    padding:14px;
    border:none;
    border-radius:12px;
    font-weight:bold;
    margin-top:10px;
    cursor:pointer;
}

.btn-save{
    background:#4a6cf7;
    color:white;
}

.btn-delete{
    background:red;
    color:white;
}

</style>
</head>

<body>

<div class="phone">
<div class="screen">


<div class="header">
    <span onclick="history.back()" style="cursor:pointer;">←</span>
    <b>Edit Member</b>
</div>


<div class="form-box">
<form method="post">

<label>Nama</label>
<input type="text" name="nama" class="input" value="<?= $m['nama']; ?>" required>

<label>NIK</label>
<input type="text" name="nik" class="input" value="<?= $m['nik']; ?>">

<label>Alamat</label>
<input type="text" name="alamat" class="input" value="<?= $m['alamat']; ?>">

<label>No HP</label>
<input type="text" name="no_hp" class="input" value="<?= $m['no_hp']; ?>">

<div class="row">
    <div class="col">
        <label>Paket aktif</label>

        <select name="paket" class="input">

            <option value="Harian"
            <?= ($m['paket']=='Harian') ? 'selected' : ''; ?>>
            Harian
            </option>

            <option value="Bulanan"
            <?= ($m['paket']=='Bulanan') ? 'selected' : ''; ?>>
            Bulanan
            </option>

            <option value="Tahunan"
            <?= ($m['paket']=='Tahunan') ? 'selected' : ''; ?>>
            Tahunan
            </option>

        </select>
    </div>

    <div class="col">
        <label>Bergabung</label>

        <input type="date"
        name="tanggal"
        class="input"
        value="<?= $m['tgl_daftar']; ?>">
    </div>
</div>

<button type="submit" name="update" class="btn btn-save">
    Simpan Perubahan
</button>

</form>

<button class="btn btn-delete"
onclick="if(confirm('Yakin hapus member?')) location.href='hapus_member.php?id=<?= $m['id_member']; ?>'">
Hapus Member
</button>

</div>

</div>
</div>

</body>
</html>
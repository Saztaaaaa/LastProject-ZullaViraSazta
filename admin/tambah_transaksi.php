<?php
session_start();

if ($_SESSION['status'] != "login") {
    header("Location: ../index.php?pesan=belum_login");
    exit();
}

include '../koneksi.php';

$member = mysqli_query($koneksi, "SELECT * FROM member");
$paket  = mysqli_query($koneksi, "SELECT * FROM paket");


if(isset($_POST['simpan'])){

    $id_member = $_POST['id_member'];
    $id_paket  = $_POST['id_paket'];
    $metode    = $_POST['metode'];

    $tanggal = date('Y-m-d');

    $p = mysqli_fetch_assoc(mysqli_query($koneksi,"
        SELECT * FROM paket
        WHERE id_paket='$id_paket'
    "));

    if(!$p){
        die("Paket tidak ditemukan!");
    }

    $total  = $p['harga'];
    $durasi = $p['durasi'];

    /* KONVERSI DURASI */
    if($durasi == "1 Bulan"){
        $tanggal_selesai = date('Y-m-d', strtotime("+1 month"));
    }
    elseif($durasi == "2 Bulan"){
        $tanggal_selesai = date('Y-m-d', strtotime("+2 month"));
    }
    elseif($durasi == "3 Bulan"){
        $tanggal_selesai = date('Y-m-d', strtotime("+3 month"));
    }
    elseif($durasi == "1 Tahun"){
        $tanggal_selesai = date('Y-m-d', strtotime("+1 year"));
    }
    elseif($durasi == "2 Tahun"){
        $tanggal_selesai = date('Y-m-d', strtotime("+2 year"));
    }
    else{
        $tanggal_selesai = date('Y-m-d');
    }

    mysqli_query($koneksi,"
INSERT INTO transaksi
(id_member,id_paket,tanggal,tanggal_selesai,total,status)
VALUES
('$id_member','$id_paket','$tanggal','$tanggal_selesai','$total','aktif')
    ");

    header("Location: transaksi.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Tambah Transaksi</title>

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
    position:relative;
    padding-bottom:40px;
}

.header{
    background:linear-gradient(135deg,#3349d8,#3f5eff);
    color:white;
    padding:20px;
    margin:10px;
    border-radius:20px;
}

.header-top{
    display:flex;
    align-items:center;
    gap:15px;
}

.back{
    color:white;
    text-decoration:none;
    font-size:22px;
}


.form-box{
    padding:15px;
}

.label{
    font-weight:bold;
    color:#0d4b5c;
    margin-bottom:6px;
    display:block;
    font-size:14px;
}

.input{
    width:100%;
    padding:14px;
    border:none;
    border-radius:12px;
    background:#ececec;
    margin-bottom:15px;
    font-size:14px;
}

.row{
    display:flex;
    gap:10px;
}


.metode{
    flex:1;
    padding:14px;
    border:none;
    border-radius:12px;
    background:#ececec;
    cursor:pointer;
    transition:0.3s;
}

.metode.active{
    background:#3349d8;
    color:white;
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
    background:#3349d8;
    color:white;
}

.btn-batal{
    background:#ececec;
    color:#3349d8;
}


.popup-qris{
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.45);
    display:none;
    justify-content:center;
    align-items:center;
    z-index:999;
    border-radius:30px;
}


.popup-content{
    width:290px;
    height:540px;
    background:#1e88e5;
    border-radius:40px;
    overflow:hidden;
    padding-bottom:20px;
    animation:popup .2s ease;
    display:flex;
    flex-direction:column;
}

@keyframes popup{
    from{
        transform:scale(.8);
        opacity:0;
    }
    to{
        transform:scale(1);
        opacity:1;
    }
}


.qris-header{
    background:#0f2230;
    color:white;
    font-size:10px;
    padding:12px;
    display:flex;
    justify-content:space-between;
    align-items:start;
}

.close-btn{
    background:none;
    border:none;
    color:white;
    font-size:18px;
    cursor:pointer;
}


.qris-body{
    flex:1;
    display:flex;
    justify-content:center;
    align-items:flex-start;
    padding-top:35px;
}


.qr-wrapper{
    position:relative;
}


.qr-image{
    width:230px;
    background:white;
    padding:12px;
    border-radius:12px;
}


.logo-dana{
    width:34px;
    position:absolute;
    top:50%;
    left:50%;
    transform:translate(-50%,-50%);
    background:white;
    padding:2px 5px;
    border-radius:20px;
}


.btn-kembali-qris{
    width:82%;
    margin:auto;
    margin-bottom:12px;
    display:block;
    padding:13px;
    border:none;
    border-radius:18px;
    background:white;
    font-weight:bold;
    font-size:15px;
    cursor:pointer;
}

</style>
</head>

<body>

<div class="phone">

<div class="screen">


<div class="header">

    <div class="header-top">

        <a href="transaksi.php" class="back">
            <i class="fa-solid fa-arrow-left"></i>
        </a>

        <h3>Tambah Transaksi</h3>

    </div>

</div>


<div class="form-box">

<form method="POST">

<label class="label">Pilih Member</label>

<select name="id_member" class="input" required>

    <option value="">Pilih member..</option>

    <?php while($m = mysqli_fetch_assoc($member)){ ?>

    <option value="<?= $m['id_member']; ?>">
        <?= $m['nama']; ?>
    </option>

    <?php } ?>

</select>

<label class="label">Pilih Paket</label>

<select name="id_paket" class="input" required>

    <option value="">Pilih paket..</option>

    <?php while($p = mysqli_fetch_assoc($paket)){ ?>

    <option value="<?= $p['id_paket']; ?>">
        <?= $p['nama_paket']; ?> -
        Rp <?= number_format($p['harga'],0,',','.'); ?>
    </option>

    <?php } ?>

</select>

<label class="label">Tanggal</label>

<input type="text"
class="input"
value="<?= date('d F Y'); ?>"
readonly>

<label class="label">Metode Pembayaran</label>

<div class="row">

    
    <button type="button"
    class="metode active"
    onclick="pilihMetode('Tunai', this)">

        Tunai

    </button>

  
    <button type="button"
    class="metode"
    onclick="pilihMetode('DANA', this)">

        <img src="https://upload.wikimedia.org/wikipedia/commons/7/72/Logo_dana_blue.svg"
        width="55">

    </button>

</div>

<input type="hidden"
name="metode"
id="metode"
value="Tunai">

<button type="submit"
name="simpan"
class="btn btn-save">

    Simpan

</button>

<button type="button"
onclick="history.back()"
class="btn btn-batal">

    Batal

</button>

</form>

</div>


<div class="popup-qris" id="qrBox">

    <div class="popup-content">

       
        <div class="qris-header">

            <div>
                Scan di DANA: bisa berkali-kali dipakai.
                <br>
                Aplikasi lain: hanya untuk 1x transaksi.
            </div>

            <button class="close-btn"
            onclick="tutupQR()">

                ✕

            </button>

        </div>

        
        <div class="qris-body">

            <div class="qr-wrapper">

                <!-- QR -->
               <img class="qr-image"
                src="../assets/img/qris_dana.jpeg">

            </div>

        </div>

    </div>

</div>

</div>
</div>

<script>

function pilihMetode(metode, element){

    document.getElementById('metode').value = metode;

    let btn = document.querySelectorAll('.metode');

    btn.forEach(b => b.classList.remove('active'));

    element.classList.add('active');

    if(metode == 'DANA'){

        document.getElementById('qrBox').style.display='flex';

    }else{

        document.getElementById('qrBox').style.display='none';

    }
}

function tutupQR(){

    document.getElementById('qrBox').style.display='none';

}

</script>

</body>
</html>
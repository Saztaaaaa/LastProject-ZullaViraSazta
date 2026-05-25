<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login GymFit</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>


* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}


body {
    background: #111;
    min-height: 100vh;

    display: flex;
    justify-content: center;
    align-items: center;

    font-family: 'Segoe UI', sans-serif;
}


.phone {
    width: 390px;
    height: 750px;
    background: #eaeaea;
    border-radius: 40px;
    box-shadow: 0 0 40px rgba(0,0,0,0.6);
    padding: 20px;

    display: flex;
}

.phone::before {
    content: '';
    width: 120px;
    height: 25px;
    background: black;
    border-radius: 20px;
    position: absolute;
    top: 15px;
    left: 50%;
    transform: translateX(-50%);
}


.screen {
    width: 100%;
    height: 100%;
    background: #f2f2f2;
    border-radius: 30px;

    display: flex;
    justify-content: center;
    align-items: center;
}

.login-card {
    width: 100%;
    background: white;
    border-radius: 25px;
    padding: 25px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}


.logo {
    text-align: center;
    margin-bottom: 25px;
}

.logo img {
    width: 140px;
}


.input-box {
    background: #eaeaea;
    border-radius: 15px;
    padding: 12px;
    margin-bottom: 15px;

    display: flex;
    align-items: center;
}

.input-box i {
    margin-right: 10px;
    color: #666;
}

.input-box input {
    border: none;
    background: transparent;
    outline: none;
    width: 100%;
}


.btn {
    width: 100%;
    padding: 14px;
    border-radius: 15px;
    border: none;
    background: #3b5bdb;
    color: white;
    font-weight: bold;
    margin-top: 10px;
    cursor: pointer;
}

.btn:hover {
    background: #2f4cc0;
}


.alert {
    padding: 10px;
    border-radius: 10px;
    text-align: center;
    margin-bottom: 10px;
    font-size: 13px;
    background: #ffdddd;
    color: red;
}

</style>
</head>

<body>

<div class="phone">
    <div class="screen">

        <div class="login-card">

            <div class="logo">
                <img src="assets/img/logo.jpeg" alt="Logo">
            </div>

            <?php
            if (isset($_GET['pesan']) && $_GET['pesan'] == "gagal") {
                echo "<div class='alert'>Login gagal!</div>";
            }
            ?>

            <form method="post" action="login.php">

                <div class="input-box">
                    <i class="fa-regular fa-user"></i>
                    <input type="text" name="username" placeholder="Username" required>
                </div>

                <div class="input-box">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <button class="btn">Masuk</button>

            </form>

        </div>

    </div>
</div>

</body>
</html>
<?php
    session_start();
    require "../koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-... (integrity value)" crossorigin="anonymous">
    <style>
        body {
            background-color: #5cb85c; /* Warna hijau yang menarik */
        }

        .main {
            height: 100vh;
            display: flex;
            align-items: center;
        }

        .login-box {
            width: 500px;
            height: auto;
            box-sizing: border-box;
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.8); /* Tambahkan transparansi pada kotak login */
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); /* Tambahkan efek bayangan */
        }

        form label {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }

        form label i {
            margin-right: 10px;
        }

        button.btn-success {
            background-color: #4CAF50; /* Warna hijau */
            color: white;
            transition: background-color 0.3s; /* Menambahkan efek transisi untuk perubahan warna */
        }

        button.btn-success:hover {
            background-color: #45a049; /* Warna hijau yang sedikit lebih gelap saat hover */
        }
    </style>
</head>

<body>
    <div class="main d-flex flex-column justify-content-center align-items-center">
        <div class="login-box p-5 shadow">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label"><i class="fas fa-user"></i>Username</label>
                    <input type="text" class="form-control" name="username" id="username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label"><i class="fas fa-lock"></i>Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div>
                    <button class="btn btn-success form-control mt-3" type="submit" name="loginbtn">Login</button>
                </div>
            </form>
        </div>

        <div class="mt-3" style="width: 500px">
            <?php
                if(isset($_POST['loginbtn'])){
                    $username = htmlspecialchars($_POST['username']);
                    $password = htmlspecialchars($_POST['password']);

                    $query = mysqli_query($con, "SELECT * FROM users WHERE username= '$username'");
                    $countdata = mysqli_num_rows($query);
                    $data = mysqli_fetch_array($query);

                    if($countdata > 0){
                        if(password_verify($password, $data['password'])){
                            $_SESSION['username'] = $data['username'];
                            $_SESSION['login'] = true;
                            header('location: ../adminpanel');
                        }
                        else{
                            ?>
                            <div class="alert alert-warning" role="alert">
                                Akun Tidak Tersedia
                            </div>
                            <?php
                        }
                    }
                    else {
                        ?>
                        <div class="alert alert-warning" role="alert">
                            Akun Tidak Tersedia
                        </div>
                        <?php
                    }
                }
            ?>
        </div>
    </div>
</body>
</html>

<?php
    require "koneksi.php";

    $nama = htmlspecialchars($_GET['nama']);
    $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE nama='$nama'");
    $produk = mysqli_fetch_array($queryProduk);

    $queryProdukTerkait = mysqli_query($con, "SELECT * FROM produk WHERE kategori_id='$produk[kategori_id]' AND id!='$produk[id]' LIMIT 4");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online | Detail Produk</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php require "navbar.php"; ?>

    <!-- Detail Produk -->
    <div class="container-fluid py-5 warna3">
        <div class="container">
            <div class="row mt-5">
                <div class="col-lg-5 mb-5">
                    <img src="image/<?php echo $produk['foto']; ?>" class="w-100" alt="">
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th scope="row" class="warna2 text-white">Nama Produk</th>
                                <td><?php echo $produk['nama']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row" class="warna2 text-white">Deskripsi</th>
                                <td><?php echo $produk['detail']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row" class="warna2 text-white">Harga</th>
                                <td>Rp <?php echo $produk['harga']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row" class="warna2 text-white">Status Ketersediaan</th>
                                <td>
                                    <strong style="color: <?php echo ($produk   ['ketersediaan_stok'] == 'Tersedia') ? : '#5f6f52'; ?>">
                                        <?php echo $produk['ketersediaan_stok']; ?>
                                    </strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Produk Terkait -->
    <div class="container-fluid py-5 warna2">
        <div class="container">
            <h2 class="text-center text-white mb-5">Produk Terkait</h2>

            <div class="row">
                <?php while($data=mysqli_fetch_array($queryProdukTerkait)){ ?>
                <div class="col-md-6 col-lg-3 mb-3">
                    <a href="produk-detail.php?nama=<?php echo $data['nama']; ?>">
                        <img src="image/<?php echo $data['foto']; ?>" class="img-fluid img-thumbnail produk-terkait-image" alt="">
                    </a>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    
    <!-- footer -->
    <?php require "footer.php"; ?>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>
</html>
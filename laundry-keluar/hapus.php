<?php 
    session_start();

    require 'functions.php';

    // 1. Cek Login
    if(!isset($_SESSION["login"])) {
        header("Location: ../login/index.php");
        exit;
    }

    // 2. Cek apakah ada ID yang dikirim
    if(!isset($_GET["id"])) {
        header("Location: ../laundry-keluar");
        exit;
    }

    $id = $_GET["id"];
    $status_hapus = ""; // Variabel untuk menyimpan status (sukses/gagal)

    // 3. Jalankan fungsi hapus
    // Jika return value > 0 berarti berhasil, jika tidak berarti gagal
    if(hapus($id) > 0) {
        $status_hapus = "sukses";
    } else {
        $status_hapus = "gagal";
    }
    $path = "../";
    include ('../view/header.php');  
?>

<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="homepage">
                    <div class="text-center">

                        <?php if ($status_hapus == "sukses") : ?>
                            <h2>Selamat</h2>
                            <p>
                                Data telah berhasil dihapus :]
                                <br /><a href="../laundry-keluar/index.php" class="btn btn-primary mt-2">Kembali</a>
                            </p>

                        <?php else : ?>
                            <h2>Maaf</h2>
                            <p>
                                Terjadi kesalahan, data tidak terhapus :[
                                <br /><a href="../laundry-keluar/index.php" class="btn btn-primary mt-2">Kembali</a>
                            </p>

                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    include('../view/footer.php'); 
?>
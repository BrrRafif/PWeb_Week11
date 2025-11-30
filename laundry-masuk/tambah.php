<?php 
    session_start();
    
    require 'functions.php';

    $HARGA_PER_KG = 4000;

    // 1. Cek Login
    if(!isset($_SESSION["login"])) {
        header("Location: ../login/index.php");
        exit;
    }

    // 2. Inisialisasi Status Tampilan
    // Default status adalah 'form' (menampilkan formulir input)
    $status = 'form'; 

    if(isset($_POST['tambah'])){
    // Tentukan harga berdasarkan kategori
    if($_POST['kategori'] === 'express'){
        $_POST['harga'] = 8000;
    } else {
        $_POST['harga'] = 4000; // kategori umum
    }

    if(tambah($_POST) > 0) {
        $status = 'sukses';
    } else {
        $status = 'gagal';
    }
}
    $path = "../";
    include ('../view/header.php');
?>

<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">                           

                <?php if ($status == 'sukses') : ?>
                    <div class="homepage">
                        <div class="text-center">
                            <h2>Selamat</h2>
                            <p>
                                Data telah berhasil disimpan :]
                                <br /><a href="../laundry-masuk/index.php" class="btn btn-primary mt-2">Kembali</a>
                            </p>
                        </div>
                    </div>

                <?php elseif ($status == 'gagal') : ?>
                    <div class="homepage">
                        <div class="text-center">
                            <h2>Maaf</h2>
                            <p>
                                Terjadi kesalahan, data tidak tersimpan :[
                                <br /><a href="tambah.php">Kembali</a>
                            </p>
                        </div>
                    </div>

                <?php else : ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">Tambah Data Laundry Masuk</div>
                        <div class="panel-body">                                       
                            <form class="form-horizontal" role="form" action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                                <div class="form-group">
                                    <label class="control-label col-sm-2">Nama Konsumen :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nama_konsumen" placeholder="Bheta" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2">Berat (kg) :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="berat" placeholder="2" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2">Kategori :</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="kategori" required>
                                            <option value="umum">Umum</option>
                                            <option value="express">Express</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-primary mt-2" name="tambah" value="Tambah" type="submit">Tambah</button>
                                </div>
                            </form>                       
                        </div>
                    </div> 

                <?php endif; ?>
                
            </div>
        </div>
    </div>
</div>
            
<?php
    include('../view/footer.php');
?>
<?php
    session_start();
    
    require 'functions.php';

    // Cek Login
    if(!isset($_SESSION["login"])) {
        header("Location: ../login/index.php");
        exit;
    }        

    // Inisialisasi variabel status untuk menentukan tampilan
    $status = ''; 

    // LOGIKA PEMROSESAN DATA
    if(isset($_POST['tambah'])){
        // Cek apakah fungsi tambah berhasil (return value > 0)
        if(tambah($_POST) > 0) {
            $status = 'sukses';
        } 
        else {
            $status = 'gagal';
        }
    }

    // Ambil data untuk dropdown (hanya perlu jika kita akan menampilkan form)
    $exits = tampil("SELECT * FROM transaksi WHERE status = 'Belum diambil' ORDER BY nama_konsumen, masuk ASC");

    $path = "../";
    include ('../view/header.php');  
?>

<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">

                <?php if ($status == 'gagal') : ?>
                    <div class="homepage">
                        <div class="text-center">
                            <h2>Maaf</h2>
                            <p>
                                Terjadi kesalahan, data tidak tersimpan :[
                                <br /><a href="../laundry-keluar/index.php" class="btn btn-primary mt-2">Kembali</a> 
                            </p>
                        </div>
                    </div>

                <?php elseif ($status == 'sukses') : ?>
                    <div class="homepage">
                        <div class="text-center">
                            <h2>Selamat</h2>
                            <p>
                                Data telah berhasil disimpan :]
                                <br /><a href="../laundry-keluar/index.php" class="btn btn-primary mt-2">Kembali</a>
                            </p>
                        </div>
                    </div>

                <?php else : ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">Tambah Data Laundry Keluar</div>
                        <div class="panel-body">                     
                            <form class="form-horizontal" role="form" action="" method="post">
                                <div class="form-group">
                                    <label class="control-label col-sm-2">Laundry :</label>                                   
                                    <div class="col-sm-10">     
                                        <select class="form-control" name="id">   
                                            <option> -- Pilih -- </option>
                                            <?php foreach ($exits as $exit) : ?>
                                            <option value="<?= $exit["id"]; ?>">
                                                <?= $exit["nama_konsumen"]; ?> - 
                                                <?php 
                                                    $masuk = $exit['masuk']; 
                                                    $dateMasuk = date_create("$masuk"); 
                                                    echo date_format($dateMasuk,"d/m/Y"); 
                                                ?> - 
                                                <?= $exit["berat"]; ?> kg - <?= $exit["kategori"]; ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button class="btn btn-primary" name="tambah" value="Tambah" type="submit">Tambah</button>
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
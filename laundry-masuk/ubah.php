<?php 
    session_start();

    require 'functions.php';

    // 1. Cek Login
    if(!isset($_SESSION["login"])) {
        header("Location: ../login/index.php");
        exit;
    }

    // 2. Ambil ID & Cek Validitas
    if(!isset($_GET["id"])) {
        header("Location: ../laundry-masuk/index.php");
        exit;
    }

    $id = $_GET["id"];

    // 3. Ambil data lama
    $data_transaksi = tampil("SELECT * FROM transaksi WHERE id = $id");
    
    if(count($data_transaksi) == 0) {
        echo "Data tidak ditemukan!";
        exit;
    }
    
    $enter = $data_transaksi[0];
    $status_update = 'form'; 

    // 4. Logika Update dengan Penentuan Harga Otomatis
    if(isset($_POST['update'])){
        
        // --- LOGIKA HARGA (Sama seperti di tambah.php) ---
        // Kita manipulasi $_POST sebelum dikirim ke fungsi ubah
        if($_POST['kategori'] === 'express'){
            $_POST['harga'] = 8000;
        } else {
            $_POST['harga'] = 4000; // kategori umum
        }

        // Jalankan fungsi ubah
        if(ubah($_POST) > 0) {
            $status_update = 'sukses';
        }
        else {
            $status_update = 'gagal';
        }
    }    
    $path = "../";
    include ('../view/header.php');    
?>

<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                
                <?php if ($status_update == 'sukses') : ?>
                    <div class="homepage">
                        <div class="text-center">
                            <h2>Selamat</h2>
                            <p>
                                Data telah berhasil diperharui :]
                                <br /><a href="../laundry-masuk/index.php" class="btn btn-primary mt-2" >Kembali ke Daftar</a>
                            </p>
                        </div>
                    </div>

                <?php elseif ($status_update == 'gagal') : ?>
                    <div class="homepage">
                        <div class="text-center">
                            <h2>Maaf</h2>
                            <p>
                                Terjadi kesalahan, data tidak dapat diperharui atau tidak ada perubahan data :[
                                <br />
                                <a href="ubah.php?id=<?= $id; ?>" class="btn btn-primary mt-2" >Coba Lagi</a>
                            </p>
                        </div>
                    </div>

                <?php else : ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">Ubah Data Laundry Masuk</div>
                        <div class="panel-body">                                    
                            <form class="form-horizontal" role="form" action="" method="post">
                                <input type="hidden" name="id" value="<?= $enter['id']; ?>">

                                <div class="form-group">
                                    <label class="control-label col-sm-2">Nama Konsumen :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nama_konsumen" value="<?= htmlspecialchars($enter['nama_konsumen']); ?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2">Berat (kg) :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="berat" value="<?= $enter['berat']; ?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2">Kategori :</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="kategori" required>
                                            <option value="umum" <?= ($enter['kategori'] == 'umum') ? 'selected' : ''; ?>>Umum</option>
                                            <option value="express" <?= ($enter['kategori'] == 'express') ? 'selected' : ''; ?>>Express</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button class="btn btn-primary mt-2" name="update" value="Update" type="submit">Update Data</button>
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
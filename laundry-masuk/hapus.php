<?php
  session_start();
  require 'functions.php';

  if (!isset($_SESSION["login"])) {
    header("Location: ../login/index.phps");
    exit;
  }

  $berhasil = false;
  $pesan = "";

  if (isset($_GET["id"])) {
    $id = $_GET["id"];
    
    if (hapus($id) > 0) {
        $berhasil = true;
    } else {
        $berhasil = false;
    }
  } 

  else $berhasil = false;

  $path = "../";
  include('../view/header.php');
?>

<div id="page-content-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="homepage">
          <div class="text-center">
            <?php if ($berhasil) : ?>
                <h2>Selamat</h2>
                <p>
                  Data telah berhasil dihapus :]
                  <br /><a href="../laundry-masuk/index.php" class="btn btn-primary mt-2" >Kembali</a>
                </p>

            <?php else : ?>
                <h2>Maaf</h2>
                <p>
                  Terjadi kesalahan, data tidak terhapus :[
                  <br /><a href="../laundry-masuk/index.php" class="btn btn-primary mt-2" >Kembali</a>
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
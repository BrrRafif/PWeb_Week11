<?php
session_start();

    if( !isset($_SESSION["login"]) ) {
        header("Location: login/index.php");
        exit; 
    }

    $username = $_SESSION["user"];
    
    $path = "";
    include 'view/header.php'; 
?>

    <div id="page-content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="homepage">
                                <div class="text-center">
                                    <h2>Selamat Datang di Laundry Crafty</h2>
                                    <p>
                                        Halo <b><?php echo $username;?></b>, Selamat datang di Laundry Crafty :]
                                        <br />Sebuah web apps sederhana yang berfungsi untuk melakukan pendataan laundry
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 

<?php include('view/footer.php'); ?>
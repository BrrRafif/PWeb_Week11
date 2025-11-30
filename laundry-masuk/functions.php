<?php
    require('../config.php');

    function tampil($query) {
        global $conn;

        $result = mysqli_query($conn, $query);

        $rows = [];

        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }

        return $rows;
    }

    function tambah($data) {
    global $conn;

    $nama = mysqli_real_escape_string($conn, $data["nama_konsumen"]);
    $berat = (float)$data["berat"];
    $kategori = mysqli_real_escape_string($conn, $data["kategori"]);
    $harga = (float)$data["harga"];
    $total = $berat * $harga;

    $sql = "INSERT INTO transaksi (masuk, keluar, nama_konsumen, berat, kategori, status, harga_satuan, harga_total)
            VALUES (NOW(), DATE_ADD(NOW(), INTERVAL 3 DAY), '$nama', $berat, '$kategori', 'Belum diambil', $harga, $total)";

    mysqli_query($conn, $sql);

    return mysqli_affected_rows($conn);
}


    function ubah($data) {
    global $conn;

    $id = (int)$data["id"];
    $nama = mysqli_real_escape_string($conn, $data["nama_konsumen"]);
    $berat = (float)$data["berat"];
    $kategori = mysqli_real_escape_string($conn, $data["kategori"]);
    $harga = (float)$data["harga"];
    $total = $berat * $harga;

    $sql = "UPDATE transaksi SET nama_konsumen = '$nama', berat = $berat, kategori = '$kategori', 
            harga_satuan = $harga, harga_total = $total WHERE id = $id";

    mysqli_query($conn, $sql);

    return mysqli_affected_rows($conn);
}

    function hapus($id) {
    global $conn;
    
    $id = (int)$id;
    mysqli_query($conn, "DELETE FROM transaksi WHERE id = $id");

    return mysqli_affected_rows($conn);
}

?>
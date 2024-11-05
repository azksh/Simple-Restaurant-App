<?php
include('koneksi.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $hapus = mysqli_query($koneksi, "DELETE FROM `order` WHERE id_order = '$id'");

    if($hapus){
        header('location: pesanan.php');
    } else {
        echo "Hapus data gagal";
    }
} else {
    echo "ID tidak ditemukan.";
}
?>

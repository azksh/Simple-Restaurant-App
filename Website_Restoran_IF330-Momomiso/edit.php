<?php 
include('koneksi.php');

$id_menu = $_POST['id_menu'];
$nama_menu = $_POST['nama_menu'];
$jenis_menu = $_POST['jenis_menu'];
$deskripsi = $_POST['deskripsi'];
$stok = $_POST['stok'];
$harga = $_POST['harga'];


if ($_FILES['gambar']['tmp_name']) {
    $nama_file = $_FILES['gambar']['name'];
    $source = $_FILES['gambar']['tmp_name'];
    $folder = './upload/';

  
    move_uploaded_file($source, $folder.$nama_file);

  
    $edit = mysqli_query($koneksi, "UPDATE product SET nama_menu='$nama_menu', jenis_menu='$jenis_menu', deskripsi='$deskripsi', stok='$stok', harga='$harga', gambar='$nama_file' WHERE id_menu='$id_menu' ");
} else {

    $edit = mysqli_query($koneksi, "UPDATE product SET nama_menu='$nama_menu', jenis_menu='$jenis_menu', deskripsi='$deskripsi', stok='$stok', harga='$harga' WHERE id_menu='$id_menu' ");
}

if ($edit) {
    header('location: admin_dashboard.php');
} else {
    echo "Edit Menu Gagal";
}
?>

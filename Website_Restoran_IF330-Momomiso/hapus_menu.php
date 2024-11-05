<?php 

include('koneksi.php');

$id_menu = $_GET['id_menu'];

$hapus= mysqli_query($koneksi, "DELETE FROM product WHERE id_menu='$id_menu'");

if($hapus)
	header('location: admin_dashboard.php');
else
	echo "Hapus data gagal";

 ?>
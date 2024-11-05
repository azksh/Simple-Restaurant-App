<?php 
include('koneksi.php');
session_start();

if (isset($_SESSION['email']) && $_SESSION['peran'] === 'user') {
  
} else {
    
    header('Location: login.php');
    exit();
}

$id_menu = $_GET['id_menu'];

if (isset($_SESSION['pesanan'][$id_menu]))
{
	$_SESSION['pesanan'][$id_menu]+=1;
}

else 
{
	$_SESSION['pesanan'][$id_menu]=1;
}

header('Location: pesanan_berhasil.php');
exit();

 ?>
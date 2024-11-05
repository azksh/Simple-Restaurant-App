<?php 
include('koneksi.php');
session_start();

if (isset($_SESSION['email']) && $_SESSION['peran'] === 'user') {
    
} else {

    header('Location: login.php');
    exit();
}


$id_menu = $_GET["id_menu"];

unset($_SESSION["pesanan"][$id_menu]);

header('Location: pesanan_dihapus.php');
    exit();

?>
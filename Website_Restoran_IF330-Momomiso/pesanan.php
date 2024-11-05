<?php
include('koneksi.php');
session_start();

if (isset($_SESSION['email']) && $_SESSION['peran'] === 'admin') {
   
} else {
    
    header('Location: login.php');
    exit();
}



?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/images/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>Customer Order Data</title>

    
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

   
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/owl.css">

  </head>

  <body>

    
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    

  
  <header class="">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="index.html"><h2>momo<em>miso</em></h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                      <span class="sr-only">(current)</span>
                    </a>
                </li> 

                <li class="nav-item"><a class="nav-link" href="admin_dashboard.php">Menu Settings</a></li>
                
                <li class="nav-item active"><a class="nav-link" href="pesanan.php">Customer Order Data</a></li>

                <li class="nav-item"><a class="nav-link" href="logout.php">Log Out</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </header>


  <div class="page-heading about-heading header-text" style="background-image: url(assets/images/heading-6-1920x500.jpg);">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>Discover the Exquisite Momomiso</h4>
              <h2>Menu</h2>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
    <div class="row">
          <div class="col-md-12">
      <div class="judul-pesanan mt-5">
       
        <h3 class="text-center font-weight-bold">DATA PESANAN PELANGGAN</h3>
        
      </div>
      <table class="table table-bordered" id="example">
        <thead class="thead-light">
          <tr>
            <th scope="col">No.</th>
            <th scope="col">ID Pemesanan</th>
            <th scope="col">Tanggal Pesan</th>
            <th scope="col">Total Bayar</th>
            <th scope="col">Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php $nomor=1; ?>
          <?php 
          
            $ambil = mysqli_query($koneksi, 'SELECT * FROM `order`');
            $result = mysqli_fetch_all($ambil, MYSQLI_ASSOC);
          ?>
          <?php foreach($result as $result) : ?>

          <tr>
            <th scope="row"><?php echo $nomor; ?></th>
            <td><?php echo $result["id_order"]; ?></td>
            <td><?php echo $result["tanggal_order"]; ?></td>
            <td>Rp. <?php echo number_format($result["total_belanja"]); ?></td>
            <td>
              
              <a href="detail_pesanan.php?id=<?php echo $result['id_order'] ?>" class="badge badge-primary">Detail</a>
             

              <a href="clear_pesanan.php?id=<?php echo $result['id_order'] ?>" class="badge badge-danger">Hapus Data</a>
            </td>
          </tr>
          <?php $nomor++; ?>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
    <script>
      $(document).ready(function() {
          $('#example').DataTable();
      } );
    </script>
  </body>
</html>
<?php  ?>
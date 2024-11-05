<?php
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

    <title>Menu Settings</title>

  
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
                <li class="nav-item">
                      <span class="sr-only">(current)</span>
                    </a>
                </li> 

                <li class="nav-item active"><a class="nav-link" href="admin_dashboard.php">Menu Settings</a></li>

                <li class="nav-item"><a class="nav-link" href="pesanan.php">Customer Order Data</a></li>

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
        <div class="row mt-3">
 
 <div class="container">
        <a href="tambah_menu.php" class="btn btn-success mt-3">TAMBAH DAFTAR MENU</a>
        <div class="row">

          <?php 

          include('koneksi.php');

          $query = mysqli_query($koneksi, 'SELECT * FROM product');
          $result = mysqli_fetch_all($query, MYSQLI_ASSOC);

          ?>

          <?php foreach($result as $result) : ?>

            <div class="col-md-3 mt-4">
            <div class="product-item card border-dark">
                <div class="product-image">
                    <img src="upload/<?php echo $result['gambar'] ?>" class="card-img-top" alt="...">
                    </div>
                    <div class="down-content">
                        <h4 class="card-title font-weight-bold"><?php echo $result['nama_menu'] ?></h4>
                    </div>
                    <div class="down-contents">
                        <h4 class="card-title font-weight-bold"><?php echo $result['nama_menu'] ?></h4>
                        <label class="card-title"><?php echo $result['deskripsi'] ?></label>
                        <label class="card-text harga"><strong>Rp.</strong> <?php echo number_format($result['harga']); ?></label><br>
                        <a href="edit_menu.php?id_menu=<?php echo $result['id_menu'] ?>" class="btn btn-success btn-sm btn-block">EDIT</a>
                        <a href="hapus_menu.php?id_menu=<?php echo $result['id_menu'] ?>" class="btn btn-danger btn-sm btn-block text-light">HAPUS</a>
                    </div>
                </div>
            </div>

              <?php endforeach; ?>
            </div>
          </div> 



  
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
  </body>
</html>
<?php  ?>
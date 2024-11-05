<script>
  document.addEventListener("DOMContentLoaded", function () {
    if (<?php session_start(); echo isset($_SESSION['email']) && $_SESSION['peran'] === 'user' ? 'true' : 'false'; ?>) {

    } else {

      alert("Silahkan login terlebih dahulu.");
      window.location.href = "login.php";
    }
  });
</script>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/images/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>Menu</title>

 
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
                    <a class="nav-link" href="index.php">Home
                      <span class="sr-only">(current)</span>
                    </a>
                </li> 

                <li class="nav-item active"><a class="nav-link" href="menu_pembeli.php">Order Menu</a></li>
                
                <li class="nav-item"><a class="nav-link" href="pesanan_pembeli.php">Cart</a></li>

                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
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

        <div class="container my-4">
    <ul class="nav nav-tabs" id="menuTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="food-tab" data-toggle="tab" href="#food" role="tab" aria-controls="food" aria-selected="true">Makanan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="drink-tab" data-toggle="tab" href="#drink" role="tab" aria-controls="drink" aria-selected="false">Minuman</a>
        </li>
    </ul>
    <div class="tab-content" id="menuTabContent">
        <div class="tab-pane fade show active" id="food" role="tabpanel" aria-labelledby="food-tab">
            <div class="row">
                <?php
                include('koneksi.php');

                $query = mysqli_query($koneksi, 'SELECT * FROM product WHERE jenis_menu = "Makanan"');
                $result = mysqli_fetch_all($query, MYSQLI_ASSOC);

                foreach ($result as $result) :
                ?>
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
                        <a href="beli.php?id_menu=<?php echo $result['id_menu']; ?>" class="btn btn-success btn-sm btn-block ">PESAN</a>
                    </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="tab-pane fade" id="drink" role="tabpanel" aria-labelledby="drink-tab">
            <div class="row">
                <?php
                $query = mysqli_query($koneksi, 'SELECT * FROM product WHERE jenis_menu = "Minuman"');
                $result = mysqli_fetch_all($query, MYSQLI_ASSOC);

                foreach ($result as $result) :
                ?>
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
                        <a href="beli.php?id_menu=<?php echo $result['id_menu']; ?>" class="btn btn-success btn-sm btn-block ">PESAN</a>
                    </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

  
     <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
  </body>

</html>
<?php  ?>
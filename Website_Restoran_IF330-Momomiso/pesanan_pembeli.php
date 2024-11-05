<script>
  document.addEventListener("DOMContentLoaded", function () {
    if (<?php session_start(); echo isset($_SESSION['email']) && $_SESSION['peran'] === 'user' ? 'true' : 'false'; ?>) {

    } else {
      
      alert("Silakan login terlebih dahulu.");
      window.location.href = "login.php";
    }
  });
</script>
<?php 
if(empty($_SESSION["pesanan"]) OR !isset($_SESSION["pesanan"]))
{
  header('Location: pesanan_kosong.php');
  exit();
}
?>

<!doctype html> 
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/images/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>Cart</title>

    
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/owl.css">
  </head>
  <body>

 

  
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

                <li class="nav-item"><a class="nav-link" href="menu_pembeli.php">Order Menu</a></li>
                
                <li class="nav-item active"><a class="nav-link" href="pesanan_pembeli.php">Cart</a></li>

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
              <h4>Lorem ipsum dolor sit amet</h4>
              <h2>Menu</h2>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="container">
      <div class="judul-pesanan mt-5">
       
        <h3 class="text-center font-weight-bold">PESANAN ANDA</h3>
        
      </div>
      <table class="table table-bordered" id="example">
        <thead class="thead-light">
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Pesanan</th>
            <th scope="col">Harga</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Subharga</th>
            <th scope="col">Opsi</th>
          </tr>
        </thead>
        <tbody>
            <?php $nomor=1; ?>
            <?php $totalbelanja = 0; ?>
            <?php foreach ($_SESSION["pesanan"] as $id_menu => $jumlah) : ?>

            <?php 
              include('koneksi.php');
              $ambil = mysqli_query($koneksi, "SELECT * FROM product WHERE id_menu='$id_menu'");
              $pecah = $ambil -> fetch_assoc();
              $subharga = $pecah["harga"]*$jumlah;
            ?>
          <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $pecah["nama_menu"]; ?></td>
            <td>Rp. <?php echo number_format($pecah["harga"]); ?></td>
            <td><?php echo $jumlah; ?></td>
            <td>Rp. <?php echo number_format($subharga); ?></td>
            <td>
              <a href="hapus_pesanan.php?id_menu=<?php echo $id_menu ?>" class="badge badge-danger">Hapus</a>
            </td>
          </tr>
            <?php $nomor++; ?>
            <?php $totalbelanja+=$subharga; ?>
            <?php endforeach ?>
        </tbody>
        <tfoot>
          <tr>
            <th colspan="4">Total Belanja</th>
            <th colspan="2">Rp. <?php echo number_format($totalbelanja) ?></th>
          </tr>
        </tfoot>
      </table><br>
      <form method="POST" action="">
        <a href="menu_pembeli.php" class="btn btn-primary btn-sm">Lihat Menu</a>
        <button class="btn btn-success btn-sm" name="konfirm">Konfirmasi Pesanan</button>
      </form>        

      <?php 
if(isset($_POST['konfirm'])) {
    $tanggal_order = date("Y-m-d");

    
    $insert = mysqli_query($koneksi, "INSERT INTO `order` (tanggal_order, total_belanja) VALUES ('$tanggal_order', '$totalbelanja')");

   
    $id_terbaru = $koneksi->insert_id;

    
    foreach ($_SESSION["pesanan"] as $id_menu => $jumlah)
    {
        $insert = mysqli_query($koneksi, "INSERT INTO order_product (id_order, id_menu, jumlah) 
          VALUES ('$id_terbaru', '$id_menu', '$jumlah') ");
    }

          
          unset($_SESSION["pesanan"]);

         
          echo '<script>window.location.href = "pesanan_sukses.php";</script>';

    exit();
  }
      ?>
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
<?php ?>
<?php
include('koneksi.php');
session_start();

if (isset($_SESSION['email']) && $_SESSION['peran'] === 'admin') {
    if (isset($_POST['bayar'])) {
        $id_order = $_GET['id'];
        
        $query = "INSERT INTO data_terjual (id_order, status) VALUES ($id_order, 'berhasil')";
        $result = mysqli_query($koneksi, $query);

        if ($result) {
           
            $delete_order_product = "DELETE FROM order_product WHERE id_order = $id_order";
            $result_order_product = mysqli_query($koneksi, $delete_order_product);
            
         
            $delete_order = "DELETE FROM `order` WHERE id_order = $id_order";
            $result_order = mysqli_query($koneksi, $delete_order);
            
            if ($result_order && $result_order_product) {
                echo "<script>alert('Pesanan Telah Terkonfirmasi dan Dipindahkan ke Data Terjual!');</script>";
                echo "<script>location= 'pesanan.php'</script>";
            } else {
                echo "Hapus pesanan gagal";
            }
        } else {
            echo "Gagal memindahkan data ke Data Terjual.";
        }
    }
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

    <title>detail pesanan</title>

   
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

                <li class="nav-item"><a class="nav-link" href="admin_dashboard.php">Menu Settings</a></li>

                <li class="nav-item"><a class="nav-link" href="pesanan.php">Back</a></li>

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
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="judul-pesanan mt-5">
       
        <h3 class="text-center font-weight-bold">DATA PESANAN PELANGGAN</h3>
        
      </div>
      <table class="table table-bordered" id="example">
        <thead class="thead-light">
          <tr>
            <th scope="col">No.</th>
            <th scope="col">ID Pemesanan</th>
            <th scope="col">Nama Pesanan</th>
            <th scope="col">Harga</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Subharga</th>
          </tr>
        </thead>
        <tbody>
          <?php $nomor=1; ?>
          <?php $totalbelanja = 0; ?>
          <?php 
              $ambil = $koneksi->query("SELECT * FROM order_product JOIN product ON order_product.id_menu=product.id_menu 
                WHERE order_product.id_order='$_GET[id]'");
           ?>
           <?php while ($pecah=$ambil->fetch_assoc()) { ?>
           <?php $subharga1=$pecah['harga']*$pecah['jumlah']; ?>
          <tr>
            <th scope="row"><?php echo $nomor; ?></th>
            <td><?php echo $pecah['id_order_product']; ?></td>
            <td><?php echo $pecah['nama_menu']; ?></td>
            <td>Rp. <?php echo number_format($pecah['harga']); ?></td>
            <td><?php echo $pecah['jumlah']; ?></td>
            <td>
              Rp. <?php echo number_format($pecah['harga']*$pecah['jumlah']); ?>
            </td>
          </tr>
          <?php $nomor++; ?>
          <?php $totalbelanja+=$subharga1; ?>
          <?php } ?>
        </tbody>
         <tfoot>
          <tr>
            <th colspan="5">Total Bayar</th>
            <th>Rp. <?php echo number_format($totalbelanja) ?></th>
          </tr>
        </tfoot>
      </table><br>
      
      <form method="POST" action="">
        <a href="pesanan.php" class="btn btn-success btn-sm">Kembali</a>
        <button class="btn btn-primary btn-sm" name="bayar">Konfirmasi Pembayaran</button>
      </form>  
      <?php 
        if(isset($_POST["bayar"]))
        {
          echo "<script>alert('Pesanan Telah Dibayar !');</script>";
          echo "<script>location= 'pesanan.php'</script>";
        }
      ?>
     
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
  
     <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>



    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
  </body>

</html>
<?php ?>
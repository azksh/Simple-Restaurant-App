<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

$db = new mysqli("localhost", "root", "", "restaurant");

if ($db->connect_error) {
    die("Koneksi gagal: " . $db->connect_error);
}


if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $peran = $_POST['peran'];
    

    if ($peran === 'user') {
    
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
    } elseif ($peran === 'admin') {
       
        $stmt = $db->prepare("SELECT * FROM admins WHERE email = ?");
    } else {
        $login_error = "Pilih peran (user atau admin)";
    }

    if (isset($stmt)) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            
            $pass_input = $_POST['pass']; 
            $hashed_pass = $row['password']; 

            if (password_verify($pass_input, $hashed_pass)) {
                // Login berhasil
                $_SESSION['email'] = $email;
                $_SESSION['peran'] = $row['peran']; 
    
                if ($row['peran'] === 'user') {
                    header('Location: index.php');
                } elseif ($row['peran'] === 'admin') {
                    header('Location: admin_dashboard.php');
                } else {
                   
                    $login_error = "Peran tidak valid";
                }
    
                exit();
            } else {
                $login_error = "Password salah";
            }
        } else {
            $login_error = "Email tidak ditemukan";
        }
    
        $stmt->close();
    }else {
        $login_error = "Terjadi kesalahan dalam proses login. Silakan coba lagi.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>


   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <style>
 
        select {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }

   
        select option {
            font-size: 16px;
        }

      
        select:hover {
            border-color: #555;
        }

        label{
        font-size: 20px; 
    }

        header {
	position: absolute;
	z-index: 99999;
	width: 100%;
	height: 80px;
	background-color: #232323;
	-webkit-transition: all 0.3s ease-in-out 0s;
    -moz-transition: all 0.3s ease-in-out 0s;
    -o-transition: all 0.3s ease-in-out 0s;
    transition: all 0.3s ease-in-out 0s;
}
header .navbar {
	padding: 17px 0px;
}
.background-header .navbar {
	padding: 17px 0px;
}
.background-header {
	top: 0;
	position: fixed;
	background-color: #fff!important;
	box-shadow: 0px 1px 10px rgba(0,0,0,0.1);
}
.background-header .navbar-brand h2 {
	color: #121212!important;
}
.background-header .navbar-nav a.nav-link {
	color: #1e1e1e!important;
}
.background-header .navbar-nav .nav-link:hover,
.background-header .navbar-nav .active>.nav-link,
.background-header .navbar-nav .nav-link.active,
.background-header .navbar-nav .nav-link.show,
.background-header .navbar-nav .show>.nav-link {
	color: #f33f3f!important;
}
.navbar .navbar-brand {
	float: 	left;
	margin-top: 10px;
    margin-left: 270px;
	outline: none;
}
.navbar .navbar-brand h2 {
	color: #fff;
	text-transform: uppercase;
	font-size: 24px;
	font-weight: 700;
	-webkit-transition: all .3s ease 0s;
    -moz-transition: all .3s ease 0s;
    -o-transition: all .3s ease 0s;
    transition: all .3s ease 0s;
}
.navbar .navbar-brand h2 em {
	font-style: normal;
	color: #2b84ff
}
#navbarResponsive {
	z-index: 999;
}
.navbar-collapse {
	text-align: center;
}
.navbar .navbar-nav .nav-item {
	margin: 0px 15px;
}
.navbar .navbar-nav a.nav-link {
	text-transform: capitalize;
	font-size: 15px;
	font-weight: 500;
	letter-spacing: 0.5px;
	color: #fff;
	transition: all 0.5s;
	margin-top: 5px;
}
.navbar .navbar-nav .nav-link:hover,
.navbar .navbar-nav .active>.nav-link,
.navbar .navbar-nav .nav-link.active,
.navbar .navbar-nav .nav-link.show,
.navbar .navbar-nav .show>.nav-link {
	color: #fff;
	padding-bottom: 25px;
	border-bottom: 3px solid #f33f3f;
}
.navbar .navbar-toggler-icon {
	background-image: none;
}
.navbar .navbar-toggler {
	border-color: #fff;
	background-color: #fff;	
	height: 36px;
	outline: none;
	border-radius: 0px;
	position: absolute;
	right: 30px;
	top: 20px;
}
.navbar .navbar-toggler-icon:after {
	content: '\f0c9';
	color: #f33f3f;
	font-size: 18px;
	line-height: 26px;
	font-family: 'FontAwesome';
}
    </style>

  
   <link rel="stylesheet" href="style.css">

</head>
<body>
<header class="">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand"><h2>momo<em>miso</em></h2></a>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
          </div>
        </div>
      </nav>
    </header>

<section class="form-container">

   <form action="login.php" method="post">
      <h3>login now</h3>
      <label for="birthdate">Login as :</label>
      <select name="peran" class="box">
   <option value="user">User</option>
   <option value="admin">Admin</option>
    </select>
      <input type="email" name="email" required placeholder="enter your email" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="enter your password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="login now" name="login" class="btn">
      <p><?php if (isset($login_error)) { echo $login_error; } ?></p>
      <p>don't have an account? <a href="register.php">sign up now</a></p>
   </form>

</section>
</body>
</html>

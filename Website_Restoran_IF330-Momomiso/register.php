<?php

$db = new mysqli("localhost", "root", "", "restaurant");

if ($db->connect_error) {
    die("Koneksi gagal: " . $db->connect_error);
}

if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];
    

    
    $check_email_query = "SELECT * FROM users WHERE email = '$email'";
    $result = $db->query($check_email_query);
    if ($result->num_rows > 0) {
        $register_error = "Email sudah terdaftar. Silakan gunakan email lain.";
    } else if ($pass !== $cpass) {
        $register_error = "Password tidak cocok. Silakan coba lagi.";
    } else {
       
        $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

      
        
        $stmt = $db->prepare("INSERT INTO users (first_name, last_name, email, nomor_telepon, password, gender, birthdate) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $fname, $lname, $email, $number, $hashed_password, $gender, $birthdate);

        if ($stmt->execute()) {
            header('Location: login.php');
            exit();
        } else {
            $register_error = "Registrasi gagal. Silakan coba lagi.";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>


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
        
    </style>
    <style>
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

   <form action="register.php" method="post">
      <h3>Sign Up now</h3>
      <input type="text" name="fname" required placeholder="enter your first name" class="box" maxlength="50">
      <input type="text" name="lname" required placeholder="enter your last name" class="box" maxlength="50">
      <input type="email" name="email" required placeholder="enter your email" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="number" name="number" required placeholder="enter your number" class="box" maxlength="10">
      <input type="password" name="pass" required placeholder="enter your password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" required placeholder="confirm your password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <label for="gender">Gender:</label>
      <select name="gender" id="gender" required class="box">
        <option value="male">Male</option>
        <option value="female">Female</option>
      </select>
      <label for="birthdate">Birthdate:</label>
      <input type="date" name="birthdate" class="box">
      <input type="submit" value="sign up now" name="submit" class="btn">
      <p><?php if (isset($register_error)) { echo $register_error; } ?></p>
      <p>already have an account? <a href="login.php">login now</a></p>
   </form>
</section>
</body>
</html>

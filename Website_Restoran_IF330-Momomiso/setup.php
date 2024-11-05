<?php

$db = new mysqli("localhost", "root", "", "restaurant");

if ($db->connect_error) {
    die("Koneksi gagal: " . $db->connect_error);
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];

   
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

    $stmt = $db->prepare("INSERT INTO admins (email, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $hashed_password);

    if ($stmt->execute()) {
        header('Location: login.php');
        exit();
    } else {
        $register_error = "Registrasi gagal. Silakan coba lagi.";
    }

    $stmt->close();
    
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
   

 
   <link rel="stylesheet" href="style.css">

</head>
<body>

<section class="form-container">

   <form action="setup.php" method="post">
      <h3>Setup Admin</h3>
      <input type="email" name="email" required placeholder="enter your email" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="enter your password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="Set Admin Data" name="submit" class="btn">
      <p>already have an account? <a href="login.php">login now</a></p>
   </form>
   <?php if (isset($register_error)) : ?>
        <p><?php echo $register_error; ?></p>
    <?php endif; ?>
</section>
</body>
</html>

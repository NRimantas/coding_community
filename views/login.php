<?php
require_once("../data_connection.php");
session_start();
// include './layouts/header.php';

$username="";

if(isset($_SESSION['username'])){
  $username=$_SESSION['username'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LOG IN</title>
  <!-- FONTS -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500&display=swap" rel="stylesheet">
  <!-- Bootsratp -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <link rel="stylesheet" href="../dist/css/login.css">
</head>

<body>
  <!-- -------- NAV MENU ---------------- -->

  <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
    <div class="container-fluid">
     <!-- Name -->
     <a class="navbar-brand" href="http://localhost/php/practiceFormPHP/index.php">C O D I N G <span>'<p>'</span> <span style="color:#89230d;"> C O M M U N I T Y</span></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="../registerPage.php">Register</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="http://localhost/php/practiceFormPHP/views/login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="http://localhost/php/practiceFormPHP/scripts/logout.php">Log Out</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- ----------- LOG IN FORM ---------- -->

  <div class="mainContainer">
    <div class="registrationForm">
      <p>CODING COMMUNITY IS WAITING FOR YOU!</p>
      <h5>Please Log IN </h5>
      <!-- PLACE FOR input errors -->
      <div>
        <ul>
          <?php 
            if(isset($_SESSION['login_errors'])){
              $errors=$_SESSION['login_errors'];
              foreach($errors as $error){
                echo "<li style='list-style-type: none; color: #89230d;'>$error</li>";
              }
            }
          ?>
        </ul>
      </div>
      <i class="fa-solid fa-computer-classic"></i>
      <div class="container py-4">
        <div class="row justify-content-center">
          <div class="col-md-8">

            <!-- FORM to script -->
            <form action="../scripts/loginScript.php" method="POST">
              <div class="form-floating my-2">
                <input type="text" name="username" class="form-control" value="<?php echo $username;?>">
                <label for="username">Username</label>
              </div>
              <div class="form-floating my-2">
                <input type="password" name="password" class="form-control">
                <label for="password">Password</label>
              </div>
              <button type="submit" class="btn btn-lg btn-secondary">Log In</button>
            </form>
            <!-- link to register -->
            <div class="regLink">
              <a href="http://localhost/php/practiceFormPHP/registerPage.php">Don't have an account? Register here...</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


</body>

</html>
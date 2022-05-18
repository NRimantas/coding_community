<?php

session_start();
require_once("../data_connection.php");

if (!isset($_SESSION['username'])) {
  header("Location: login.php");
}

try {
  $sql = "SELECT * FROM users";
  $query = $conn->prepare($sql);
  $query->execute();
  $result = $query->fetchAll();

} catch (PDOException $e) {
  echo "Select failed: " . $e->getMessage();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>USERS</title>
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- FONTS -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500&display=swap" rel="stylesheet">

</head>

<body class="bg-light;" style='text-align:center;'>

  <!-- ---------------------NAV BAR ----------------- -->

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
            <a class="nav-link " style=" font-size: 18px;" aria-current="page" href="../views/userTable.php">Users</a>
          </li>
          <li class="nav-item">
            <a class="nav-link  " style=" font-size: 18px;" href="http://localhost/php/practiceFormPHP/views/forum.php">Forum</a>
          </li>
         
        </ul>
      </div>
      <a style=" font-size: 18px;
    color: black; text-decoration: none;" href="http://localhost/php/practiceFormPHP/views/login.php">Log Out</a>
    </div>
  </nav>


  <!-- ------------ USERS TABLE ------------ -->
  <h4>Hello, <?php echo $_SESSION['username']; ?> !</h4>
  <table class="table table-striped">
    
    <tr>
      <th>ID</th>
      <th>Username</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Created</th>
      <th>Last modified</th>
      <th>Update/Delete</th>
    </tr>
    <?php
    foreach ($result as $user) {
      echo "<tr>
            <td>" . $user['user_id'] . "</td>
            <td>" . $user['username'] . "</td>
            <td>" . $user['first_name'] . "</td>
            <td>" . $user['last_name'] . "</td>
            <td>" . $user['created'] . "</td>
            <td>" . $user['last_modified'] . "</td>";

    ?>
      <!-- ----------UPDATE USER,  DELETE USER,  CREATE POST------------ -->
      <td>
        <a class="btn btn-outline-info" href="../views/user_update.php?userid=<?php echo $user['user_id']; ?>">Update</a>
        <a class="btn btn-outline-danger" href="../scripts/user_delete.php?userid=<?php echo $user['user_id']; ?>">Delete</a>

      </td>
      </tr>

    <?php

    }
    ?>
  </table>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>
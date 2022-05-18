<?php
require_once("../data_connection.php");
session_start();
$user= $_SESSION['userid'];

if(!isset($_SESSION['username'])){
    header("Location: login.php");
}

// SELECTING ALL USER
if($_GET){
    try{
        $userid=$_GET['userid'];
        $sql="SELECT * FROM users WHERE user_id='$userid'";
        $query=$conn->prepare($sql);
        $query->execute();
        $result=$query->fetch();
        
    }catch(PDOException $e){
        echo "Select failed: ".$e->getMessage();    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USER EDIT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/login.css">
</head>

<body>

<!-- Size correction -->
    <style>
        .registrationForm{
       height: 450px;   
}
    </style>

    <!-- ------------------- NAV BAR -------------------- -->

<nav class="navbar navbar-expand-lg navbar-light bg-secondary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">CODDING COMMUNITY</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">        
        <li class="nav-item">
            <a class="nav-link" href="http://localhost/php/practiceFormPHP/views/login.php">Log Out</a>
        </li>
       
      </ul>
    </div>
  </div>
</nav>

    <!-- ----------------------- EDITING USER --------------- -->

    <div class="mainContainer">
        <div class="registrationForm">
            <p>CODING COMMUNITY IS WAITING FOR YOU!</p>
            <h5>Please Edit Selected User: </h5>
            <i class="fa-solid fa-computer-classic"></i>
            <div class="container py-4">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <form action="../scripts/user_update.php" method="POST">
                        <div class="form-floating my-2">
                                <input type="text" name="username" class="form-control" required value="<?php echo $result['username'];?>">
                                <label for="username">Username</label>
                            </div>
                            <div class="form-floating my-2">
                                <input type="text" name="first_name" class="form-control" required value="<?php echo $result['first_name'];?>">
                                <label for="first_name">First Name</label>
                            </div>
                            <div class="form-floating my-2">
                                <input type="text" name="last_name" class="form-control" required value="<?php echo $result['last_name'];?>">
                                <label for="last_name">Last Name</label>
                            </div>
                            <div class="form-floating my-2">
                                <input type="email" class="form-control" name="email" required value="<?php echo $result['email'];?>">
                                <label for="email">Email</label>
                            </div> 
                            <input type="hidden" name='userid'  value="<?php echo $result['user_id'];?>">                       
                            <button type="submit" class="btn btn-lg btn-secondary">EDIT</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


</body>

</html>

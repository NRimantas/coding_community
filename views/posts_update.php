<?php
require_once("../data_connection.php");
session_start();

if(!isset($_SESSION['username'])){
    header("Location: login.php");
}

$userid=$_SESSION['userid'];
// SELECTING ALL POSTS FROM DB
if($_GET){
    try{
        $posts=$_GET['postsid'];            
        
        $sql="SELECT * FROM posts WHERE posts_id='$posts'";
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
    <title>WRITE POST</title>
    <link rel="stylesheet" href="../css/posts.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body>
    <!-- NAV BAR -->

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
                        <a class="nav-link " aria-current="page" href="../views/userTable.php">Users</a>
                    </li>                   
                    <li class="nav-item ">
                        <a class="nav-link " href="http://localhost/php/practiceFormPHP/views/forum.php">Forum</a>
                    </li>
                    <li class="nav-item">                        
                    </li>
                </ul>
            </div>
            <a style="text-decoration: none; color:black;" href="http://localhost/php/practiceFormPHP/views/login.php">Log Out</a>
        </div>
    </nav>

    <!-- ----------- EDITING POST  -->
    <div class="postContainer">
        <form action="../scripts/posts_update.php" method="POST">
            <div class="form-floating">
                
                <input type="text" name="posts" class="form-control" required value="<?php echo $result['posts'];?>">
                <label for="posts">EDIT your post...</label>

            </div>
            <!-- -------- SENDING POST ID WITH HIDDEN INPUT --------------- -->
            <input type="hidden" name='postsid'  value="<?php echo $result['posts_id'];?>">  
            <button type="submit" class="btn btn-lg btn-secondary">EDIT</button>
        </form>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>
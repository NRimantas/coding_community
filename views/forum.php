<?php
session_start();
require_once("../data_connection.php");
$userid = $_SESSION['userid'];



if (!isset($_SESSION['username'])) {
     header("Location: ../views/posts.php");
}

// Sorting by likes

try {

     if (isset($_POST['sortedDesc'])) {
          $sql = "SELECT   posts, posts.created, posts.posts_id, posts.user_id,  username, posts.likes FROM posts INNER JOIN users ON users.user_id=posts.user_id ORDER BY likes DESC
          ";
          $query = $conn->prepare($sql);
          $query->execute();
          $result = $query->fetchAll();
     } else {
          $sql = "SELECT   posts, posts.created, posts.posts_id, posts.user_id,  username, posts.likes FROM posts INNER JOIN users ON users.user_id=posts.user_id ORDER BY created DESC
          ";
          $query = $conn->prepare($sql);
          $query->execute();
          $result = $query->fetchAll();
     }
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
     <title>FORUM</title>
     <!-- FONTS -->
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500&display=swap" rel="stylesheet">
     <!-- CSS Only -->
     <link rel="stylesheet" href="../dist/css/forum.css">
     <!-- Bootstrap -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
     <!-- Fontawesom -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">

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
                         <li class="nav-item">
                              <a class="nav-link  " href="http://localhost/php/practiceFormPHP/views/forum.php">Forum</a>
                         </li>
                    </ul>
               </div>
               <a style="text-decoration: none; color:black;" href="http://localhost/php/practiceFormPHP/views/login.php">Log Out</a>
          </div>
     </nav>

     <!-- FORUM POSTS -->
     <div class="mainBox">
          <div class="forumBox">
               <div class="forumHeader">
                    <div class="iconBox">
                         <i class="fa-solid fa-comment"></i>
                    </div>
                    <span>
                         <h3>B R A I N S T O R M I N G</h3>
                    </span>
                    <!-- ----------- WRITTING POST  -->
                    <div class="postContainer">
                         <form action="../scripts/posts.php" method="POST">
                              <div class="form-floating">
                                   <input type="text" name="posts" placeholder="Write something..." required value="">
                                   <!-- <label for="posts">Write something...</label> -->
                              </div>
                              <!-- -------- SENDING ID WITH HIDDEN INPUT --------------- -->
                              <input type="hidden" name='userid' value="<?php echo $userid; ?>">
                              <button type="submit" class="btn btn-md btn-secondary">POST</button>
                         </form>
                    </div>
               </div>
               <!-- TABLE  -->
               <table class="table table-dark table-striped " >
                    <thead>
                         <tr>
                              <th scope="col">POST</th>
                              <th>UserName</th>
                              <th></th>
                              <th>
                                   <form action="" method="POST">
                                        <button type="submit" name="sortedDesc" class="btn btn-sm btn-secondary">Sort By Likes</button>
                                        <button type="submit" name="nonSorted" class="btn btn-sm btn-secondary">Unsort</button>
                                   </form>
                              </th>
                         </tr>
                    </thead>
                    <tbody>
                         <?php
                         foreach ($result as $post) {
                              echo "<tr>                                   
                                             <td>" . $post['posts'] . "</td>
                                             <td><p>" . $post['username'] . "</p>" . $post['created'] . "</td>                                                                                        
                                             ";
                         ?>
                              <td>
                                   <!--   logged username update delete his own posts-->
                                   <?php
                                   if ($userid == $post['user_id']) {
                                        echo "<a class='btn btn-outline-danger' href='../scripts/posts_delete.php?postsid=" . $post['posts_id'] . "';?>Delete</a>
                                        <a class='btn btn-outline-warning' href='../views/posts_update.php?postsid=" . $post['posts_id'] . "';?>EDIT</a>";
                                   }
                                   ?>
                              </td>
                              <!-- sendind post id to post scripts -->
                              <td>
                                   <a class="btn btn-outline-light" href="../scripts/posts_likes.php?postsid=<?php echo $post['posts_id']; ?>"> Likes (<?php echo $post['likes']; ?>) </a>
                              </td>
                              </tr>
                         <?php
                         }
                         ?>
                    </tbody>
               </table>
          </div>
     </div>

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>
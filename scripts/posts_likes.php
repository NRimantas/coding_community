<?php 
    session_start();
    require_once("../data_connection.php"); 
       

    if($_GET){
        
             $userid=$_SESSION['userid'];
             $postsid=$_GET['postsid'];        
            
       
        // selecting all data from DB abaut posts
        try {
            $postsData = "SELECT * FROM posts WHERE posts_id = $postsid";
            $queryPosts = $conn->prepare($postsData);
            $queryPosts->execute();
            $postsResult = $queryPosts->fetch();
        } catch (PDOException $e) {
            echo 'Select failed: '.$e->getMessage();
        }
        
        // selecting all data from DB about likes
        try {
            $likesData = "SELECT * FROM posts_likes WHERE posts_id = $postsid AND user_id = $userid";
            $queryLikes = $conn->prepare($likesData);
            $queryLikes->execute();
            $likesResult = $queryLikes->fetch();
        } catch (PDOException $e) {
            echo 'Select failed: '.$e->getMessage();
        }
        
        // if match, like or unlike 
        
        if ($likesResult) {
            $unlike = $postsResult['likes'] - 1;
            $unlike_update = "UPDATE posts SET likes = '$unlike' WHERE posts_id = $postsid";
            $queryUnlike = $conn->prepare($unlike_update);
            $queryUnlike->execute();
            $delete = "DELETE FROM posts_likes WHERE posts_id = '$postsid' AND user_id = '$userid'";
            $queryDelete = $conn->prepare($delete);
            $queryDelete->execute();
           
            header("Location: http://localhost/php/practiceFormPHP/views/forum.php");

        } else {
            $like = $postsResult['likes'] + 1;
            $like_update = "UPDATE posts SET likes = '$like' WHERE posts_id = $postsid";
            $queryLike = $conn->prepare($like_update);
            $queryLike->execute();
            $sql = "INSERT INTO posts_likes (posts_id, user_id) VALUES ('$postsid', '$userid')";
            $queryInsert = $conn->prepare($sql);
            $queryInsert->execute();
            
            header("Location: http://localhost/php/practiceFormPHP/views/forum.php");
            
        }
        

    }else{
        header("Location: http://localhost/php/practiceFormPHP/views/forum.php");
    }
    



?>
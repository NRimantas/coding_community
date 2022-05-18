<?php 
    session_start();
    require_once("../data_connection.php");
    
//    Inesrting writted post to posts table

    if($_POST){
        try{           
            
            $_SESSION['posts']=$_POST['posts'];
            $posts=$_SESSION['posts'];
            $userid=$_POST['userid'];                   

            $sql="INSERT INTO posts (posts, user_id) VALUES ('$posts', '$userid')";
            $query=$conn->prepare($sql);
            $query->execute();
            header("Location: ../views/forum.php");

        }catch(PDOException $e){
            echo "Create failed: ".$e->getMessage();
        }
    }else{
        header("Location: ../views/posts.php");
    }


?>
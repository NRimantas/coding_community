<?php 
    
    session_start();
    require_once("../data_connection.php");

    // updating posts to DB

    if($_POST){
        try{
            $postsid=$_POST['postsid'];
           $posts=$_POST['posts'];           

            $sql="UPDATE posts SET posts='$posts' WHERE posts_id='$postsid'";
            $query=$conn->prepare($sql);
            $result=$query->execute();
            var_dump($result);

            if($result){
                header("Location: ../views/forum.php");
            }
        }catch(PDOException $e){
            echo "Update failed: ".$e->getMessage();
        }
    }else{
        header("Location: ../");
    }
     



?>
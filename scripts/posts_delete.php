<?php 

session_start();
require_once("../data_connection.php");

$userid=$_SESSION['userid'];

if(!isset($userid)){
    header("Location: forum.php");
}

// user deleting query

if($_GET){
    try{
        $posts=$_GET['postsid'];
        var_dump($posts);
        $sql="DELETE FROM posts WHERE posts_id='$posts'";
        $query=$conn->prepare($sql);
        $result=$query->execute();
 
        if($result){
            header("Location: ../views/forum.php");
        }

    }catch(PDOException $e){
        echo "Delete failed: ".$e->getMessage();
    }
}else{
    header("Location: ../");
}

?>
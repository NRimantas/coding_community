<?php 
    session_start();
    require_once '../data_connection.php';
    $user= $_SESSION['userid'];

    if(!isset($_SESSION['username'])){
        header("Location: login.php");
    }

// deleting users from DB
    if($_GET){
        try{
            $userid=$_GET['userid'];
            $sql="DELETE FROM users WHERE user_id='$userid'";
            $query=$conn->prepare($sql);
            $result=$query->execute();
         
            if($result){
                header("Location: ../views/userTable.php");
            }

        }catch(PDOException $e){
            echo "Delete failed: ".$e->getMessage();
        }
    }else{
        header("Location: ../");
    }


?>
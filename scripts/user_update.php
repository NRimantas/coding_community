<?php 
    
    session_start();
    require_once("../data_connection.php");


// Updating users data to DB

    if($_POST){
        try{
            $userid=$_POST['userid'];
            $username=$_POST['username'];
            $first_name=$_POST['first_name'];
            $last_name=$_POST['last_name'];
            $email=$_POST['email'];

            $sql="UPDATE users SET username='$username', first_name='$first_name', last_name='$last_name', email='$email' WHERE user_id='$userid'";
            $query=$conn->prepare($sql);
            $result=$query->execute();
 
            if($result){
                header("Location: ../views/userTable.php");
            }
        }catch(PDOException $e){
            echo "Update failed: ".$e->getMessage();
        }
    }else{
        header("Location: ../");
    }
     



?>
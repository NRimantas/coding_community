<?php

session_start();

// creating array for errors
$_SESSION['login_errors'] = [];

require_once("../data_connection.php");

if (!$_POST) {
    header("Location: ../views/login.php");
}

// checking if getting data from POST
if ($_POST) {
    $_SESSION['username'] = $username = $_POST["username"];
    $password = $_POST["password"];



    // checking if inputs are empty, if empty, getting error

    if ($username == "") {
        array_push($_SESSION['login_errors'], "Please enter your Username!");
        header("Location: ../views/login.php");
        die;
    }

    if ($password == "") {
        array_push($_SESSION['login_errors'], "Please enter password!");
        header("Location: ../views/login.php");
        die;
    }

    //getting data from users table
    try {
        $sql = "SELECT * FROM users";
        $query = $conn->prepare($sql);
        $query->execute();
        $users = $query->fetchAll();
    } catch (PDOException $e) {
        echo "Select failed: " . $e->getMessage();
    }

    // cheking does username exists
    $username_exists = 0;

    foreach($users as $user){
        if(array_search($username, $user)){
            $username_exists+=1;
        }
    }

    if($username_exists===0){
        array_push($_SESSION['login_errors'], "Username does not exists!");
        header("Location: ../views/login.php");
        die;
    }

//    checking if login username is in DB and if password is correct
    foreach ($users as $user) {
        if ($user['username'] == $username) {
            $dbPasswordHash = $user['password'];

            if (password_verify($password, $dbPasswordHash)) {
                $_SESSION['username'] = $user['username'];
                $_SESSION['userid'] = $user['user_id'];

               
               header("Location: http://localhost/php/practiceFormPHP/views/userTable.php");
            }else{
                array_push($_SESSION['login_errors'], "Incorrect password, please try again!");
            header("Location: ../views/login.php");
            die;
            }
        }
    }
}

if(!empty($_SESSION['login_errors'])){
    header("Location: ../views/login.php");
}

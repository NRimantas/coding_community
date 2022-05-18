<?php

require_once("../data_connection.php");
session_start();
// Creating an error aray

$_SESSION['register_errors'] = [];


if ($_POST) {
  $_SESSION['username'] = $username = $_POST['username'];
  $_SESSION['first_name'] = $first_name = $_POST['first_name'];
  $_SESSION['last_name'] = $last_name = $_POST['last_name'];
  $_SESSION['email'] = $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirmPassword'];


  // checking if empty input, if empty, getting error
  
  if (($username=="" || $first_name=="" || $last_name=="" || $email=="" || $password=="" || $confirmPassword=="")) {
    array_push($_SESSION['register_errors'], "Please fill all fields!");
    
    header("Location: http://localhost/php/practiceFormPHP/registerPage.php");
    die;
  } 

  // cheking if registration username and email exists in DB

  try{
    $sqlUsers="SELECT email, username FROM users";
    $queryUsers=$conn->prepare($sqlUsers);
    $queryUsers->execute();
    $usersArray=$queryUsers->fetchAll();
  }catch(PDOException $e){
    echo "Select users failed: ".$e->getMessage();
  }

  $user_exists = 0;
  foreach($usersArray as $user){
    if(array_search($username, $user)){
      $user_exists+=1;
    }
  }

  if($user_exists === 1){
    array_push($_SESSION['register_errors'], "Username already exists!");
    header("Location: ../registerPage.php");
        die;
  }

  $email_exists = 0;
  foreach($usersArray as $user){
    if(array_search($email, $user)){
      $email_exists+=1;
    }
  }

  if($email_exists === 1){
    array_push($_SESSION['register_errors'], "Email already exists!");
    header("Location: ../registerPage.php");
        die;
  }

  // pasword hash

  if ($password == $confirmPassword) {
    $password = password_hash($password, PASSWORD_BCRYPT);
  } else {
    array_push($_SESSION['register_errors'], "Password is incorrect!");
var_dump($_SESSION['register_errors']);
    header("Location: http://localhost/php/practiceFormPHP/registerPage.php");
    die;
  }

  // inserting users data to DB

  try {
    $sql = "INSERT INTO users (username, first_name, last_name, email, password) VALUES ('$username','$first_name', '$last_name','$email', '$password')";
    $query = $conn->prepare($sql);
    $query->execute();
    header("Location: ../views/login.php");

  } catch (PDOException $e) {
    echo "Insert field: " . $e->getMessage();
  }


  

  

}

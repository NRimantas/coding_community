<?php 

include '../practiceFormPHP/layouts/header.php';
require_once("./data_connection.php");




// when something did not inputted, will leave writted values in inputs
$username = $first_name = $last_name = $email = "";

if (isset($_SESSION['username']) && isset($_SESSION['first_name']) && isset($_SESSION['last_name']) && isset($_SESSION['email'])) {
    $username = $_SESSION['username'];
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
   
}

?>

<div class="mainContainer">

<!-- Registration field---- -->
        
        <div class="registrationForm">
            <p>CODING COMMUNITY IS WAITING FOR YOU!</p>
            <h5>Please fill registration form </h5>
            <i class="fa-solid fa-computer-classic"></i>
            <div class="container py-4">

                <div>
                    <ul>
                      
                    <?php 
                        // var_dump($_SESSION['register_errors']);
                        if (isset($_SESSION['register_errors'])) {

                            $errors = $_SESSION['register_errors'];
                            foreach ($errors as $error) {
                                echo "<li style='list-style-type: none; color: #89230d;'>$error</li>";
                                
                            }
                            $_SESSION['register_errors'] = [];
                            
                          }

                    ?>
                    </ul>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-8">

                        <!-- FORM TO SCRIPTS -->
                    
                        <form action="http://localhost/php/practiceFormPHP/scripts/register_data.php" method="POST">
                            <div class="form-floating my-2">
                                <input type="text"  name="username" value="<?php echo $username;?>" class="form-control">
                                <label for="username">Username</label>
                            </div>
                            <div class="form-floating my-2">
                                <input type="text" name="first_name" value="<?php echo $first_name;?>" class="form-control" >
                                <label for="first_name">First Name</label>
                            </div>
                            <div class="form-floating my-2">
                                <input type="text" name="last_name" value="<?php echo $last_name;?>" class="form-control" >
                                <label for="last_name">Last Name</label>
                            </div>
                            <div class="form-floating my-2">
                                <input type="email" class="form-control" name="email" value="<?php echo $email;?>">
                                <label for="email">Email</label>
                            </div>
                            <div class="form-floating my-2">
                                <input type="password" name="password" class="form-control">
                                <label for="password">Password</label>
                            </div>
                            <div class="form-floating my-2">

                                <input type="password" name="confirmPassword" class="form-control" >
                                <span class="badge bg-danger"></span>
                                <label for="confirmPassword">Confirm Password</label>
                            </div>
                            <button type="submit" class="btn btn-lg btn-secondary">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php 

    include '../practiceFormPHP/layouts/footer.php';

?>
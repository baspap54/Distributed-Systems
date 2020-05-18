<?php
    // Initialize the session
    session_start();
 
    // Check if the user is already logged in, if yes then redirect him to welcome page
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: welcome.php");
        exit;
    }
 
    // Include config file
    require_once "config.php";
    //bill 16/5
    //require_once "Role.php";
    //require_once "PrivilegedUser.php";
    // Define variables and initialize with empty values
    $userName = "";
    $password = "";
    $userNameErr = "";
    $passwordErr = "";


    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        // Check if username is empty
        if(empty(trim($_POST["userName"]))){
            $userNameErr = "Please enter username.";
        } else{
            $userName = trim($_POST["userName"]);
        }

        // Check if password is empty
        if(empty(trim($_POST["password"]))){
            $passwordErr = "Please enter your password.";
        } else{
            $password = trim($_POST["password"]);
        }

        // Validate credentials
        if(empty($userNameErr) && empty($passwordErr)){
            // Prepare a select statement
            $sql = "SELECT id, userName, password FROM usertable WHERE userName = ?";

            if($stmt = mysqli_prepare($conn, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_username);

                // Set parameters
                $param_username = $userName;

                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Store result
                    mysqli_stmt_store_result($stmt);

                    // Check if username exists, if yes then verify password
                    if(mysqli_stmt_num_rows($stmt) == 1){                    
                        // Bind result variables
                        mysqli_stmt_bind_result($stmt, $id, $userName, $hashed_password);
                        if(mysqli_stmt_fetch($stmt)){
                            if(password_verify($password, $hashed_password)){
                                // Password is correct, so start a new session
                                session_start();

                                // Store data in session variables
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["userName"] = $userName;      

                                // Redirect user to welcome page
                                header("location: welcome.php");
                            } else{
                                // Display an error message if password is not valid
                                $passwordErr = "The password you entered was not valid.";
                            }
                        }
                    } else{
                        // Display an error message if username doesn't exist
                        $userNameErr = "No account found with that username.";
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close statement
                mysqli_stmt_close($stmt);
            }
        }

        // Close connection
        mysqli_close($conn);
    }
?>

<!DOCTYPE html>
<html lang="en">
    
    <head>
        <title>Bored Games</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
              
    <body>
        <h0>Bored Games</h0>
       
        <div class="form">
            
            <img src="avatar.png" class="avatar">
            
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <h1>Log In</h1>
                
                <p>Username</p>
                <input type="text" class="form-control" value="<?php echo $userName; ?>" name="userName" placeholder="Enter Username">
                <span class="help-block">
                    <?php 
                        $Color = "red"; 
                        echo '<div style="Color:'.$Color.'">'.$userNameErr.'</div>'; 
                    ?>
                </span>
                
                <p>Password</p>
                <input type="password" class="form-control" value="<?php echo $password; ?>" name="password" placeholder="Enter Password">
                <span class="help-block">
                    <?php 
                        $Color = "red"; 
                        echo '<div style="Color:'.$Color.'">'.$passwordErr.'</div>'; 
                    ?>
                </span>
                
                <button>Log In</button>
                <div class="space">
                    <a href="#">Lost your password?</a><br> 
                    <p class="message">Not Registered? <a href="register.php">Register</a></p>
                </div>
            </form>

        </div>        
        
    </body>
    
</html>

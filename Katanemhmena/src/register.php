<?php
    // Include config file
    require_once "config.php";
    $userName = "";
    $password = "";
    $userNameErr = "";
    $passwordErr = "";
    //bill 15/5
    $role_id = 1;
    $role_name = "";
    $perm_id  = "";

    // Processing form data when form is submitted
 if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Validate username
        if(empty(trim($_POST["userName"]))){
            $userNameErr = "Please enter a username.";
        } else{
            // Prepare a select statement
            $sql = "SELECT id FROM usertable WHERE userName = ?";

            if($stmt = mysqli_prepare($conn, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_username);

                // Set parameters
                $param_username = trim($_POST["userName"]);

                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    /* store result */
                    mysqli_stmt_store_result($stmt);

                    if(mysqli_stmt_num_rows($stmt) == 1){
                        $userNameErr = "This username is already taken.";
                    } else{
                        $userName = trim($_POST["userName"]);
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
        // Validate password
        if(empty(trim($_POST["password"]))){
            $passwordErr = "Please enter a password.";     
        } elseif(strlen(trim($_POST["password"])) < 6){
            $passwordErr = "Password must have atleast 6 characters.";
        } else{
            $password = trim($_POST["password"]);
            
            }
        // Check input errors before inserting in database
        if(empty($userNameErr) && empty($passwordErr)){
            $sql = "INSERT INTO user_role (id, role_id) VALUES (?,?)";
            if($stmt = mysqli_prepare($conn, $sql)){
                    // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ii", $param_id, $param_role_id);

                $result = mysqli_query($conn, "SELECT id FROM usertable where userName = $userName");
		        $param_id = $result;
		        $param_role_id = 1;
		        mysqli_stmt_execute($stmt);
		        mysqli_stmt_close($stmt);
         
            }
             
           
            // Prepare an insert statement
            $sql = "INSERT INTO usertable (userName, password) VALUES (?, ?)";

            if($stmt = mysqli_prepare($conn, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

                // Set parameters
                $param_username = $userName;
                $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
                if(mysqli_stmt_execute($stmt)){
                    // Redirect to login page   
                    $sql = "INSERT INTO user_role (id, role_id) VALUES (?,?)";
                    if($stmt = mysqli_prepare($conn, $sql)){
                        // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt, "ii", $param_id, $param_role_id);

                        //$result = mysqli_query($conn, "SELECT id FROM usertable where userName = $userName");
		                $param_id = 1;
		                $param_role_id = 1;
		                if(mysqli_stmt_execute($stmt)){
                        // Redirect to login page   
                        header("location: login.php");             
                        } else{
                        echo "Something went wrong. Please try again later.";
                        }
		                mysqli_stmt_close($stmt);          
                }   }
                
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
                <h1>Sign Up</h1>
                
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
                
                <button>Sign Up</button>
                <div class="space">
                    <a href="#">Lost your password?</a><br>               
                    <p class="message">Already Registered? <a href="login.php">Login</a></p>
                </div>    
            </form>   
        </div>     
    </body>  
</html>

<?php
class User
{
   session_start();
 
    // Check if the user is already logged in, if yes then redirect him to welcome page
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: welcome.php");
        exit;
    }
 
    // Include config file


    $userName = "";
    $password = "";
    $userNameErr = "";
    $passwordErr = "";


    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){


        // Validate credentials
        if(empty($userNameErr) && empty($passwordErr)){
           
                                session_start();

                                // Store data in session variables
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["userName"] = $userName;      
        }
}
?>
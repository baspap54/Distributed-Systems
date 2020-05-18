<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Bored Games</title>
        <link rel="stylesheet" type="text/css">
        <style>
            
        body{
            margin: 0;
            padding: 0;
            background: url(background.jpg);
            background-size: cover;
            background-position:top;
            font-family:cursive;
        }
            
        .formm{
            position: fixed;
            width:  100%;
            height: 10%;
            background-color: hsla(556, 50%, 25%, 0.3);   
            
        }  

        h0{
            position: relative;
            top:15%;
            transform: translate(-50%,-50%);
            box-sizing: content-box;
            padding: 10px 20px;
            margin: auto;  
            color: #fff;
            font-size: 40px;
            font-style: normal;
            text-align: center;
        }     
            
        .profile_button {
            position:relative;
            top:15%;
            left: 20%;
            background-color: hsla(556, 50%, 25%, 0.9);
            border-radius: 4px;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
            color: #fff;
            padding: 11px 50px;
            text-decoration: none;
            font-family: serif;
            font-size: larger;
        }          
        .profile_button:hover{
            cursor: pointer;
            background:  #5F9EC9;
            color: #000;
        }
            
        .gallery_button {
            position: relative;
            top:15%;
            left: 21%;
            background-color: hsla(556, 50%, 25%, 0.9);
            border-radius: 4px;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
            color: #fff;
            text-decoration: none;
            padding: 11px 50px;
            font-family: serif;
            font-size: larger;
        }         
        .gallery_button:hover{
            cursor: pointer;
            background:  #5F9EC9;
            color: #000;
        }
            
        .friends_button {
            position: relative;
            top:15%;
            left: 22%;
            background-color: hsla(556, 50%, 25%, 0.9);
            border-radius: 4px;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
            color: #fff;
            padding: 11px 50px;
            text-decoration: none;     
            font-family: serif;
            font-size: larger;
        }          
        .friends_button:hover{
            cursor: pointer;
            background:  #5F9EC9;
            color: #000;
        }
            
        .logout_button {
            position:relative;
            top:15%;
            left: 51%;
            background-color: hsla(556, 50%, 25%, 0.9);
            border-radius: 4px;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
            color: #fff;
            padding: 7px 10px;
            text-decoration: none;
            font-family: sans-serif;
        }        
        .logout_button:hover{
            cursor: pointer;
            background:  #5F9EC9;
            color: #000;
        }         
                        
        .user_name{
            position: relative;
            top: 1000px;
            color: #fff;      
            font-family:monospace;
        }
            
        </style>    
    </head>

    <body>
        
        
        <div class="formm">
            
            <h0>Bored Games</h0>
        
            <a style="font-size: 28px;" class="profile_button" href="welcome.php">Profile</a>
            <a style="font-size: 28px;" class="gallery_button" href="welcome.php">Gallery</a>
            <a style="font-size: 28px;" class="friends_button" href="welcome.php">Friends</a>
            
            <a class="logout_button" href="logout.php">Log Out</a>
            
            
     
        </div>
        
        <div class="user_name">
            <h1 style="font-size: 18px;"> User name: <b><?php echo htmlspecialchars($_SESSION["userName"]); ?></b> </h1>
        </div>
        
        
        
        
    </body>
</html>


<?php
    $userName = $_POST['userName'];
    $password = $_POST['password'];

    //Database connection
    $conn = new mysqli('db','root','example','my_db');
    if($conn->connect_error){
        die('Connection Failed : '.$conn->connect_error);
    }else{
        $stmt = $conn->prepare("insert into registration(userName, password)
            values(?, ?)");
        $stmt->bind_param("ss", $userName, $password);
        $stmt->execute();
        echo "registration Successfully.......";
        $stmt->close();
        $conn->close();
    }
?>

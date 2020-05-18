<?php 
 /* Database credentials. Assuming you are running MySQL
    server with default setting (user 'root' with no password) */
define('DB_SERVER', 'db'); // service name from docker-compose.yml
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'example');
define('DB_NAME', 'my_db');

/* Attempt to connect to MySQL database */
$conn = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);

if($conn->connect_error){
    echo 'connection failed' . $conn->connect_error;
    exit;
}
?>
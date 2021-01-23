<?php

$username = $_SERVER['PHP_AUTH_USER'];

$database  = "jmas"; 
$user      = "WWDGRemote";    
$password  = "QpVH.,urpiAm8JX8";
$servername      = "localhost";

// Create connection
$conn = mysqli_connect($servername, $user, $password, $database);
// Check connection
if (!$conn) { 
    die("Error:  Connection failed: " . mysqli_connect_error());
}


// if we had a post, then we're making changes to the DB

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

     $id = isset($_GET['id']) ? $_GET['id'] : '';
     $value = isset($_GET['value']) ? $_GET['value'] : '';

    $sql ="UPDATE challenges SET include = " . $value . " WHERE id= " . $id ;
    $result = mysqli_query($conn, $sql);
     if ($result) {
         echo "Value changed!<br>";
     } else {
        echo mysqli_error($conn);
    }
}

 header("Location: ./jmas_entry.php");
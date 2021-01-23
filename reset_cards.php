<?php

// The purose of this is to clear associations between the
// challenges and the deck of cards that the players pull

// this allows us to delete unwanted challenges

$username = $_SERVER['PHP_AUTH_USER'];

$database  = "jmas"; 
$user      = "WWDGRemote";    
$password  = "QpVH.,urpiAm8JX8";
$servername      = "localhost";


if ($username != "raul") { 
    die("GURU MEDITATION 09909");
}

// Create connection
$conn = mysqli_connect($servername, $user, $password, $database);
// Check connection
if (!$conn) { 
    die("Error:  Connection failed: " . mysqli_connect_error());
}

// Do the query
$query = "UPDATE jmas.deck SET challenge=1, used = 0"; 
$result = mysqli_query($conn, $query);
         if ($result) {
             echo "Reset!<br>";
         } else {
            echo mysqli_error($conn);
        }


header("Location: ./admin.php");
?>

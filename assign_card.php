<?php
// load our functions
include("functions.php");



// Connect to the DB
include("connect.php");
$username = $_SERVER['PHP_AUTH_USER'];
$display_name = display_name_for($username);


if ($username != "raul") {
    die("Oops...");
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     // The request is using the POST method
     $card_value = isset($_POST['card_value']) ? $_POST['card_value'] : '';


$sql = "SELECT * FROM jmas.game_state where id = 1";
$result = mysqli_query($conn, $sql);
$row = $result->fetch_assoc();
$current_player_id = $row['current_player_id'];

// check to see if there's a current card for the player
// make the sql request
$sql = "UPDATE jmas.players SET current_card=". $card_value  . " WHERE id = " . $current_player_id;
$result = mysqli_query($conn, $sql);


}

header("Location: ./admin.php");


?>
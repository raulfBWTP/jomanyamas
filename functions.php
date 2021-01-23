<?php
function str_replace_first($search, $replace, $subject) {
    $pos = strpos($subject, $search);
    if ($pos !== false) {
        return substr_replace($subject, $replace, $pos, strlen($search));
    }
    return $subject;
}

// this holds functions we might want to reuse
// this loos up the name of a player and returns the associated id

function convert_name($player_name) {

	$username = $_SERVER['PHP_AUTH_USER'];
	$database  = "jmas"; 
	$user      = "WWDGRemote";    
	$password  = "QpVH.,urpiAm8JX8";
	$servername      = "localhost";


// Create connection
$conn = mysqli_connect($servername, $user, $password, $database);
// Check connection
if (!$conn) { 
   // die("Error:  Connection failed: " . mysqli_connect_error());
    return 1;
}

// look up the player name in the db

// make the sql request
$sql = "SELECT * FROM jmas.players WHERE name = '" . $player_name . "'";
$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		$row = $result->fetch_assoc();

    	// Get the id
    	$player_id = $row['id'];
		return $player_id;
	}  else {
    	return 1;
	}
}

function id_for_name($player_name) {
    return convert_name($player_name);
}



function display_name_for($player_name) {

	$username = $_SERVER['PHP_AUTH_USER'];
	$database  = "jmas"; 
	$user      = "WWDGRemote";    
	$password  = "QpVH.,urpiAm8JX8";
	$servername      = "localhost";


// Create connection
$conn = mysqli_connect($servername, $user, $password, $database);
// Check connection
if (!$conn) { 
   // die("Error:  Connection failed: " . mysqli_connect_error());
    return "Unknown";
}

// look up the player name in the db

// make the sql request
$sql = "SELECT * FROM jmas.players WHERE name = '" . $player_name . "'";
$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		$row = $result->fetch_assoc();

    	// Get the id
    	$player_id = $row['display_name'];
		return $player_id;
	}  else {
    	return "Unknown";
	}
}

// This updates the game state after a player claims their prize
function nextPlayer($conn, $player_id) {
    // First, clear out the card value for the current player
    $sql = "UPDATE jmas.players SET current_card = 100 WHERE id = " . $player_id;
    $result = mysqli_query($conn, $sql);
    if ($result) {
    // then update the game_state table to set the next player as active
        $next_player = ($player_id % 7 ) + 1;
        $sql = "UPDATE jmas.game_state SET current_player_id = " . $next_player . " WHERE id = 1";
        $result = mysqli_query($conn, $sql);
    } else {
        echo "There has been an error";
    }
}

?>

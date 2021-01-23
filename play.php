<?php
include("functions.php");


// This page checks to see if it's the player's turn.  

// if it is, is shows the instructions fo rthe player
// (pull a sock)
// if not, it says whose turn it is and presents the main page buttons


include("connect.php");


$display_name = display_name_for($username);

include("jmas_header.php");

// now we load from the DB to see if it's this person's utrn
// make the sql request

// make the sql request

$sql = "SELECT * FROM jmas.game_state_player where id=1";
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
	$row = $result->fetch_assoc();

    // Get the relevant data
    $in_progress = $row['game_in_progress'];
    $current_player_name = $row['name'];
    $current_player_display_name = $row['display_name'];
    
    // If current player = this player...
     if ($username == $current_player_name) {
     	include("pull_sock.php");
     } else {
     	include("not_your_turn.php");
     }
}
?>
</body>
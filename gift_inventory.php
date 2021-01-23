<?php
include("functions.php");

// this is a script to allow the player to claim a gift

// it presumes that the call is a POST and that the post includes the 
// id index of the player and the id Index of the symbol (category)


include("connect.php");
// If it's a POST then we want to do the specified action

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     // The request is using the POST method
     
     // we perform the specified action
     // we want the player id, the gift id, and the recifient id (if there is one)
     $action = isset($_POST['action']) ? $_POST['action'] : '';
     
     
     $player_id = isset($_POST['player_id']) ? $_POST['player_id'] : '';
     $gift_id = isset($_POST['gift_id']) ? $_POST['gift_id'] : '';
     $recipient_id = isset($_POST['recipient_id']) ? $_POST['recipient_id'] : '';

     // we perform the specified action
	if ($action == 'claim') {
		// We update the SQL DB to give the person that gift
		// make the sql request

		$sql = "UPDATE jmas.gifts SET current_owner=" . $player_id . " WHERE id = " . $gift_id;
		$result = mysqli_query($conn, $sql);
		
		if ($result) {
		// if this is successful, then we want to change the game state
		nextPlayer($conn, $player_id);
		}
	}

	if ($action == 'swap') {
		// We update the SQL DB to give the person that gift
		// make the sql request

		$sql = "UPDATE jmas.gifts SET current_owner=" . $recipient_id . " WHERE id = " . $gift_id;
		$result = mysqli_query($conn, $sql);
		
	}


}


// convert the player name into the player id

$player_id = convert_name($username);
$display_name = display_name_for($username);


// Heres the header part...

include("inventory_header.php");

// find all the unclaimed gifts that have the matching symbol id

// make the sql request
$sql = "SELECT * FROM jmas.gifts WHERE current_owner = " . $player_id . " ORDER BY name ASC";
$result = mysqli_query($conn, $sql);

// Are there any gifts left?
if (mysqli_num_rows($result) > 0) {

?>
<div id="inventoryList">
<?php
    
    // There are, so iterate through them
	while($row = $result->fetch_assoc()) {
	
    // Get the data for the item
    $id = $row['id'];
    $filename = $row['photo_filename'];
    $description = $row['description'];
	$name = $row['name'];
	
	
	include("inventory_gift_item.php");

    }
  
   
 ?>
</div>

<?php 
    

} else {
// This person has no gifts yet
?>
<div id="noGifts" class="scrollContent">
You don't have any prizes yet
</div>
<?php
}

?>

</body>

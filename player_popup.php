<?php
//include("functions.php");


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


// omit the current player
$player_id = convert_name($username);
// make the sql request
$pp_sql = "SELECT * FROM jmas.players where id != " . $player_id . "";
$pp_result = mysqli_query($conn, $pp_sql);
if (mysqli_num_rows($pp_result) > 0) {
?>
<div class="playerSelector">
Give <?=$name?> to...<br>
<select id="playerSelector" name="recipient_id">
<?php
	while($pp_row = $pp_result->fetch_assoc()) {
	
    // Get the data for the item
    $recipient_id = $pp_row['id'];
    $recipient_display_name = $pp_row['display_name'];
	?>
	<option value="<?=$recipient_id?>"><?=$recipient_display_name?></option>
	<?php
    }
?>
</select>
</div>
<button type="submit" class="giveGiftButton">Give gift</button>
<button type="reset" onclick="hideDiv('swap_<?=$id?>')"  class="cancelSwapButton">Cancel</button>
</form>
<?php
}

?>




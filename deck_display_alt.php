<?php
//include("functions.php");

// this is a script to allow the player to claim a gift

// it presumes that the call is a POST and that the post includes the 
// id index of the player and the id Index of the symbol (category)


// Connect to the DB
//include("connect.php");

$username = $_SERVER['PHP_AUTH_USER'];


// find all unused cards

$player_id = convert_name($username);

// make the sql request
$sql = "SELECT * FROM jmas.deck where id > 0 AND id < 65 and used=0 ORDER BY id ASC";
$result = mysqli_query($conn, $sql);

// Are there any gifts left?
if (mysqli_num_rows($result) > 0) {
?>
<div class="bordered shadowed rounded smallmargin">
Assign Challenge...
<form action="assign_card.php" method="POST">
<div>
<select id="currentChallenge" name="card_value" class="deckPopup">
<?php
    // There are, so iterate through them
    while($row = $result->fetch_assoc()) {
        // Get the data for the item
        $id = $row['id'];
        $challenge = $row['challenge'];
        $symbol = $row['symbol'];
        $used = $row['used'];
        // Display using the template
        ?>
        <option value="<?=$id?>">
        <?=$id?>
        </option>
        <?php
    }
?>
</select>
</div>
<button name="submit" type="submit">
Assign
</button>

</form>
</div>
<?php 
    

} else {
// there aren't any gifts left, which should not happen...
    include("no_uploaded_gifts.php");
    echo $player_id;
    echo $username;
}
?>


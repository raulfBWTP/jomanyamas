<?php
// load our functions
include("functions.php");



// Connect to the DB
include("connect.php");
$username = $_SERVER['PHP_AUTH_USER'];
$display_name = display_name_for($username);


// check to see if there's a current card for the player
// make the sql request
$sql = "SELECT * FROM jmas.players where name = '" . $username . "'";
$result = mysqli_query($conn, $sql);

// get the resutls
if (mysqli_num_rows($result) > 0) {
	$row = $result->fetch_assoc();

    // Get the current card
    $current_card = $row['current_card'];

}


// If there's no current card, we want to load the waiting page....

if ($current_card == 100) {
	include("card_loop.php");
}
else {
	//	there's a card, so show it
	$include_menu = false;
    $page_title = "Your Challenge";
    include("customizable_header.php");

?>
<div id='playDiv' class="scrollContent">
<div id="currentCard">
<?php
// make the sql request
$sql = "SELECT * FROM jmas.deck_card where id = " . $current_card . "";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
	$row = $result->fetch_assoc();

    // Get the relevant data
     $symbol_id = $row['symbol'];
    $symbol_name = $row['symbol_name'];
    $file_name = $row['file_name'];
    $challenge_text = $row['challenge_text'];

    // And set the card as consumed
    $sql = "UPDATE jmas.deck_card SET used = 1 where id = " . $current_card . "";
    $result = mysqli_query($conn, $sql);
}

?>
<div id="imageDiv" onclick="hideDiv('imageDiv');showDiv('challengeText');">
<img id="symbolImage" class="rounded shadowed" alt="<?=$symbol_name?>" src="./images/<?=$file_name?>.png">
</div>
<div id="challengeText" onclick="showDiv('imageDiv');hideDiv('challengeText');"><?=$challenge_text?><div>
</div>
</div>
<div>
<form action="./claim_gift.php" method="POST">
<input type="hidden" name="symbol_id" value="<?=$symbol_id?>">
<input type="hidden" name="player" value="<?=$username ?>">
<button type="submit">
I've completed my challenge
</button>
</form>
</div>

</body>
</html>
<?php
}
?>
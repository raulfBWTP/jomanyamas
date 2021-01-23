<?php
include("functions.php");

// this is a script to allow the player to claim a gift

// it presumes that the call is a POST and that the post includes the 
// id index of the player and the id Index of the symbol (category)


// Connect to the DB
include("connect.php");

$username = $_SERVER['PHP_AUTH_USER'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     // The request is using the POST method
     
     // we want the player and the symbol they used
     $action = isset($_POST['action']) ? $_POST['action'] : '';
     $player_name = isset($_POST['player']) ? $_POST['player'] : '';
     $gift_id = isset($_POST['gift_id']) ? $_POST['gift_id'] : '';


    // convert the player name into the player id
    $player_id = convert_name($player_name);
    if ($action == "delete") {
         $sql ="DELETE FROM gifts WHERE id='" . $gift_id . "'";
         $result = mysqli_query($conn, $sql);
     }




}
// Heres the header part...
?>
<?php include("html_header.php");?>
<body>
    <div class="pageHeader">
        <div class="homeIcon">
            <a href="./index.php"><img id="home_icon" alt="Home" src="./home_icon.png" height="50" width="50"></a>
        </div>
        <div class="pageTitle">
            Deck Status
        </div>
    </div>
<?php
// find all the gifts that the user has uploaded

$player_id = convert_name($username);

// make the sql request
$sql = "SELECT * FROM jmas.deck where id > 0 AND id < 65";
$result = mysqli_query($conn, $sql);

// Are there any gifts left?
if (mysqli_num_rows($result) > 0) {
?>
<div class="scrollContent bordered shadowed rounded">
<?php
    // There are, so iterate through them
    while($row = $result->fetch_assoc()) {
        // Get the data for the item
        $id = $row['id'];
        $challenge = $row['challenge'];
        $symbol = $row['symbol'];
        $used = $row['used'];
        // Display using the template
        include("deck_entry.php");
        
        if ( $id % 4 == 0 ) {
        ?>
        <div style="clear:both;width:0px;"></div>
        <?php
        }
    }
?>
</div>

</div>
</div>
</body>
<?php 
    

} else {
// there aren't any gifts left, which should not happen...
    include("no_uploaded_gifts.php");
    echo $player_id;
    echo $username;
}
?>


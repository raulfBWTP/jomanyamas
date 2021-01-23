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
            <?php include("home_menu.php");?>
        <div class="pageTitle">
            Remaining Prizes
        </div>
    </div>
<?php
// find all the gifts that the user has uploaded

$player_id = convert_name($username);

// make the sql request
$sql = "SELECT * FROM jmas.gifts ORDER BY symbol_id ASC";
$result = mysqli_query($conn, $sql);

// Are there any gifts left?
if (mysqli_num_rows($result) > 0) {
?>
<div class="scrollContentGifts">
<?php
    // There are, so iterate through them
    
    // We want to group by symbol, so we keep track of the symbol
    $last_symbol = 0;
    while($row = $result->fetch_assoc()) {
        // Get the data for the item
        $id = $row['id'];
        $filename = $row['photo_filename'];
        $description = $row['description'];
        $name = $row['name'];
        $symbol_id = $row['symbol_id'];
        $creator = $row["creator"];
            $include = $row['include'];
        // Display using the template
        include("browse_gift_entry.php");
        $last_symbol = $symbol_id;
    }
?>
</div>

</div>
</div>
<?php include("browse_detail.php");?>

</body>
<?php 
    

} else {
// there aren't any gifts left, which should not happen...
    include("no_uploaded_gifts.php");
    echo $player_id;
    echo $username;
}
?>


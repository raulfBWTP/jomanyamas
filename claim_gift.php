<?php
include("functions.php");

// this is a script to allow the player to claim a gift

// it presumes that the call is a POST and that the post includes the 
// id index of the player and the id Index of the symbol (category)


// Connect to the DB
include("connect.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     // The request is using the POST method
     
     // we want the player and the symbol they used
     $player_name = isset($_POST['player']) ? $_POST['player'] : '';
     $symbol_id = isset($_POST['symbol_id']) ? $_POST['symbol_id'] : '';


    // convert the player name into the player id
    $player_id = convert_name($player_name);

// Heres the header part...
?>
<head>
    <title>
        Jo'manyamas - Claim Your Prize!
    </title>
    <script type="text/javascript" src="./jmas.js"></script>
    <link REL="stylesheet" HREF="jmas.css" TYPE="text/css" >
    <meta name="viewport" content="width=400" >
</head>
<body>
    <div class="pageHeader">
        <div class="pageTitle">
            Select a gift...
        </div>
    </div>
<?php
// find all the unclaimed gifts that have the matching symbol id

// make the sql request
$sql = "SELECT * FROM jmas.gifts WHERE symbol_id = " . $symbol_id . " AND current_owner IS NULL";
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
        // Display using the template
        include("gift_listing.php");
    

    }
?>
</div>

</div>
</div>


</body>
<?php 
    

} else {
// there aren't any gifts left, which should not happen...

    echo "There are no gifts left in that category.  This should not happen";

}
} else {
?>
    there has been an error
<?php
}
?>


<?php
include("functions.php");

// this is a script to allow the player to claim a gift

// it presumes that the call is a POST and that the post includes the 
// id index of the player and the id Index of the symbol (category)


// Connect to the DB
include("connect.php");

$username = $_SERVER['PHP_AUTH_USER'];

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
$sql = "SELECT * FROM jmas.gifts WHERE current_owner IS NULL";
$result = mysqli_query($conn, $sql);

// Are there any gifts?
if (mysqli_num_rows($result) > 0) {
?>
<div id="inventoryListX" class="scrollContentGifts">
<?php
    // There are, so iterate through them
    while($row = $result->fetch_assoc()) {
        // Get the data for the item
        $id = $row['id'];
        $filename = $row['photo_filename'];
        $description = $row['description'];
        $name = $row['name'];
        $creator = $row["creator"];
            $include = $row['include'];
        // Display using the template
        include("unclaimed_gift_entry.php");
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
}
?>


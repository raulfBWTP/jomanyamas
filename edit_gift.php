<?php 
include("functions.php");

// So now we want to add to the db
include("connect.php");

$username = $_SERVER['PHP_AUTH_USER'];
     $player_id = id_for_name($username);

     $description = isset($_POST['description']) ? $_POST['description'] : '';
     $name = isset($_POST['name']) ? $_POST['name'] : '';
     $gift_id = isset($_POST['gift_id']) ? $_POST['gift_id'] : '';


$sql ="UPDATE jmas.gifts SET name = '" . $name . "' , description = '"  . $description . "' WHERE id=" . $gift_id;
$result = mysqli_query($conn, $sql);
if ($result) {
    echo "Added!<br>";
} else {
    $errorText = mysqli_error($conn);
    echo $errorText;
}

?>
<?php header("Location: ./all_gifts.php"); ?>
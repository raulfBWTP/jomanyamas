<?php

// The purose of this is to create a random deck of associations between the
// challenges and the deck of cards that the players pull


// first we find all included challenges


// we fill an array with the ID of the challenges
// shuffle the array
// then set the challenge values in the deck.


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


?>
<div style="position:relative;margin:20px;margin-top:50px;">
<table>

<?php



$deck_array = array();

// make the sql request
$sql = "SELECT * FROM jmas.challenges where include = 1";

// show all if it's raul (who logs in as kelly)
if ($username == "kelly") {
    $sql = "SELECT * FROM jmas.challenges";
}
$result = mysqli_query($conn, $sql);

//grab the challenge $result;
if (mysqli_num_rows($result) > 0) {
    $ii = 0;
    while($row = $result->fetch_assoc()) {
        $ii = $ii +1;

    // Get the relevant data
    $id = $row['id'];
    $creator = $row['creator'];
    $challenge_text = $row['challenge_text'];

// echo $challenge_text;
// echo "<br>";
	array_push($deck_array, $id);
	}
}


// Shuffle the array
shuffle($deck_array);

// create a new sql query that updates the deck values

$new_query = "";

for ($x = 0; $x < count($deck_array); $x++) {
	$xx = $x + 1;
	$symbol = floor( $x / 4 ) + 1;
	$new_query = $new_query . "UPDATE jmas.deck SET challenge=" . $deck_array[$x] . ", symbol=" . $symbol . " WHERE id=" . $xx  . " ;\r";
    echo "entry number $x is $deck_array[$x], with symbol # $symbol <br>";
} 

echo "<pre>";
echo $new_query;
echo "</pre><br>";

$result = mysqli_multi_query($conn, $new_query);
echo  mysqli_error($conn);

?>

<br><?= count($deck_array) ?> items randomized

</body>
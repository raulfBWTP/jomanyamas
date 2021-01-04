<?php
function str_replace_first($search, $replace, $subject) {
    $pos = strpos($subject, $search);
    if ($pos !== false) {
        return substr_replace($subject, $replace, $pos, strlen($search));
    }
    return $subject;
}


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


// make the sql request
$sql = "SELECT * FROM jmas.players where name = '" . $username . "'";

// show all if it's raul (who logs in as kelly)
if ($username == "kelly") {
    $sql = "SELECT * FROM jmas.challenges";
}
$result = mysqli_query($conn, $sql);

//echo $result;
if (mysqli_num_rows($result) > 0) {
	$row = $result->fetch_assoc();

    // Get the relevant data
    $current_card = $row['current_card'];

}
?>
<head>
<title>
Jo'manyamas!
</title>
<script type="text/javascript" src="./jmas.js"></script>
</head>
<body>
<div id='titleDiv'>
Jo'manyamas Home Page
</div>
<div id='playDiv'>
Play section<br>
<button onclick="showDiv('currentCard')"> Show my challenge </button>
<div id="currentCard" style="display:none;">
Current challenge:<br>
<?php
// make the sql request
$sql = "SELECT * FROM jmas.deck_card where id = '" . $current_card . "'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
	$row = $result->fetch_assoc();

    // Get the relevant data
    $symbol_name = $row['symbol_name'];
    $challenge_text = $row['challenge_text'];

}

?>
<div id="symbol"><?=$symbol_name?><br></div>
<div id="challengeText"><?=$challenge_text?><div>
</div>
</div>
</body>
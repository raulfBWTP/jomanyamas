<?php
include("functions.php");

$username = $_SERVER['PHP_AUTH_USER'];

if ($username != "raul") {
    die("Error: GURU MEDITATION 93499" );

}

include("connect.php");


$action = isset($_GET['action']) ? $_GET['action'] : '';

// Act on the action, if any
if ($action == "game_on") {

    $sql = "UPDATE jmas.game_state_player SET game_in_progress=1 where id=1";
    $result = mysqli_query($conn, $sql);

} elseif ($action == "game_off") {
    $sql = "UPDATE jmas.game_state_player SET game_in_progress=0 where id=1";
    $result = mysqli_query($conn, $sql);

}

// make the sql request

$sql = "SELECT * FROM jmas.game_state_player where id=1";
$result = mysqli_query($conn, $sql);

//echo $result;
if (mysqli_num_rows($result) > 0) {
	$row = $result->fetch_assoc();

    // Get the relevant data
    $in_progress = $row['game_in_progress'];
?>
<html>
    <head>
    <title>
        Jo'manyamas Admin
    </title>
    <script type="text/javascript" src="./jmas.js"></script>
    <link REL="stylesheet" HREF="jmas.css" TYPE="text/css" >
    <meta name="viewport" content="width=400" >
    </head>
    <body>
        <div class="pageHeader">
            <div class="homeIcon"><a href="./index.php"><img id="home_icon" alt="Home" src="./home_icon.png" height="50" width="50"></a></div>
            <div id='titleDiv' class="pageTitle">Jo'manyamas Admin Page</div>
        </div>
        <div class="menuActions">
            <div class="bordered rounded smallmargin shadowed">
                Game Mode      
<?php
if ($in_progress == 0)  {
?>
    <div class="menuItem">
        <a href="./admin.php?action=game_on">
            <button class="menuButton">Turn Game On</button>
        </a>
    </div>
<?php
	} else {
?>
    <div class="menuItem">
        <a href="./admin.php?action=game_off">
            <button class="menuButton">Turn Game Off</button>
        </a>
    </div>

<?php
	}
}
	 
?>
            </div>
            <div class="bordered rounded smallmargin shadowed">
                Challenges
                <div class="menuItem">
                    <a href="./reset_cards.php">
                        <button class="menuButton">Clear Challenge Deck</button>
                    </a>
                </div>
                <div class="menuItem">
                    <a href="./jmas_randomizer.php">
                        <button class="menuButton">Shuffle Challenge Deck</button>
                    </a>
                </div>
            </div>
            <div class="bordered rounded smallmargin shadowed">
<?php
            if ($in_progress == 0)  {
                    include("pre_game_buttons.php");	
                } else {
                    include("game_buttons.php");
                }
?>
        </div>
        <?php include("deck_display_alt.php");?>

        </div>
    </body>
</html>
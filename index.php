<?php


$username = $_SERVER['PHP_AUTH_USER'];

if ($username == "raul") {
header("Location: ./admin.php");
}


include("connect.php");

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
		Jo'manyamas!
	</title>
	<script type="text/javascript" src="./jmas.js"></script>

	<link REL="stylesheet" HREF="jmas.css" TYPE="text/css" >

<meta name="viewport" content="width=400" >
	</head>
	<body>
		<div class="pageHeader">
            <?php include("home_menu.php");?>
			<div id='titleDiv' class="pageTitle">Jo'manyamas!</div>
		</div>
		<div class="menuActions">
<?php
if ($in_progress == 0)  {
		include("pre_game_buttons.php");	
	} else {

		include("game_buttons.php");
	}
}
	 
?>
		</div>
	</body>
</html>
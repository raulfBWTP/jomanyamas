<?php

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


// if we had a post, then we're making changes to the DB

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     // The request is using the POST method
     $action = isset($_POST['action']) ? $_POST['action'] : '';
     $text = isset($_POST['challenge_text']) ? $_POST['challenge_text'] : '';
     $id = isset($_POST['id']) ? $_POST['id'] : '';
     

     //echo $action;
    // echo $text;
    // echo $username;
     
     if ($action == "add") {
         $sql ="INSERT INTO challenges (creator,challenge_text) VALUES ('" . $username . "','" . $text . "')";
         $result = mysqli_query($conn, $sql);
         if ($result) {
             echo "Added!<br>";
         } else {
            echo mysqli_error($conn);
        }
        header("Location: ./jmas_entry.php");
     } else if ($action == "delete") {
         $sql ="DELETE FROM jmas.challenges WHERE id=" . $id . "";
         $result = mysqli_query($conn, $sql);
         if (!$result) {
         echo mysqli_error($conn); 
        } else {
         header("Location: ./jmas_entry.php");
        }
     }
?>

<?php
} else {


include("challenge_header.php");

?>
<div id="challengeList" style="margin-left:15px">
<table class="shadowed greenTable">
<?php
if ($username == "kelly" || $username == "raul") {
?>
   <tr> <td>Player</td><td>Use</td><td>Text</td><td>Delete</td>
     
     </tr>
<?php	
}
?>
<?php
// make the sql request
$sql = "SELECT * FROM jmas.challenges where creator = '" . $username . "'";

// show all if it's raul (who logs in as kelly)
if ($username == "kelly" || $username == "raul") {
    $sql = "SELECT * FROM jmas.challenges";
}
$result = mysqli_query($conn, $sql);

//echo $result;
if (mysqli_num_rows($result) > 0) {
    $ii = 0;
    while($row = $result->fetch_assoc()) {
        $ii = $ii +1;

    // Get the relevant data
    $id = $row['id'];
    $creator = $row['creator'];
    $challenge_text = $row['challenge_text'];
    $include = $row['include'];
if ($ii <  mysqli_num_rows($result)) { 
$comma = ",";
} else { 
$comma="";
}
?>
    <tr>
<?php
if ($username == "kelly" || $username == "raul") {

$is_checked =  ($include == 1) ? "checked" : " ";
$toggle = 1 - $include;
?>
    <td><?=$creator?></td>
     <td><input type="checkbox" name="enable" value="1" <?= $is_checked ?> onclick="toggleChallengeInclude(<?=$id?>, <?=$toggle?>)"></td>
<?php	
}
?>
    <td><?=$challenge_text?></td>
    <td class="center" >
    <button onClick="doDeleteConfirm('<?=$id?>')" style="margin:3px;">Delete</button>
    </td>
</tr>


<?php
}
}
?>
</table>
</div>
<?php include("add_holder.php");?>
<div id="deleteView">
    <div class="dimmer">
    &nbsp;
    </div>
<div class="popup">
    Are you sure you want to delete the challenge?<br>
    <form action="jmas_entry.php" method="POST">
        <input type="hidden" name="action" value="delete">
        <input id="deleteIndex" type="hidden" name="id" value="<?=$id?>">
        <div class="buttonHolder">
            <button name="submit" type="submit">
            Delete
            </button>
            <button name="reset" class="purple border1" type="reset" onclick="hideDiv('deleteView')">
            Cancel
            </button>
        </div>
    </form>
</div>
</div>

<?php
}
?>
</body>
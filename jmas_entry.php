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
        $errorText = mysqli_error($conn);
        if (strpos($errorText, "Duplicate") !== false) {
            echo '{ "status" : "conflict", "error" : "' . $errorText .'"}';
        } else {
            echo '{ "status" : "error", "error" : "' . $errorText .'"}';
        }
        }
     } else if ($action == "delete") {
         $sql ="DELETE FROM challenges WHERE id='" . $id . "'";
         $result = mysqli_query($conn, $sql);
     }
?>
<?php header("Location: ./jmas_entry.php"); ?>
<?php
} else {


include("jmas_header.php");





?>
<div style="position:relative;margin:20px;margin-top:50px;">
<table>

<?php
// make the sql request
$sql = "SELECT * FROM jmas.challenges where creator = '" . $username . "'";

// show all if it's raul (who logs in as kelly)
if ($username == "kelly") {
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
if ($ii <  mysqli_num_rows($result)) { 
$comma = ",";
} else { 
$comma="";
}
?>
    <tr>
<?php
if ($username == "kelly") {
?>
    <td><?=$creator?></td>
<?php	
}
?>
    <td><?=$challenge_text?></td>
    <td class="center">
    <button onClick="doDeleteConfirm('<?=$id?>')">Delete</button>
    </td>
</tr>


<?php
}
}
?>
</table>
</div>
<div id="addHolder">
    <div class="dimmer">
    &nbsp;
    </div>
    <div id="addForm" class="popup">
    Type in the text for the challenge...<br>
    <form action="jmas_entry.php" method="POST">
        <textarea id="newEntry" name="challenge_text" ></textarea><br>
        <input type="hidden" name="action" value="add">
        <div class="buttonHolder">
            <button name="submit" type="submit">
            Save
            </button>
            <button name="reset" type="reset" onclick="hideDiv('addHolder')">
            Cancel
            </button>
        </div>
    </form>
    </div>
</div>

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
            <button name="reset" type="reset" onclick="hideDiv('deleteView')">
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
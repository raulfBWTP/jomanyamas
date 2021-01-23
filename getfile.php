<?php
include("functions.php");


$filename="./temp/{$_FILES['file'] ['name']}";
$thumbfile="../gift_images/{$_FILES['file'] ['name']}";
$filenopath= "{$_FILES['file'] ['name']}";


// Get the form fields     

$username = $_SERVER['PHP_AUTH_USER'];
     $player_id = id_for_name($username);

     $description = isset($_POST['description']) ? $_POST['description'] : '';
     $name = isset($_POST['name']) ? $_POST['name'] : '';



if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 200000))
  {
  if ($_FILES["file"]["error"] > 0)
	{
	echo "Error: " . $_FILES["file"]["error"] . "<br />";
	}
  else
	{
	$full_uploaded_name =  $_FILES["file"]["name"];
	echo "Upload: " . $_FILES["file"]["name"] . "<br />";
	echo "Type: " . $_FILES["file"]["type"] . "<br />";
	echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
	echo "Stored in: " . ($_FILES["file"]["tmp_name"]) . "<br>";
//	move_uploaded_file ($_FILES["file"] ["tmp_name"], "./temp/{$_FILES['file'] ['name']}");
    // Keep the original random upload name to facilitate re-uploads
    
    list($uploaded_name, $extension) = split('[.]', $full_uploaded_name);
    
    $new_name = str_replace( "/tmp/", "",  $_FILES["file"]["tmp_name"])  . "." . $extension;
    
	move_uploaded_file ($_FILES["file"] ["tmp_name"], "./temp/" . $new_name);
	}
// now that we've saved the file, we're going to make the thumbnail	 
// copying the code...


$img = "./temp/" . $new_name;
$percent = 0;
$constrain = 1;
$w = 200;
$h = 200;

// get image size of img
$x = @getimagesize($img);
// image width
$sw = $x[0];
// image height
$sh = $x[1];

echo "Image height: " . $sh;
echo "Image width: " . $sw;


	if ($percent > 0) {
		// calculate resized height and width if percent is defined
		$percent = $percent * 0.01;
		$w = $sw * $percent;
		$h = $sh * $percent;
	} else {
		if (isset ($w) AND !isset ($h)) {
			// autocompute height if only width is set
			$h = (100 / ($sw / $w)) * .01;
			$h = @round ($sh * $h);
		} elseif (isset ($h) AND !isset ($w)) {
			// autocompute width if only height is set
			$w = (100 / ($sh / $h)) * .01;
			$w = @round ($sw * $w);
		} elseif (isset ($h) AND isset ($w) AND isset ($constrain)) {
			// get the smaller resulting image dimension if both height
			// and width are set and $constrain is also set
			$hx = (100 / ($sw / $w)) * .01;
			$hx = @round ($sh * $hx);
	
			$wx = (100 / ($sh / $h)) * .01;
			$wx = @round ($sw * $wx);
	
			if ($hx < $h) {
				$h = (100 / ($sw / $w)) * .01;
				$h = @round ($sh * $h);
			} else {
				$w = (100 / ($sh / $h)) * .01;
				$w = @round ($sw * $w);
			}
		}
	}
	
	

	// Show all information, defaults to INFO_ALL
// phpinfo();


//	$im = @imagecreatefromjpeg ($img) or // Read JPEG Image

// SKIPPING THE RESIZING FOR NOW

//$im = @imagecreatefrompng ($img); // or // or PNG Image
//	$im = @imagecreatefromgif ($img) or // or GIF Image
//	$im = false; // If image is not JPEG, PNG, or GIF
	//echo $im;
	
//	echo "so far so good!";
	
//	if (!$im) {
//	echo "There were problems!";
		// We get errors from PHP's ImageCreate functions...
		// So let's echo back the contents of the actual image.
//		readfile ($img);
//	} else {
//	    echo "Were able to create image";
		// Create the resized image destination
//		$thumb = @ImageCreateTrueColor ($w, $h);
		// Copy from image source, resize it, and paste to image destination
//		@ImageCopyResampled ($thumb, $im, 0, 0, 0, 0, $w, $h, $sw, $sh);
		// Output resized image
		//@ImageJPEG ($thumb);
		
//		imagejpeg ($thumb, $thumbfile);
//		imagedestroy($thumb);
		
//	}
}

echo $username;
echo "<br>";
echo $player_id;
echo "<br>";
echo $new_name;
echo "<br>";
echo "full_uploaded_name: " . $full_uploaded_name;
echo "<br>";

echo "Extesnion: " . $extension;
echo "<br>";

echo $name;
echo "<br>";
echo $description;

// So now we want to add to the db
include("connect.php");


$sql ="INSERT INTO jmas.gifts (name,description,creator,photo_filename) VALUES ('" . $name . "','"  . $description . "','"  . $player_id . "','" . $new_name . "')";
$result = mysqli_query($conn, $sql);
if ($result) {
    echo "Added!<br>";
} else {
    $errorText = mysqli_error($conn);
    echo $errorText;
}

?>
<?php header("Location: ./all_gifts.php"); ?>

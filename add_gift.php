<?php 
include("functions.php");

$username = $_SERVER['PHP_AUTH_USER'];
$display_name = display_name_for($username);

include("add_gift_header.php");
?>
    <div class="scrollContent bordered rounded shadowed">
        <form id="addForm" action="getfile.php" method="post" enctype="multipart/form-data"><br>
            <div class="formInput">
                <div>Name of gift</div>
                <input class="textEntry" type="text" name="name" maxlength="64" >
            </div>
            <div class="formInput">
                <div>Description</div>
                <textarea name="description" rows="4" class="popupTextField">Enter description text here...</textarea>
            </div>
            <div class="formInput">
                Select an image for this gift (use Medium size, not full size): 

                <input type="file" name="file" id="file" onchange="checkFileSize()">
            </div>
        </form>
        <button type="submit" value="Upload File" form="addForm">Submit</button>
        <a href="all_gifts.php"><button class="purple border1">Cancel</button></a>
    </div>
</body>
</html>

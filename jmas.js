function hideDiv(theDivName) {
	var theDiv = document.getElementById(theDivName);
	if (theDiv) theDiv.style.display="none";
}


function showDiv(theDivName) {
	var theDiv = document.getElementById(theDivName);
	if (theDiv) theDiv.style.display="block";
}

function doDeleteConfirm(item) {
    scrollToTop();
    var inputItem = document.getElementById("deleteIndex");
    inputItem.value = item;
    showDiv("deleteView");
}


// When the user clicks on the button, scroll to the top of the document
function scrollToTop() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}

function toggleChallengeInclude(item, include) {
    window.location.assign("./toggle_challenge.php?id=" + item+ "&value=" + include)
}

function toggleGiftInclude(item, include) {
    window.location.assign("./toggle_gift.php?id=" + item + "&value=" + include)
}

function showGiftDetail( id, text, description, filename) {
	var theDiv = document.getElementById("giftName");
	theDiv.value = text;
	theDiv = document.getElementById("giftDescription");
	theDiv.value = description;
	theDiv = document.getElementById("giftImage");
	theDiv.src = "./temp/" + filename;
	// Update the gift id field
	theDiv = document.getElementById("giftID");
	theDiv.value = id;
	
	scrollToTop();
    showDiv("giftDetail");
}

function showBrowseDetail( id, text, description, filename) {
	var theDiv = document.getElementById("giftName");
//	theDiv.value = text;
//	theDiv = document.getElementById("giftDescription");
//	theDiv.value = description;
	theDiv = document.getElementById("giftImage");
	theDiv.src = "./temp/" + filename;
	// Update the gift id field
//	theDiv = document.getElementById("giftID");
//	theDiv.value = id;
	
	scrollToTop();
    showDiv("giftDetail");
}



function checkFileSize() {
    var inpFiles = document.getElementById('file');
    for (var i = 0; i < inpFiles.files.length; ++i) {
        var size = inpFiles.files.item(i).size;
        
        if (size > 200000) {
        alert("File is too large -- " + size + " bytes.  Please resize so that it is less than 200k");
        inpFiles.value = "";
        }
    }
}

function focusOn(element) {
  document.getElementById(element).focus();
}
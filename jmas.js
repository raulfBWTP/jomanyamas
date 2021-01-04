function hideDiv(theDivName) {
	var theDiv = document.getElementById(theDivName);
	if (theDiv) theDiv.style.display="none";
}


function showDiv(theDivName) {
	var theDiv = document.getElementById(theDivName);
	if (theDiv) theDiv.style.display="block";
}

function doDeleteConfirm(item) {
    var inputItem = document.getElementById("deleteIndex");
    inputItem.value = item;
    showDiv("deleteView");
}

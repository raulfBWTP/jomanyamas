<div id="giftDetail">
    <div class="dimmer">
    &nbsp;
    </div>
    <div id="editForm" class="popup">
        <div style="text-align:center;" >
             <img class="giftImageBig shadowed" id="giftImage" alt="<image>" src="temp/<?=$filename?>" >
         </div>
        <form id="editGiftForm" action="./edit_gift.php" method="post" enctype="multipart/form-data"><br>
        <input type="hidden" id="giftID" name="gift_id" value="1">
            <div class="formInput">
                <div class="emphasis">Name of gift</div>
                <input class="textEntry" id="giftName" type="text" name="name" maxlength="80" value="temp">
            </div>
            <div class="formInput">
                <div class="emphasis" >Description</div>
                <textarea class="popupTextField" id="giftDescription" name="description" rows="4" cols="45">Temp</textarea>
            </div>            
       
        <div style="text-align:right;" >
            <a href="all_gifts.php"><button class="purple border1">Cancel</button></a>
            <button type="submit" name="submit" form="editGiftForm">Save Changes</button>
        </div>
         </form>
    </div>
</div>
